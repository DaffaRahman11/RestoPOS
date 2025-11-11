<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Stock_Mutation;
use Illuminate\Database\Seeder;
use App\Models\Transaction_Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Users
        $users = User::factory()->count(5)->create();

         User::create([
            'id' => Str::uuid(), // kalau kamu pakai UUID
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // hash password
            'email_verified_at' => now(),
        ]);


        // 2️⃣ Ingredients (bahan baku)
        $ingredients = [
            ['name' => 'Beras', 'stock' => 10000],
            ['name' => 'Telur', 'stock' => 500],
            ['name' => 'Ayam', 'stock' => 300],
            ['name' => 'Daging Sapi', 'stock' => 200],
            ['name' => 'Tahu', 'stock' => 400],
            ['name' => 'Tempe', 'stock' => 350],
            ['name' => 'Cabai', 'stock' => 200],
            ['name' => 'Bawang Merah', 'stock' => 500],
            ['name' => 'Bawang Putih', 'stock' => 500],
            ['name' => 'Kecap Manis', 'stock' => 100],
            ['name' => 'Minyak Goreng', 'stock' => 1000],
            ['name' => 'Kopi Bubuk', 'stock' => 200],
            ['name' => 'Susu Cair', 'stock' => 150],
            ['name' => 'Gula Pasir', 'stock' => 500],
            ['name' => 'Es Batu', 'stock' => 300],
        ];

        foreach ($ingredients as $item) {
            Ingredient::create([
                'id' => Str::uuid(),
                'name' => $item['name'],
                'stock' => $item['stock'],
            ]);
        }

        // 3️⃣ Menus (produk)
        $menus = [
            ['name' => 'Nasi Goreng Spesial', 'price' => 25000],
            ['name' => 'Ayam Geprek', 'price' => 22000],
            ['name' => 'Mie Goreng', 'price' => 20000],
            ['name' => 'Nasi Ayam Teriyaki', 'price' => 28000],
            ['name' => 'Soto Ayam', 'price' => 23000],
            ['name' => 'Tahu Crispy', 'price' => 15000],
            ['name' => 'Tempe Mendoan', 'price' => 12000],
            ['name' => 'Kopi Hitam', 'price' => 10000],
            ['name' => 'Kopi Susu Gula Aren', 'price' => 18000],
            ['name' => 'Cappuccino', 'price' => 20000],
            ['name' => 'Latte', 'price' => 20000],
            ['name' => 'Es Teh Manis', 'price' => 8000],
            ['name' => 'Es Jeruk', 'price' => 9000],
            ['name' => 'Nasi Uduk', 'price' => 22000],
            ['name' => 'Nasi Kuning', 'price' => 22000],
            ['name' => 'Bakso Sapi', 'price' => 25000],
            ['name' => 'Sate Ayam', 'price' => 30000],
            ['name' => 'Ayam Goreng Tepung', 'price' => 24000],
            ['name' => 'Nasi Ayam Rica-Rica', 'price' => 26000],
            ['name' => 'Ice Americano', 'price' => 15000],
        ];

        foreach ($menus as $m) {
            Menu::create([
                'id' => Str::uuid(),
                'name' => $m['name'],
                'price' => $m['price'],
            ]);
        }

        // 4️⃣ Recipes (resep menu)
        $allMenus = Menu::all();
        $allIngredients = Ingredient::all();

        foreach ($allMenus as $menu) {
            $usedIngredients = $allIngredients->random(rand(2, 4));
            foreach ($usedIngredients as $ingredient) {
                Recipe::create([
                    'id' => Str::uuid(),
                    'menu_id' => $menu->id,
                    'ingredient_id' => $ingredient->id,
                    'quantity_used' => rand(10, 100),
                ]);
            }
        }

        // 5️⃣ Transactions + Details
        $users = User::all();
        $menus = Menu::all();

        for ($i = 0; $i < 25; $i++) {
            $transaction = Transaction::create([
                'id' => Str::uuid(),
                'total_price' => 0,
                'paid_amount' => 0,
                'change_amount' => 0,
                'payment_method' => fake()->randomElement(['cash', 'debit', 'card', 'ewallet']),
                'user_id' => $users->random()->id,
            ]);

            $selectedMenus = $menus->random(rand(2, 5));
            $total = 0;

            foreach ($selectedMenus as $menu) {
                $qty = rand(1, 3);
                $subtotal = $menu->price * $qty;

                Transaction_Detail::create([
                    'id' => Str::uuid(),
                    'transaction_id' => $transaction->id,
                    'menu_id' => $menu->id,
                    'quantity' => $qty,
                    'unit_price' => $menu->price,
                    'subtotal' => $subtotal,
                ]);

                $total += $subtotal;
            }

            $paid = $total + rand(0, 10000);

            $transaction->update([
                'total_price' => $total,
                'paid_amount' => $paid,
                'change_amount' => $paid - $total,
            ]);
        }

        // 6️⃣ Stock Mutations
        $ingredients = Ingredient::all();
        foreach ($ingredients as $ing) {
            Stock_Mutation::create([
                'id' => Str::uuid(),
                'ingredient_id' => $ing->id,
                'type' => fake()->randomElement(['in', 'out']),
                'reference' => fake()->uuid(),
                'note' => 'Auto mutation',
                'quantity' => rand(5, 100),
            ]);
        }
    }
}
