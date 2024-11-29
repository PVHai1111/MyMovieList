<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'duration', 'thumb', 'release_year', 'serie_id'];
    public function cats()
    {
        return $this->belongsToMany(Cat::class, 'movie_cats', 'movie_id', 'cat_id');
    }
    public function members()
    {
        return $this->belongsToMany(Member::class, 'movie_members', 'movie_id', 'member_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'movie_id');
    }

    public function calculateRating()
    {
        return number_format($this->ratings()->avg('star'), 1);
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    public static function topRatedMovies($limit = 6)
    {
        return self::with('ratings')
            ->withCount(['ratings as avg_rating' => function ($query) {
                $query->select(DB::raw('AVG(star)'));
            }])
            ->orderByDesc('avg_rating')
            ->take($limit)
            ->get();
    }

    public static function mostFavoritedMovies($limit = 6)
    {
        return self::withCount('favorites')
            ->orderByDesc('favorites_count')
            ->take($limit)
            ->get();
    }

    public function getDirectors()
    {
        return $this->members()->where('role', 'director')->get();
    }

    public function getActors()
    {
        return $this->members()->where('role', 'actor')->get();
    }

    public static function getTopMoviesByComments($limit = 6)
    {
        return self::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take($limit)
            ->get();
    }

    public function getMoviesInSameSerieWithoutCurrent()
    {
        $serieId = $this->serie_id;

        return self::where('serie_id', $serieId)
                    ->where('id', '!=', $this->id)
                    ->get();
    }
}
