<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
   public function home(ArticleService $articleService)
{
    $articles=$articleService->getArticles();
    return view('articles.home', compact('articles'));
}

   public function view(article $article)
   {
    return view('articles.view',compact('article'));
   }

public function addnewarticle(Request $request, ArticleService $articleService)
{
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
    return view('articles.add');
}

public function edit(Article $article)
{
    return view('articles.edit', compact('article'));
}

public function update(Request $request, Article $article, ArticleService $articleService)
{
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


public function delete(Article $article)
{
    $article->delete();
    return redirect()->route('articles.home');
}



}
