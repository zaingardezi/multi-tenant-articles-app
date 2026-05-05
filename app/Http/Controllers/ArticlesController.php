<?php

namespace App\Http\Controllers;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticlesController extends Controller
{
    use AuthorizesRequests;
    
public function home(ArticleService $articleService)
{
    $this->authorize('viewAny', Article::class);
    $articles = $articleService->getArticles();
    return view('articles.home', compact('articles'));
}

public function show(Article $article)
{
    $this->authorize('view', $article);
    $article->load(['authors', 'tags', 'categories']);
    return view('articles.view', compact('article'));
}



 public function edit(Article $article)
{
    $this->authorize('update', $article);
    $article->load(['tags', 'categories', 'authors']);
    return view('articles.edit', [
        'article' => $article,
        'authors' => Author::select('id','name')->get(),
        'tags' => Tag::all(),
        'categories' => Category::all(),
    ]);
}

    public function store(StoreArticleRequest $request, ArticleService $articleService)
{
        $data = $request->validated();
        $data['Image'] = $request->file('Image')->store('articles', 'public');
        $article = $articleService->createArticle($data);
        $article->authors()->sync($data['author_ids']);
        $article->tags()->sync($data['tag_ids']);
        $article->categories()->sync($data['category_ids']);
        return redirect()->route('articles.home');
}

public function create()
{
    $this->authorize('create', Article::class);
    return view('articles.add', [
        'authors' => Author::select('id','name')->get(),
        'tags' => Tag::all(),
        'categories' => Category::all(),
    ]);
}
    public function update(UpdateArticleRequest $request, Article $article, ArticleService $articleService)
{
        $data = $request->validated();
        
        if ($request->hasFile('Image'))
    {
          $data['Image'] = $request->file('Image')->store('articles', 'public');
    }
        $articleService->updateArticle($data, $article);
        $article->authors()->sync($data['author_ids']);
        $article->tags()->sync($data['tag_ids']);
        $article->categories()->sync($data['category_ids']);
        return redirect()->route('articles.home');
}

    public function destroy(Article $article, ArticleService $articleService)
{
        $this->authorize('delete', $article);
        $articleService->deleteArticle($article);
        return redirect()->route('articles.home');
}

    

}
