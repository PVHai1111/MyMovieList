<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MovieCat;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieCat>
 */
class MovieCatFactory extends Factory
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
            'cat_id' => \App\Models\Cat::inRandomOrder()->first()->id,
        ];
    }
}
