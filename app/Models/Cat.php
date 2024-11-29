<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_cats', 'cat_id', 'movie_id');
    }

    public static function topCategories($limit = 2)
    {
        return self::withCount('movies') 
            ->orderByDesc('movies_count') 
            ->take($limit)
            ->get();
    }
}
