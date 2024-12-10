<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rating;
use App\Models\Movie;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::inRandomOrder()->first()->id, // Lấy movie ngẫu nhiên
            'user_id' => User::inRandomOrder()->first()->id,   // Lấy user ngẫu nhiên
            'star' => fake()->randomElement(['1', '2', '3', '4', '5']), // Giá trị ngẫu nhiên từ 1 đến 5
        ];
    }
}
