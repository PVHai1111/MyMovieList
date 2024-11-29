<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'body', 'commentable_id', 'commentable_type', 'comment_parent'];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'comment_parent');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'comment_parent');
    }
}
