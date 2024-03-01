<?php

namespace Database\Factories;

use App\Models\MenuProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MenuProduct>
 */
class MenuProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'menu_id' => 1,
            'product_id' => 1,
        ];
    }
}
