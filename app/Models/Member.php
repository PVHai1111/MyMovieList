<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'dod',
        'biography',
        'role',
        'thumb',
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'movie_members','member_id', 'movie_id');
    }
}
