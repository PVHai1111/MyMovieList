<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;
use App\Models\Cat;
use App\Models\MovieCat;
use App\Models\Member;
use App\Models\MovieMember;
use App\Models\Favorite;
use App\Models\Rating;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Serie;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(20)->create();
        // Movie::factory(20)->create();
        // Cat::factory(20)->create();
        // MovieCat::factory(20)->create();
        // Member::factory(20)->create();
        // MovieMember::factory(20)->create();
        // Favorite::factory(20)->create(); 
        // Rating::factory(20)->create();
        // Blog::factory(100)->create(); 
        // Comment::factory(2000)->create();
        Serie::factory()->count(100)->create();
    }
}
