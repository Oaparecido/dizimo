<?php

namespace Database\Factories;

use App\Models\Tither;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tither>
 */
class TitherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'birth_date' => fake()->date(),
            'partner_name' => fake()->name(),
        ];
    }
}
