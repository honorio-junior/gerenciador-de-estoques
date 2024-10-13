<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stock_id' => Stock::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'name' => fake()->word,
            'amount' => fake()->numberBetween(1, 100),
            'price' => fake()->randomFloat(2, 1, 1000), // Valor entre 1.00 e 1000.00
        ];
    }
}
