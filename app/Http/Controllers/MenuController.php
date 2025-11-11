<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         
         try {
            $recipes = Recipe::with(['menu', 'ingredient'])->latest()->get();

 
            $menus = $recipes->groupBy('menu_id')->map(function ($group) {
                return [
                    'menu_name' => $group->first()->menu->name ?? null,
                    'menu_price' => $group->first()->menu->price ?? null,
                    'menu_id' => $group->first()->menu->id ?? null,
                    'ingredients' => $group->map(function ($item) {
                        return [
                            'ingredient_name' => $item->ingredient->name ?? null,
                            'quantity_used' => $item->quantity_used,
                        ];
                    })
                ];
            });

            // Cek kalau data kosong
            if ($menus->isEmpty()) {
                return redirect()->back()->with('error', 'Menu tidak ditemukan.');
            }

            // Kirim data ke view
            return view('menu.listMenu', compact('menus'));
        } catch (\Exception $e) {
            abort(404);
        }

        // // Ambil semua data recipe beserta relasi menu dan ingredient
        //     $recipes = Recipe::with(['menu', 'ingredient'])->get();

        //     // Ubah data menjadi format JSON yang hanya berisi field yang kamu butuhkan
        //     $data = $recipes->map(function ($recipe) {
        //         return [
        //             'menu_name' => $recipe->menu->name ?? null,
        //             'menu_price' => $recipe->menu->price ?? null,
        //             'ingredient_name' => $recipe->ingredient->name ?? null,
        //             'quantity_used' => $recipe->quantity_used,
        //         ];
        //     });

        //     return response()->json([
        //         'success' => true,
        //         'data' => $data
        //     ]);

        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan saat mengambil data',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{

            $ingredients = Ingredient::select('id', 'name')->get();
            return view('menu.createMenu', compact ('ingredients'));

            if(!$ingredients){
                return redirect()->back()->with('error', 'Mohon Inputkan Data Bahan Baku Terlebih Dahulu.');
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
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.ingredient_id' => 'required|uuid|exists:ingredients,id',
            'ingredients.*.quantity_used' => 'required|numeric|min:1',
        ]);

        try {
            DB::beginTransaction();

            $menu = Menu::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
            ]);

            foreach ($validated['ingredients'] as $ingredient) {
                Recipe::create([
                    'menu_id' => $menu->id,
                    'ingredient_id' => $ingredient['ingredient_id'],
                    'quantity_used' => $ingredient['quantity_used'],
                ]);
            }

            DB::commit();
            return redirect()
                ->route('menu.index')
                ->with('success', 'Menu "' . $menu->name . '" berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan menu: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($menuId)
    {
        try {
            $menu = Menu::with(['recipe.ingredient'])->findOrFail($menuId);

            $ingredientsData = $menu->recipe->map(function($recipe) {
                return [
                    'ingredient_id' => $recipe->ingredient_id,
                    'quantity_used' => $recipe->quantity_used,
                ];
            });

            return view('menu.editMenu', [
                'menu' => $menu,
                'ingredientsData' => $ingredientsData,
                'allIngredients' => Ingredient::all()
            ]);

        } catch (\Exception $e) {
            abort(404);
        }
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        try {
            DB::beginTransaction();

            $menuName = $menu->name;

            Recipe::where('menu_id', $menu->id)->delete();

            
            $menu->delete();

            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Menu "' . $menuName . '" dan semua bahan terkait berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }

    public function getMenuData(): JsonResponse
    {
        try {
            $menus = Menu::with(['recipe.ingredient'])->get();

            $data = $menus->map(function ($menu) {
                $maxPortion = null;

                if ($menu->recipe->isNotEmpty()) {
                    $maxPortion = $menu->recipe
                        ->map(fn($recipe) => $recipe->ingredient?->stock ?? 0)
                        ->min();
                } else {
                    $maxPortion = 0;
                }

                return [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'max_portion' => $maxPortion,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data menu',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    
}
