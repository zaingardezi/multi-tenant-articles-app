<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
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
    Route::get('/articles/{article}/view', [ArticlesController::class, 'show'])->name('articles.view');
    Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
    Route::post('/articles/add', [ArticlesController::class, 'store'])->name('articles.add');
    Route::get('/articles/{article}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}/update', [ArticlesController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}/delete', [ArticlesController::class, 'destroy'])->name('articles.delete');

    Route::get('/dashboard', fn () => view('dashboard'))->name('articles.dashboard');

    Route::resource('profile', ProfileController::class)
        ->only(['edit', 'update', 'destroy']);

    
    






Route::get('/categories',[CategoriesController::class,'view'])->name('categories.home');
Route::get('/categories/create', [CategoriesController::class, 'createcategory'])->name('categories.create');
Route::post('/categories', [CategoriesController::class, 'addcategory'])->name('categories.add');

Route::get('/categories/{category}', [CategoriesController::class, 'viewcategory'])->name('categories.viewcategory');

Route::get('/categories/{category}/edit', [CategoriesController::class, 'editcategory'])->name('categories.edit');
Route::put('/categories/{category}', [CategoriesController::class, 'updatecategory'])->name('categories.update');

Route::delete('/categories/{category}', [CategoriesController::class, 'deletecategory'])->name('categories.delete');




Route::get('/tags', [TagsController::class, 'view'])->name('tags.home');

Route::get('/tags/create', [TagsController::class, 'createtag'])->name('tags.create');
Route::post('/tags', [TagsController::class, 'addtag'])->name('tags.add');

Route::get('/tags/{tag}', [TagsController::class, 'viewtag'])->name('tags.viewtag');

Route::get('/tags/{tag}/edit', [TagsController::class, 'edittag'])->name('tags.edit');
Route::put('/tags/{tag}', [TagsController::class, 'updatetag'])->name('tags.update');

Route::delete('/tags/{tag}', [TagsController::class, 'deletetag'])->name('tags.delete');


    



Route::get('/authors', [AuthorsController::class, 'view'])->name('authors.home');


Route::get('/authors/create', [AuthorsController::class, 'createauthor'])->name('authors.create');
Route::post('/authors', [AuthorsController::class, 'addauthor'])->name('authors.add');

Route::get('/authors/{author}', [AuthorsController::class, 'viewauthor'])->name('authors.viewauthor');

Route::get('/authors/{author}/edit', [AuthorsController::class, 'editauthor'])->name('authors.edit');
Route::put('/authors/{author}', [AuthorsController::class, 'updateauthor'])->name('authors.update');

Route::delete('/authors/{author}', [AuthorsController::class, 'deleteauthor'])->name('authors.delete');

});