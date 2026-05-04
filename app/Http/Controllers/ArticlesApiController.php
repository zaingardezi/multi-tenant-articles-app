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

class ArticlesApiController extends Controller
{
    use AuthorizesRequests;

    public function index()
{
        $articles = Cache::remember('articles_all', 300, function()
    {
        return Article::with(['authors', 'tags', 'categories'])->get();
    });
        return response()->json($articles);
}

    public function show(Article $article)
{
        $cacheKey = 'article_' . $article->id;
        return Cache::remember($cacheKey, 300, function () use ($article)
    {
        return $article->load(['authors', 'categories', 'tags']);
    });
}

    public function store(Request $request)
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

    public function update(Request $request, Article $article)
{
        $request->validate([
          'Title' => 'required|string',
          'ShowDescription' => 'required|string',
          'Text' => 'required|string',
    ]);
        $data = $request->only(['Title', 'ShowDescription', 'Text']);
        if($request->hasFile('Image'))
    {
          $data['Image'] = $request->file('Image')->store('articles', 'public');
    }
        $article->update($data);
        $this->clearArticleCaches();
        Cache::forget('article_' . $article->id);
        Cache::forget('web_article_' . $article->id);
        Cache::forget('edit_article_' . $article->id);
        return response()->json([
          'message' => 'Article updated successfully',
          'data' => $article->fresh()
    ]);
}

    public function destroy(Article $article)
{
        $article->delete();
        $this->clearArticleCaches();
        Cache::forget('article_' . $article->id);
        return response()->json('Article Deleted');
}

 public function search(Request $request)
{
    $categories = $request->category
        ? array_filter(explode(',', $request->category))
        : null;

    $tags = $request->tag
        ? array_filter(explode(',', $request->tag))
        : null;

    $authors = $request->author
        ? array_filter(explode(',', $request->author))
        : null;

    $query = Article::query();

    if ($tags) {
        $query->whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('name', $tags);
        });
    }

    if ($categories) {
        $query->whereHas('categories', function ($q) use ($categories) {
            $q->whereIn('name', $categories);
        });
    }

    if ($authors) {
        $query->whereHas('authors', function ($q) use ($authors) {
            $q->whereIn('name', $authors);
        });
    }

    return $query->with(['authors', 'categories', 'tags'])->get();
}
}
