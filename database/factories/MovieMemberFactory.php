<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieMember>
 */
class MovieMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => \App\Models\Movie::inRandomOrder()->first()->id,
            'member_id' => \App\Models\Member::inRandomOrder()->first()->id,
        ];
    }
}
