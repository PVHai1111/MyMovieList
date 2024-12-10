<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Blog;
use App\Models\Movie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentableType = $this->faker->randomElement([Blog::class, Movie::class]);
        $commentable = $commentableType::inRandomOrder()->first(); // Get a random blog or movie
        return [
            'user_id' => User::inRandomOrder()->first()->id, // Random user
            'body' => $this->faker->sentence(), // Random comment body
            'commentable_id' => $commentable->id, // ID of related blog or movie
            'commentable_type' => $commentableType, // Either 'Blog' or 'Movie'
            'comment_parent' => null, // Set to null for root comments (or generate nested comments if needed)
        ];
    }
}
