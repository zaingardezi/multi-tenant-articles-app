<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\UsersController;



Route::get('/', function () {
    return view('auth.login');
});



require __DIR__.'/auth.php';



Route::middleware(['auth'])->group(function () {

    Route::get('/users/home', [UsersController::class, 'usershomepage'])->name('users.homepage');
    Route::get('/users/{user}/view', [UsersController::class, 'usersview'])->name('users.view');
    Route::get('/users/{user}/edit', [UsersController::class, 'edituser'])->name('users.edit');
    Route::put('/users/{user}/update', [UsersController::class, 'updateuser'])->name('users.update');
    Route::delete('/users/{user}/delete', [UsersController::class, 'usersdelete'])->name('users.delete');

    Route::get('/articles/home', [ArticlesController::class, 'home'])->name('articles.home');
    Route::get('/articles/{article}/view', [ArticlesController::class, 'view'])->name('articles.view');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/articles/add', [ArticlesController::class, 'addnewarticle'])->name('articles.add');
    Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}/delete', [ArticlesController::class, 'delete'])->name('articles.delete');

    Route::get('/dashboard', fn () => view('dashboard'))->name('articles.dashboard');

    Route::resource('profile', ProfileController::class)
        ->only(['edit', 'update', 'destroy']);
});