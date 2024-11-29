<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'user_id', 'thumb'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable');
    }

    public function parentComments()
    {
        return $this->comments()->whereNull('comment_parent');
    }
}
