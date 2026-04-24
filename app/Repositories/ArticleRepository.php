<?php
namespace App\Repositories;

use App\Models\Article;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAllArticles()
    {
        return Article::all();
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update(array $data, $article)
    {
        $article->update($data);
        return $article;
    }

    public function delete($article)
    {
        return $article->delete();
    }
}