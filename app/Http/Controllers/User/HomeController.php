<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Cat;
use App\Models\Member;

class HomeController extends Controller
{
    function index()
    {
        $trending_movies = Movie::topRatedMovies(6);
        $popular_movies = Movie::mostFavoritedMovies(6);
        $top_cats = Cat::topCategories(2);
        $interaction_movies = Movie::getTopMoviesByComments(6);
        return view('user.home.index', compact('trending_movies', 'popular_movies', 'top_cats','interaction_movies'));
    }
}
