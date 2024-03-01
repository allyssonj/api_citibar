<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create user with related menu, products and menu_products
        User::factory()->count(10)->create()->each(function ($user) {
            Menu::factory()->count(1)->create(['user_id' => $user->id])->each(function ($menu) use ($user) {
                Product::factory()->count(5)->create(['user_id' => $user->id])->each(function ($product) use ($menu) {
                    MenuProduct::factory()->count(1)->create(['menu_id' => $menu->id, 'product_id' => $product->id]);
                });
            });
        });
    }
}
