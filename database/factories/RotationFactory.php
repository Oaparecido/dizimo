<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Community;
use App\Models\Rotation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rotation>
 */
class RotationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'agent_id' => Agent::factory(),
            'community_id' => Community::factory(),
            'day_of_week' => fake()->numberBetween(0, 6),
            'week_occurrence' => fake()->numberBetween(1, 4),
            'time' => fake()->randomElement(['08:00', '19:00']),
        ];
    }
}
