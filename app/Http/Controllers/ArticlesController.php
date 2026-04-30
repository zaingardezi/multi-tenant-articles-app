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
        $this->authorize('viewAny', Article::class);
        $articles = $articleService->getArticles();
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
        $this->authorize('update', $article);
        $article->load(['tags', 'categories', 'authors']);
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
        $data = [
            'Title' => $request->Title,
            'ShowDescription' => $request->ShowDescription,
            'Text' => $request->Text,
        ];
        $data['Image'] = $path;
        $article = $articleService->createArticle($data);
        $article->authors()->sync($request->author_ids);
        $article->tags()->sync($request->tag_ids);
        $article->categories()->sync($request->category_ids);
        return redirect()->route('articles.home');
    }


    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.add', [
            'authors' => Author::all(),
            'tags' => Tag::all(),
            'categories' => Category::all(),
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
        $data = [
            'Title' => $request->Title,
            'ShowDescription' => $request->ShowDescription,
            'Text' => $request->Text,
        ];

        if ($request->hasFile('Image')) {
            $data['Image'] = $request->file('Image')->store('articles', 'public');
        }
        $articleService->updateArticle($data, $article);
        $article->authors()->sync($request->author_ids);
        $article->tags()->sync($request->tag_ids);
        $article->categories()->sync($request->category_ids);
        return redirect()->route('articles.home');
    }
    public function delete(Article $article, ArticleService $articleService)
    {
        $this->authorize('delete', $article);
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

    public function viewArticleApi(Article $article)
    {
        return response()->json(
            $article->load(['authors', 'categories', 'tags']),
            200,
            [],
            JSON_PRETTY_PRINT
        );
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
        return response()->json([
            'message' => 'Article updated successfully',
            'data' => $article->fresh()
        ]);
    }
    public function deleteArticleApi(Article $article)
    {
        $article->delete();
        return response()->json('Article Deleted');
    }

    public function articlesCategoryApi(Request $request)
    {
        $query = Article::query();
        if ($request->has('category')) {
            $query->whereHas(
                'categories',
                function ($q) use ($request) {
                    $q->where('name', $request->category);
                }
            );
        }


        $data = $query->with(['authors', 'categories', 'tags'])->get();


        return response()->json([
            'message' => 'Articles with category: ' . $request->category . ' found successfully',
            'data' => $data
        ]);
    }


    public function articlesTagApi(Request $request)
    {
        $query = Article::query();
        if ($request->has('tag')) {
            $query->whereHas(
                'tags',
                function ($q) use ($request) {
                    $q->where('name', $request->tag);
                }
            );
        }


        $data = $query->with(['authors', 'categories', 'tags'])->get();


        return response()->json([
            'message' => 'Articles with tag: ' . $request->tag . ' found successfully',
            'data' => $data
        ]);
    }




}
