<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesApiController;



Route::get('/articles', [ArticlesApiController::class, 'index']);

Route::get('/articles/', [ArticlesApiController::class, 'search']);

Route::get('/articles/{article}/viewarticle', [ArticlesApiController::class, 'show']);

Route::post('/articles/post', [ArticlesApiController::class, 'store']);

Route::put('/articles/{article}/update', [ArticlesApiController::class, 'update']);

Route::delete('/articles/{article}/delete', [ArticlesApiController::class, 'destroy']);

