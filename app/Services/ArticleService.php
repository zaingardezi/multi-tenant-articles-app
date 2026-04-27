<?php
namespace App\Services;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use App\Events\ArticleDeleted;


class ArticleService{

public function __construct(protected ArticleRepositoryInterface $articleRepo)
{}

public function getArticles(){
    return $this->articleRepo->getAllArticles();
}

public function createArticle(array $data)
{
    
 $article= $this->articleRepo->create($data);
 event(new ArticleCreated($article));
 return $article;

}

public function updateArticle(array $data, Article $article){
    $updated = $this->articleRepo->update($data, $article);

    event(new ArticleUpdated($updated)); 

    return $updated;
}


public function deleteArticle(Article $article)
{
    $this->articleRepo->delete($article);

    event(new ArticleDeleted($article));

    return true;
}







}