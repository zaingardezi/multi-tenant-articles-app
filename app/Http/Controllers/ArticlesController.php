<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticlesController extends Controller
{
    use AuthorizesRequests;
   public function home(ArticleService $articleService)
{
    $this->authorize('viewAny',Article::class);
    $articles=$articleService->getArticles();
    return view('articles.home', compact('articles'));
}

   public function view(article $article)
   {
     $this->authorize('view', $article);
    return view('articles.view',compact('article'));
   }



public function addnewarticle(Request $request, ArticleService $articleService)
{
    $this->authorize('create', Article::class);
    $path = $request->file('Image')->store('articles', 'public');
    

    $data=[
        'Title' => $request->Title,
        'ShowDescription' => $request->ShowDescription,
        'Text' => $request->Text,
        
    ];
    $data['Image']=$path;
    $articleService->createArticle($data);




    return redirect()->route('articles.home');
}


public function create()
{
    $this->authorize('create', Article::class);
    return view('articles.add');
}

public function edit(Article $article)
{
    $this->authorize('update',$article);
    return view('articles.edit', compact('article'));
}

public function update(Request $request, Article $article, ArticleService $articleService)
{
    $this->authorize('update',$article);
    
    $data = [
        'Title' => $request->Title,
        'ShowDescription' => $request->ShowDescription,
        'Text' => $request->Text,
    ];

    if ($request->hasFile('Image')) {
        $data['Image'] = $request->file('Image')->store('articles', 'public');
    }
    $articleService->updateArticle($data,$article);
    

    return redirect()->route('articles.home');
}


public function delete(Article $article, ArticleService $articleService)
{
    $this->authorize('delete',$article);
    $articleService->deleteArticle($article);
    
    return redirect()->route('articles.home');
}



}
