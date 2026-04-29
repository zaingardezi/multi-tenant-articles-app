<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;



Route::get('/articles', [ArticlesController::class, 'index']);