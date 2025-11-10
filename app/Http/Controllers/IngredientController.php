<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $ingredients = Ingredient::latest()->get();
            return view('ingredient.listIngredient', compact ('ingredients'));

            if(!$ingredient){
                return redirect()->back()->with('message', 'Data Bahan Baku tidak ditemukan.');
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
        return view('ingredient.createIngredient');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateIngredient = $request->validate([
            'name' => 'required|unique:ingredients,name',
            'stock' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            Ingredient::create($validateIngredient);


            DB::commit();

            return redirect('/dashboard/ingredient')
                ->with('success', 'Bahan Baku bernama '. $validateIngredient['name'] .' dengan stock '. $validateIngredient['stock'] .' Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect('/dashboard/ingredient')
                ->with('error', 'Gagal Menambahkan Bahan Baku. '. $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuidIngredient)
    {
         try{

            $ingredient = Ingredient::find($uuidIngredient);
            return view('ingredient.editIngredient', compact ('ingredient'));

            if(!$ingredient){
                return redirect()->back()->with('error', 'Data Bahan Baku tidak ditemukan.');
            }

        }catch (\Exception $e){
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
       
        $validateIngredient = $request->validate([
            'name' => ['required', Rule::unique('ingredients')->ignore($ingredient->id)],
            'stock' => 'required|integer',
        ]);
        

        try {
            DB::beginTransaction();

            $ingredient->update($validateIngredient);

            DB::commit();

            return redirect('/dashboard/ingredient')
                ->with('success', 'Bahan Baku bernama '. $validateIngredient['name'] .' dengan stock '. $validateIngredient['stock'] .' Berhasil Di Ubah');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/dashboard/ingredient')
                ->with('error', 'Gagal Mengubah Data Bahan Baku. '. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        try {
            DB::beginTransaction();
            $ingredientName = $ingredient->name;
            $ingredient->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Data Bahan Baku '.$ingredientName.' Berhasil Terhapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal Menghapus Data Bahan Baku ' . $e->getMessage());
        }
    }
}
