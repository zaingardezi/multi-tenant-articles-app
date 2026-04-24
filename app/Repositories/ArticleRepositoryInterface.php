<?php
namespace App\Repositories;

interface ArticleRepositoryInterface
{
    public function getAllArticles();

    public function create(array $data);
 
    public function update(array $data, $article);
   
    public function delete($article);

}