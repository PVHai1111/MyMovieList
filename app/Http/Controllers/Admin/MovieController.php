<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Movie;
use App\Models\Member;
use App\Http\Requests\StoreMovieRequest;
use App\Services\MovieService;
use App\Models\Serie;
class MovieController extends Controller
{
    //
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }
    function show()
    {
        $movies = Movie::orderBy('created_at', 'DESC')->paginate(10);
        $count = 1;
        return view('admin.movies.show', compact('movies', 'count'));
    }

    function add()
    {
        $cats = Cat::orderBy('created_at')->get();
        $series = Serie::orderBy('created_at')->get();
        $members = Member::orderBy('created_at')->get();
        return view('admin.movies.add', compact('cats', 'members','series'));
    }

    function store(StoreMovieRequest $request)
    {
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->movieService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
            $movie = $this->movieService->createMovie($validate);
            $movie->cats()->attach($validate['cat_ids']);
            $movie->members()->attach($validate['member_ids']);
            return redirect()->route('movie.show');
        }
        return back()->withErrors(['file_error' => 'Thumb not empty']);
    }

    function edit($id){
        $movie = Movie::find($id);
        $series = Serie::orderBy('created_at')->get();
        $cats = Cat::orderBy('name')->get();
        $members = Member::orderBy('name')->get();
        return view('admin.movies.edit', compact('movie', 'cats', 'members','series'));
    }

    function update($id, StoreMovieRequest $request){
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->movieService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
        } else $validate['thumb'] = Movie::find($id)->thumb;
        $movie = $this->movieService->updateMovie($id, $validate);
        $movie->cats()->sync($validate['cat_ids']);
        $movie->members()->sync($validate['member_ids']);
        return redirect()->route('movie.show');
    }

    function delete($id){
        $movie = Movie::find($id);
        $movie->delete();
        return back();
    }
}
