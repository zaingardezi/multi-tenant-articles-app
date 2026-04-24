<?php
namespace App\Services;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;


class ArticleService{

public function __construct(protected ArticleRepositoryInterface $articleRepo)
{}

public function getArticles(){
    return $this->articleRepo->getAllArticles();
}

public function createArticle(array $data)
{
    
 return $this->articleRepo->create($data);
}

public function updateArticle(array $data, Article $article){
     return $this->articleRepo->update($data,$article);
}
}