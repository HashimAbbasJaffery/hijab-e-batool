<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $quantity = fake()->numberBetween(1, 1000);
        $soldQty = fake()->numberBetween($quantity, $quantity + 100);
        $name = fake()->name();
        $slug = str_replace(" ", "-", $name);
        $price = fake()->numberBetween(500, 1000);
        $wholeSale = fake()->numberBetween(2, $price - 1);
        $amountSpent = $wholeSale * ($quantity + $soldQty);
        return [
            "name" => $name,
            "picture" => fake()->imageUrl(300, 300, "animal", true),
            "price" => $price,
            "wholeSalePrice" => $wholeSale,
            "profit" => ($price * $soldQty) - $amountSpent, // Creating profit/loss from that product
            "description" => "<p>" . implode("</p><p> ", fake()->paragraphs(2)) . "</p>",
            "quantity" => $quantity,
            "slug" => $slug,
            "soldQuantity" => $soldQty,
            "status" => fake()->boolean()
        ];
    }
}
