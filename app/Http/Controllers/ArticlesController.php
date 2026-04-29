<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
class ArticlesController extends Controller
{
    use AuthorizesRequests;
   public function home(ArticleService $articleService)
{
    $this->authorize('viewAny',Article::class);
    $articles=$articleService->getArticles();
    return view('articles.home', compact('articles'));
}

public function view(Article $article)
{
    $this->authorize('view', $article);

    $article->load(['authors', 'tags', 'categories']);

    return view('articles.view', compact('article'));
}

public function edit(Article $article)
{
    $this->authorize('update',$article);
    $article->load(['tags','categories','authors']);
   return view('articles.edit', [
        'article' => $article,
        'authors' => Author::all(),
        'tags' => Tag::all(),
        'categories' => Category::all(),
    ]);
}

public function addnewarticle(Request $request, ArticleService $articleService)
{

    $this->authorize('create', Article::class);
    $request->validate([
    'Title' => 'required|string|max:255',
    'ShowDescription' => 'required|string|max:255',
    'Text' => 'required|string',
    'Image' => 'required|image|mimes:jpg,jpeg,png|max:2048',

    'author_ids' => 'required|array|min:1',
    'author_ids.*' => 'exists:authors,id',

    'tag_ids' => 'required|array|min:1',
    'tag_ids.*' => 'exists:tags,id',

    'category_ids' => 'required|array|min:1',
    'category_ids.*' => 'exists:categories,id',
]);
    $path = $request->file('Image')->store('articles', 'public');
    

    $data=[
        'Title' => $request->Title,
        'ShowDescription' => $request->ShowDescription,
        'Text' => $request->Text,
        
    ];
    $data['Image']=$path;
    $article=$articleService->createArticle($data);

$article->authors()->sync($request->author_ids);
$article->tags()->sync($request->tag_ids);
$article->categories()->sync($request->category_ids);


    return redirect()->route('articles.home');
}


public function create()
{
    $this->authorize('create', Article::class);
 

    return view('articles.add',[
     'authors'=>Author::all(),
     'tags'=>Tag::all(),
     'categories'=>Category::all(),

    ]);
}



public function update(Request $request, Article $article, ArticleService $articleService)
{
    $this->authorize('update',$article);
        
    $request->validate([
    'Title' => 'required|string|max:255',
    'ShowDescription' => 'required|string|max:255',
    'Text' => 'required|string',
    'Image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

    'author_ids' => 'required|array|min:1',
    'author_ids.*' => 'exists:authors,id',

    'tag_ids' => 'required|array|min:1',
    'tag_ids.*' => 'exists:tags,id',

    'category_ids' => 'required|array|min:1',
    'category_ids.*' => 'exists:categories,id',
]);
    $data = [
        'Title' => $request->Title,
        'ShowDescription' => $request->ShowDescription,
        'Text' => $request->Text,
    ];

    if ($request->hasFile('Image')) {
        $data['Image'] = $request->file('Image')->store('articles', 'public');
    }
    $articleService->updateArticle($data,$article);
    
$article->authors()->sync($request->author_ids);
$article->tags()->sync($request->tag_ids);
$article->categories()->sync($request->category_ids);
    return redirect()->route('articles.home');
}


public function delete(Article $article, ArticleService $articleService)
{
    $this->authorize('delete',$article);
    $articleService->deleteArticle($article);
    return redirect()->route('articles.home');
}

public function index()
{
return response()->json(
    Article::with(['authors', 'tags', 'categories'])->get(),
    200,
    [],
    JSON_PRETTY_PRINT
);
}


}
