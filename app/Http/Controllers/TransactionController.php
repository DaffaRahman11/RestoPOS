<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Recipe;
use App\Models\Stock_Mutation;
use App\Models\Transaction_Detail;
use App\Models\Ingredient;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Detail_Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $transactions = Transaction::latest()->get();
            return view('transaction.listTransaction', compact ('transactions'));

            if(!$products){
                return redirect()->back()->with('message', 'Data Transaksi tidak ditemukan.');
            }

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{

            return view('transaction.createTransaction');

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|json',
            'payment_method' => 'required|string|in:cash,debit,card,ewallet',
            'total_price' => 'required|integer|min:1',
            'paid_amount' => 'required|integer|min:0',
            'change_amount' => 'required|integer|min:0',
        ]);

        $items = json_decode($request->items, true);

        if (!$items || count($items) === 0) {
            return back()->with('error', 'Tidak ada produk yang dipilih.');
        }

        // 1️⃣ Hitung kebutuhan total per ingredient
        $ingredientNeeds = []; // key = ingredient_id, value = total qty needed
        foreach ($items as $item) {
            $menuId = $item['id'];
            $qty = $item['qty'];

            // ambil resep untuk menu ini
            $recipes = Recipe::where('menu_id', $menuId)->get();

            foreach ($recipes as $recipe) {
                $ingredientId = $recipe->ingredient_id;
                $neededQty = $recipe->quantity_used * $qty;

                if (!isset($ingredientNeeds[$ingredientId])) {
                    $ingredientNeeds[$ingredientId] = 0;
                }

                $ingredientNeeds[$ingredientId] += $neededQty;
            }
        }

        // 2️⃣ Cek stok bahan
        $insufficient = [];
        foreach ($ingredientNeeds as $ingredientId => $neededQty) {
            $ingredient = Ingredient::find($ingredientId);
            if (!$ingredient) {
                return back()->with('error', 'Bahan tidak ditemukan.');
            }
            if ($ingredient->stock < $neededQty) {
                $insufficient[] = "{$ingredient->name} (tersedia: {$ingredient->stock}, dibutuhkan: $neededQty)";
            }
        }

        if (!empty($insufficient)) {
            return back()->with('error', 'Stok bahan tidak cukup: ' . implode(', ', $insufficient));
        }

        // 3️⃣ Proses transaksi atomik
        DB::beginTransaction();
        try {
            // 3a. Kurangi stok dan catat mutasi
            foreach ($ingredientNeeds as $ingredientId => $neededQty) {
                $ingredient = Ingredient::find($ingredientId);
                $ingredient->stock -= $neededQty;
                $ingredient->save();

                Stock_Mutation::create([
                    'ingredient_id' => $ingredientId,
                    'type' => 'out',
                    'reference' => 'transaction',
                    'note' => 'Penggunaan bahan untuk transaksi',
                    'quantity' => $neededQty,
                ]);
            }

            // 3b. Simpan transaksi
            $transaction = Transaction::create([
                'total_price' => $request->total_price,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->change_amount,
                'payment_method' => $request->payment_method,
                'user_id' => Auth::id() ?? null,
            ]);

            // 3c. Simpan detail transaksi
            foreach ($items as $item) {
                $menuId = $item['id'];
                $qty = $item['qty'];
                $menu = \App\Models\Menu::find($menuId);

                if (!$menu) continue;

                Transaction_Detail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $menuId,
                    'quantity' => $qty,
                    'unit_price' => $menu->price,
                    'subtotal' => $menu->price * $qty,
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
    }
}
