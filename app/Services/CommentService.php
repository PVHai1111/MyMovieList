<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Hash;

class CommentService
{
    public function createComment(array $data, $class)
    {
        return Comment::create([
            'user_id' => $data['user_id'],
            'body' => $data['body'],
            'commentable_id' => $data['commentable_id'],
            'commentable_type' => $class,
            'comment_parent' => $data['comment_parent']
        ]);
    }
}
