<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
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

            $transactions = Transaction::get();
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

            $products = Product::get();
            return view('transaction.createTransaction', compact ('products'));

            if(!$products){
                return redirect()->back()->with('message', 'Data Produk tidak ditemukan.');
            }

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // ✅ 1. Validasi input
        $validated = $request->validate([
            'items' => 'required|json',
            'payment_method' => 'required|string|in:cash,debit,card,ewallet',
            'total_price' => 'required|integer|min:1',
            'paid_amount' => 'required|integer|min:0',
            'change_amount' => 'required|integer|min:0',
        ]);

        // Decode items dari JSON
        $items = json_decode($validated['items'], true);

        if (!is_array($items) || count($items) === 0) {
            return back()->with('error', 'Data produk tidak valid.');
        }

        // ✅ 2. Jalankan transaksi database
        DB::beginTransaction();

        try {
            // 🔹 Generate kode transaksi unik
            $transactionCode = 'TK' . now()->format('YmdHis') . strtoupper(Str::random(4));

            // 🔹 Simpan data utama ke tabel transactions
            $transaction = Transaction::create([
                'transaction_code' => $transactionCode,
                'total_price' => $validated['total_price'],
                'paid_amount' => $validated['paid_amount'],
                'change_amount' => $validated['change_amount'],
                'payment_method' => $validated['payment_method'],
            ]);

            // 🔹 Simpan detail transaksi untuk tiap produk
            foreach ($items as $item) {
                if (!isset($item['id'], $item['qty'])) {
                    throw new Exception('Format item tidak valid');
                }

                $product = Product::findOrFail($item['id']);

                // Pastikan stok cukup
                if ($product->stock < $item['qty']) {
                    throw new Exception("Stok produk {$product->name} tidak mencukupi!");
                }

                $subtotal = $product->selling_price * $item['qty'];

                Detail_Transaction::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['qty'],
                    'subtotal' => $subtotal,
                ]);

                // Update stok produk
                $product->decrement('stock', $item['qty']);
            }

            // ✅ Semua aman → commit dan kirim pesan sukses
            DB::commit();

            return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // ⚠️ Menangkap error validasi
            return redirect()->back()->with('warning', 'Validasi input gagal, periksa kembali data Anda.');
        } catch (Exception $e) {
            // ❌ Menangkap error umum
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
        try{

            $transaction = Transaction::where($uuid)->get();
            return view('transaction.editTransaction', compact ('transaction'));

            if(!$transaction){
                return redirect()->back()->with('message', 'Data Transaksi tidak ditemukan.');
            }

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validateProduct = $request->validate([
            'id' => 'required|uuid|exists:transactions,id',
            'total_price' => 'required|integer',
            'paid_amount' => 'required|integer',
            'change_amount' => 'required|integer',
            'payment_method' => 'required|string',
        ],[
            'gajiPokok.integer' => 'Harap Inputkan Nominal Gaji Tanpa . atau ,',
            'bonus.integer' => 'Harap Inputkan Nominal Bonus Tanpa . atau ,'
        ]);

        try {
            DB::beginTransaction();

            $transaction->update([
                'total_price' => $validateProduct['total_price'],
                'paid_amount' => $validateProduct['paid_amount'],
                'change_amount' => $validateProduct['change_amount'],
                'payment_method' => $validateProduct['payment_method'],
                'user_id' => Auth::user()->id
            ]);

            DB::commit();

            return redirect('/dashboard/transaction/list-transaction')
                ->with('success', 'Transaksi dengan total '. $validateProduct['total_price'] .' Sukses Di Ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/dashboard/transaction/list-transaction')
                ->with('error', 'Gagal Menambahkan Transaksi. '. $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            DB::beginTransaction();
            
            $transaction->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data Transaksi Berhasil Terhapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Menghapus Data Transaksi: ' . $e->getMessage());
        }
    }
}
