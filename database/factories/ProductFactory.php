<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productCategory = ProductCategory::inRandomOrder()->first();
        return [
            'product_category_id' => $productCategory->id,
            'name' => $this->faker->name,
            'price' => rand(1000, 100000),
            'active' => $this->faker->boolean,
        ];
    }
}
