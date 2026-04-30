<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;



Route::get('/articles', [ArticlesController::class, 'index']);

Route::get('/articles/category', [ArticlesController::class, 'articlesCategoryApi']);

Route::get('/articles/tag', [ArticlesController::class, 'articlesTagApi']);

Route::get('/articles/{article}/viewarticle', [ArticlesController::class, 'viewArticleApi']);

route::post('/articles/post', [ArticlesController::class, 'addArticleApi']);

route::put('/articles/{article}/update', [ArticlesController::class, 'updateArticleApi']);

route::delete('/articles/{article}/delete', [ArticlesController::class, 'deleteArticleApi']);

