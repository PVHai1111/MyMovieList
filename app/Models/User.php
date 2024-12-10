<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function favorites()
    {
        return $this->belongsToMany(Movie::class, 'favorites', 'user_id', 'movie_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id');
    }

    public function hasFavorited($movieId)
    {
        return $this->favorites()->where('movie_id', $movieId)->exists();
    }

    public function addFavorite($movieId)
    {
        if (!$this->hasFavorited($movieId)) {
            $this->favorites()->attach($movieId);
        }
    }

    public function removeFavorite($movieId)
    {
        if ($this->hasFavorited($movieId)) {
            $this->favorites()->detach($movieId);
        }
    }

    public function getRatingForMovie($movieId)
    {
        $rating = $this->ratings()->where('movie_id', $movieId)->first();

        if ($rating) {
            return $rating->star;
        }

        return 0;
    }

    protected function findOrCreateRating(int $movieId)
    {
        $rating = $this->ratings()->where('movie_id', $movieId)->first();

        if (!$rating) {
            $rating = new Rating();
            $rating->movie_id = $movieId;
        }

        return $rating;
    }


    protected function saveRating(Rating $rating, int $star)
    {
        $rating->star = $star;
        $rating->user_id = $this->id;
        $rating->save();

        return $rating;
    }


    public function updateMovieRating(int $movieId, int $star)
    {
        $rating = $this->findOrCreateRating($movieId);
        return $this->saveRating($rating, $star);
    }

    public function createBlog(array $data)
    {
        return $this->blogs()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'thumb' => $data['thumb']
        ]);
    }

    public function ownsBlog($blogId)
    {
        return $this->blogs()->where('id', $blogId)->exists();
    }
}
