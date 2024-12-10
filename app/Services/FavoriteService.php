<?php

namespace App\Services;

use App\Models\Favorite;
use Illuminate\Support\Facades\Hash;

class FavoriteService
{
    public function createFavorite(array $data)
    {
        return Favorite::create([
            'user_id' => $data['user_id'],
            'movie_id' => $data['movie_id']
        ]);
    }
}
