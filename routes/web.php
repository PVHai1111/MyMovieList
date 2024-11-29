<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserMovieController;
use App\Http\Controllers\User\SearchMovieController;
use App\Http\Controllers\User\UserBlogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/register', [UserController::class, 'register'])->name('user.register');
Route::post('/register/submit', [UserController::class, 'register_handle'])->name('user.register.submit');
Route::get('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/login/submit', [UserController::class, 'login_handle'])->name('user.login.submit');
Route::middleware('auth')->group(function () {
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
});

Route::prefix('movie')->group(function () {
    Route::get('{id}', [UserMovieController::class, 'show'])->where('id', '[0-9]+')->name('user.movie.show');
    Route::middleware('auth')->group(function () {
        Route::post('comment/send', [UserMovieController::class, 'push_comment'])->name('user.movie.push_comment');
        Route::get('follow', [UserMovieController::class, 'follow'])->name('user.movie.follow');
        Route::get('rating', [UserMovieController::class, 'rating'])->name('user.movie.rating');
    });
    Route::get('search', [SearchMovieController::class, 'search'])->name('user.movie.search');
    Route::get('filter/cat/{id}', [SearchMovieController::class, 'filter'])->name('user.movie.filter');
});

Route::prefix('blog')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('show', [UserBlogController::class, 'show'])->name('user.blog.show');
        Route::get('add', [UserBlogController::class, 'add'])->name('user.blog.add');
        Route::post('store', [UserBlogController::class, 'store'])->name('user.blog.store');
        Route::get('edit/{id}', [UserBlogController::class, 'edit'])->name('user.blog.edit');
        Route::post('update/{id}', [UserBlogController::class, 'update'])->name('user.blog.update');
        Route::get('delete/{id}', [UserBlogController::class, 'delete'])->name('user.blog.delete');
        Route::post('comment', [UserBlogController::class, 'comment'])->name('user.blog.comment');
    });
    Route::get('all', [UserBlogController::class, 'all'])->name('user.blog.all');
    Route::get('detail/{id}', [UserBlogController::class, 'detail'])->name('user.blog.detail');
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::prefix('cat')->group(function () {
        Route::get('/show', [CatController::class, 'show'])->name('cat.show');
        Route::get('/add', [CatController::class, 'add'])->name('cat.add');
        Route::post('/store', [CatController::class, 'store'])->name('cat.store');
        Route::get('/edit/{id}', [CatController::class, 'edit'])->name('cat.edit');
        Route::post('/update/{id}', [CatController::class, 'update'])->name('cat.update');
        Route::get('/delete/{id}', [CatController::class, 'delete'])->name('cat.delete');
    });
    Route::prefix('member')->group(function () {
        Route::get('/show', [MemberController::class, 'show'])->name('member.show');
        Route::get('/add', [MemberController::class, 'add'])->name('member.add');
        Route::post('/store', [MemberController::class, 'store'])->name('member.store');
        Route::get('/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('/update/{id}', [MemberController::class, 'update'])->name('member.update');
        Route::get('/delete/{id}', [MemberController::class, 'delete'])->name('member.delete');
    });
    Route::prefix('movie')->group(function () {
        Route::get('/show', [MovieController::class, 'show'])->name('movie.show');
        Route::get('/add', [MovieController::class, 'add'])->name('movie.add');
        Route::post('/store', [MovieController::class, 'store'])->name('movie.store');
        Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('movie.edit');
        Route::post('/update/{id}', [MovieController::class, 'update'])->name('movie.update');
        Route::get('/delete/{id}', [MovieController::class, 'delete'])->name('movie.delete');
    });
});
