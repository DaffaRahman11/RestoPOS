<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $products = Product::get();
            return view('product.listProduct', compact ('products'));

            if(!$products){
                return redirect()->back()->with('message', 'Produk tidak ditemukan.');
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
        $categories = Category::get();
        return view('product.createProduct', compact ('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateProduct = $request->validate([
            'barcode' => 'required|unique:products,barcode',
            'name' => 'required|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'purchase_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            Product::create([
                'barcode' => $validateProduct['barcode'],
                'name' => $validateProduct['name'],
                'category_id' => $validateProduct['category_id'],
                'purchase_price' => $validateProduct['purchase_price'],
                'selling_price' => $validateProduct['selling_price'],
                'stock' => $validateProduct['stock'],
                // 'user_id' => Auth::user()->id
            ]);

            // Product::where('id', $id)->update(
            //     array_merge($validateProduct, [
            //         'user_id' => Auth::id(), // field tambahan
            //         'updated_at' => now(),   // bisa override timestamp manual kalau mau
            //     ])
            // );


            DB::commit();

            return redirect('/dashboard/product')
                ->with('success', 'Produk bernama '. $validateProduct['name'] .' dengan stock '. $validateProduct['stock'] .' Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect('/dashboard/product')
                ->with('error', 'Gagal Menambahkan Product. '. $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuidProduct)
    {
         try{

            $product = Product::find($uuidProduct);
            $categories = Category::get();
            return view('product.editProduct', compact ('product', 'categories'));

            if(!$products){
                return redirect()->back()->with('message', 'Produk tidak ditemukan.');
            }

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
       
        $validateProduct = $request->validate([
            'barcode' => ['required', Rule::unique('products')->ignore($product->id)],
            'name' => ['required', Rule::unique('products')->ignore($product->id)],
            'category_id' => 'required|uuid|exists:categories,id',
            'purchase_price' => 'required|integer',
            'selling_price' => 'required|integer',
            'stock' => 'required|integer',
        ]);
        

        try {
            DB::beginTransaction();

            $product->update([
                'barcode' => $validateProduct['barcode'],
                'name' => $validateProduct['name'],
                'category_id' => $validateProduct['category_id'],
                'purchase_price' => $validateProduct['purchase_price'],
                'selling_price' => $validateProduct['selling_price'],
                'stock' => $validateProduct['stock'],
                // 'user_id' => Auth::user()->id
            ]);

            // Product::where('id', $id)->update(
            //     array_merge($validateProduct, [
            //         'user_id' => Auth::id(), // field tambahan
            //         'updated_at' => now(),   // bisa override timestamp manual kalau mau
            //     ])
            // );


            DB::commit();

            return redirect('/dashboard/product')
                ->with('success', 'Produk bernama '. $validateProduct['name'] .' dengan stock '. $validateProduct['stock'] .' Berhasil Di Ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/dashboard/product')
                ->with('error', 'Gagal Mengubah Data Product. '. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            
            $product->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data Produk Berhasil Terhapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Menghapus Data Produk: ' . $e->getMessage());
        }
    }

    public function getProductData()
    {
        try {
            $products = Product::with('category')
                ->select('id','barcode', 'name', 'category_id', 'selling_price', 'stock')
                ->get();

            if ($products->isEmpty()) {
                return response()->json(['message' => 'Produk tidak ditemukan.'], 404);
            }

            return response()->json($products);

        } catch (\Exception $e) {
            Log::error('Error fetching product data: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data produk.'], 500);
        }
    }

}
