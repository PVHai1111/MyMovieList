<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckKeywordRequest;
use App\Models\Movie;
use App\Models\Cat;

class SearchMovieController extends Controller
{
    //
    function search(CheckKeywordRequest $request)
    {
        $validate = $request->validated();
        $keyword = $validate['keyword'];
        $movies = Movie::where('name', 'LIKE', '%' . $keyword . '%')->paginate(18);
        $interaction_movies = Movie::getTopMoviesByComments(6);
        return view('user.movie.search_movie', compact('movies', 'keyword', 'interaction_movies'));
    }

    function filter($id)
    {
        $cat = Cat::find($id);
        $movies = $cat->movies()->paginate(18);
        $interaction_movies = Movie::getTopMoviesByComments(6);
        return view('user.movie.filter_movie', compact('cat', 'movies', 'interaction_movies'));
    }
}
