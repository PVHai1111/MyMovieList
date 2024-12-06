<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    function show(){
        $comments = Comment::orderBy('created_at')->paginate(10);
        $count = 1;
        return view('admin.comments.show', compact('comments', 'count'));
    }

    function detail($id){
        $comment = Comment::find($id);
        return view('admin.comments.detail', compact('comment'));
    }

    function delete($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('admin.comment.show');
    }
}
