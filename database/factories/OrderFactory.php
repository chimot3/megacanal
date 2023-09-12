<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => mt_rand(1, 1000),
            'date' => $this->faker->dateTime('now'),
            'supplier_name' => $this->faker->company(),
            'product_name' => $this->faker->sentence(2),
            'total' => $this->faker->randomFloat(0, 100000, 1000000)
        ];
    }
}
