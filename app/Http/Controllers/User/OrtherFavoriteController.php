<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OrtherFavoriteController extends Controller
{
    //
    function show()
    {
        $list_people = User::where('favorite_status', 1)->paginate(10);
        return view('user.other_favorite.show', compact('list_people'));
    }

    function favorites($id)
    {
        $user = User::find($id);
        if ($user->favorite_status) {
            $movies = $user->favorites()->paginate(10);
            return view('user.other_favorite.list_favorites', compact('movies', 'user'));
        }
        return redirect()->back()->withErrors(['error' => 'You do not have access']);
    }
}
