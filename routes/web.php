<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | Dashboard
    */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('articles.dashboard');

    /*
    | Profile
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Articles
    */
    Route::get('/articles/home', [ArticlesController::class, 'home'])->name('articles.home');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/articles/add', [ArticlesController::class, 'addnewarticle'])->name('articles.add');
    Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}/delete', [ArticlesController::class, 'delete'])->name('articles.delete');
    Route::get('/articles/{article}/view', [ArticlesController::class, 'view'])->name('articles.view');

    /*
    | Users
    */
    Route::get('/users/home', [UsersController::class, 'usershomepage'])->name('users.homepage');
    Route::get('/users/add', function () {
        return view('users.add');
    })->name('users.add');

    Route::post('/users/create', [UsersController::class, 'addnewuser'])->name('users.create');
    Route::get('/users/{user}/edit', [UsersController::class, 'edituser'])->name('users.edit');
    Route::put('/users/{user}/update', [UsersController::class, 'updateuser'])->name('users.update');
    Route::delete('/users/{user}/delete', [UsersController::class, 'usersdelete'])->name('users.delete');
    Route::get('/users/{user}/view', [UsersController::class, 'usersview'])->name('users.view');
  
});