<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'dob' => fake()->date(),
            'dod' => fake()->optional()->date(),
            'biography' => fake()->paragraph(),
            'role' => fake()->randomElement(['director', 'actor']),
            'thumb' => fake()->imageUrl(100, 100),
        ];
    }
}
