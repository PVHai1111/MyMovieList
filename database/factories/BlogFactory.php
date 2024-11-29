<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(), // Tạo tiêu đề ngẫu nhiên
            'content' => $this->faker->paragraph(), // Tạo nội dung ngẫu nhiên
            'user_id' => User::inRandomOrder()->first()->id, // Chọn user_id ngẫu nhiên từ bảng users
        ];
    }
}
