<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Services\CommentService;
use App\Services\FavoriteService;
use App\Models\Comment;

class UserMovieController extends Controller
{
    //
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    function show($id)
    {
        $movie = Movie::find($id);
        return view('user.movie.show', compact('movie'));
    }

    function push_comment(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('user_id') == Auth::user()->id) {
                if ($request->get('body')) {
                    if ($request->get('movie_id')) {
                        $data['user_id'] = Auth::user()->id;
                        $data['body'] = $request->get('body');
                        $data['commentable_id'] = $request->get('movie_id');
                        $data['comment_parent'] = null;
                        $comment = $this->commentService->createComment($data, \App\Models\Movie::class);
                        $comments = Movie::find($request->get('movie_id'))->comments;
                        return response()->json(['view' => view('user.movie.list_comments', compact('comments'))->render()]);
                    }
                } else {
                    return response()->json(['error' => 'Please enter comment content']);
                }
            } else {
                return response()->json(['error' => 'An error occurred. Reload the page and try again.']);
            }
        }
        return response()->json(['error' => 'You need to login to perform this function']);
    }

    function follow(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('user_id') == Auth::user()->id) {
                if ($request->get('movie_id')) {
                    $movie_id = $request->get('movie_id');
                    if (Auth::user()->hasFavorited($movie_id)) {
                        Auth::user()->removeFavorite($movie_id);
                    } else {
                        Auth::user()->addFavorite($movie_id);
                    }
                    return response()->json(['success' => 'Followed successfully']);
                }
            }
            return response()->json(['error' => 'An error occurred. Reload the page and try again.']);
        }
        return response()->json(['error' => 'You need to login to perform this function']);
    }

    function rating(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('user_id') == Auth::user()->id) {
                if ($request->get('movie_id')) {
                    $movie_id = (int) $request->get('movie_id');
                    $star = (int) $request->get('star');
                    if ($star >= 1 && $star <= 5) {
                        $rating = Auth::user()->updateMovieRating($movie_id, $star);
                        return response()->json(['success' => 'Rated Successfully']);
                    }
                }
            }
            return response()->json(['error' => 'An error occurred. Reload the page and try again.']);
        }
        return response()->json(['error' => 'You need to login to perform this function']);
    }
}
