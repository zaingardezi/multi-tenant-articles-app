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
class ArticlesController extends Controller
{
    use AuthorizesRequests;
    public function home(ArticleService $articleService)
{
    $this->authorize('viewAny', Article::class);

    $articles = Cache::remember('home_articles', 300, function () use ($articleService) {
        return $articleService->getArticles();
    });

    return view('articles.home', compact('articles'));
}

    public function view(Article $article)
{
        $this->authorize('view', $article);
        $article = Cache::remember('web_article_' . $article->id, 300, function () use ($article) {
        return $article->load(['authors', 'tags', 'categories']);
    });
        return view('articles.view', compact('article'));
}
    private function clearArticleCaches()
{
        Cache::forget('home_articles');
        Cache::forget('articles_all');
}
    public function edit(Article $article)
{
        $this->authorize('update', $article);
        $article = Cache::remember('edit_article_' . $article->id, 300, function () use ($article) {
        return $article->load(['tags', 'categories', 'authors']);
    });
        return view('articles.edit', [
            'article' => $article,
            'authors' => Cache::remember('authors_all', 600, fn() => Author::select('id','name')->get()),
            'tags' => Cache::remember('tags_all', 600, fn() => Tag::all()),
            'categories' => Cache::remember('categories_all', 600, fn() => Category::all()),
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

    $article = $articleService->createArticle([
        'Title' => $request->Title,
        'ShowDescription' => $request->ShowDescription,
        'Text' => $request->Text,
        'Image' => $path,
    ]);

    $article->authors()->sync($request->author_ids);
    $article->tags()->sync($request->tag_ids);
    $article->categories()->sync($request->category_ids);

    
    $this->clearArticleCaches();

    return redirect()->route('articles.home');
}


    public function create()
{
        $this->authorize('create', Article::class);
        return view('articles.add', [
            'authors' => Cache::remember('authors_all', 600, fn() => Author::select('id','name')->get()),
            'tags' => Cache::remember('tags_all', 600, fn() => Tag::all()),
            'categories' => Cache::remember('categories_all', 600, fn() => Category::all()),
    ]);
}



    public function update(Request $request, Article $article, ArticleService $articleService)
{
    $this->authorize('update', $article);

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

    $data = $request->only(['Title','ShowDescription','Text']);

    if ($request->hasFile('Image')) {
        $data['Image'] = $request->file('Image')->store('articles', 'public');
    }

    $articleService->updateArticle($data, $article);

    $article->authors()->sync($request->author_ids);
    $article->tags()->sync($request->tag_ids);
    $article->categories()->sync($request->category_ids);

    
    Cache::forget('article_' . $article->id);
    Cache::forget('web_article_' . $article->id);
    Cache::forget('edit_article_' . $article->id);
    $this->clearArticleCaches();

    return redirect()->route('articles.home');
}
    public function delete(Article $article, ArticleService $articleService)
{
    $this->authorize('delete', $article);

    $articleService->deleteArticle($article);

    
    Cache::forget('article_' . $article->id);
    Cache::forget('web_article_' . $article->id);
    Cache::forget('edit_article_' . $article->id);

    $this->clearArticleCaches();

    return redirect()->route('articles.home');
}
    public function index()
{
          $articles = Cache::remember('articles_all', 300, function () {
        return Article::with(['authors', 'tags', 'categories'])->get();
    });

    return response()->json($articles);
}

   public function viewArticleApi(Article $article)
{
        $cacheKey = 'article_' . $article->id;
        return Cache::remember($cacheKey, 300, function () use ($article) {
        return $article->load(['authors', 'categories', 'tags']);
    });
}


    public function addArticleApi(Request $request)
{
        $request->validate([
            'Title' => 'required|string',
            'ShowDescription' => 'required|string',
            'Text' => 'required|string',
            'Image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);
        $path = $request->file('Image')->store('articles', 'public');
        $article = Article::create([
            'Title' => $request->Title,
            'ShowDescription' => $request->ShowDescription,
            'Text' => $request->Text,
            'Image' => $path
    ]);
            $this->clearArticleCaches();
            return response()->json([
            'message' => 'Article created successfully',
            'data' => $article
    ]);
}
    public function updateArticleApi(Request $request, Article $article)
{
        $request->validate([
            'Title' => 'required|string',
            'ShowDescription' => 'required|string',
            'Text' => 'required|string',
    ]);
        $data = $request->only(['Title', 'ShowDescription', 'Text']);
        if ($request->hasFile('Image')) {
            $data['Image'] = $request->file('Image')->store('articles', 'public');
        }
        $article->update($data);
        $this->clearArticleCaches();
        Cache::forget('article_' . $article->id);
        return response()->json([
            'message' => 'Article updated successfully',
            'data' => $article->fresh()
    ]);
}
    public function deleteArticleApi(Article $article)
{
        $article->delete();
        $this->clearArticleCaches();
        Cache::forget('article_' . $article->id);
        return response()->json('Article Deleted');
}

 
   public function articlesSearch(Request $request)
{
    $tag = strtolower(trim($request->tag));
    $category = strtolower(trim($request->category));
    $author = strtolower(trim($request->author));

    $query = Article::query();

    if ($tag) {
        $query->whereHas('tags', function ($q) use ($tag) {
            $q->whereRaw('LOWER(name) = ?', [$tag]);
        });
    }

    if ($category) {
        $query->whereHas('categories', function ($q) use ($category) {
            $q->whereRaw('LOWER(name) = ?', [$category]);
        });
    }

    if ($author) {
        $query->whereHas('authors', function ($q) use ($author) {
            $q->whereRaw('LOWER(name) = ?', [$author]);
        });
    }

    return $query->with(['authors', 'categories', 'tags'])->get();
}

  








}
