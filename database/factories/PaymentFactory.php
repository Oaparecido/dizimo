<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Payment;
use App\Models\Tither;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'tither_id' => Tither::factory(),
            'agent_id' => Agent::factory(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'payment_date' => fake()->date(),
            'payment_time' => fake()->randomElement(['08:00', '19:00']),
            'reference_month' => fake()->numberBetween(1, 12),
            'reference_year' => fake()->year(),
        ];
    }
}
