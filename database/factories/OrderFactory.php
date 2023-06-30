<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random = Str::random(8);
        $status = ["Delivered", "Dispatched", "Pending", "Cancelled"];
        $statusSelection = fake()->numberBetween(0, 3);
        return [
            "order_number" => $random,
            "user_id" => 14,
            "grand_total" => fake()->numberBetween(500, 1000),
            "payment_method" => "COD",
            "product_id" => 1,
            "status" => $status[$statusSelection]
        ];
    }
}
