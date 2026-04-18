<?php

use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Route;



Route::get('/aricles/home', [ArticlesController::class, 'home'])->name('articles.home');
Route::get('/', function()
{
    return view('welcome');
})->name('articles.dashboard');


Route::get('/articles/create', function () {
    return view('articles.add');
})->name('articles.create');

Route::post('/articles', [ArticlesController::class, 'addnewarticle'])->name('articles.add');
Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}/update', [ArticlesController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}/delete', [ArticlesController::class, 'delete'])->name('articles.delete');


