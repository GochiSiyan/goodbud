<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::all()->random();
        $qty = $this->faker->numberBetween(1, 25);
        return [
            'product_id' => $product,
            'qty' => $qty,
            'total' => $qty * $product->price,
        ];
    }
}
