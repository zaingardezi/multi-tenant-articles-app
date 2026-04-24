<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Log;

class ArticleObserver
{
   
    public function created(Article $article): void
    {
        Log::info('Article created',[
        'id'=>$article->id,    
        'Title'=>$article->Title

        ]);
    }

    public function updated(Article $article): void
    {
        Log::info('Article updated',[
            'id' => $article->id,
        'changed_fields' => array_keys($article->getChanges())
        ]);
    }


    public function deleted(Article $article): void
    {
        Log::warning('Article Delete',[
            'id'=>$article->id,
            'title'=>$article->Title
        ]);
    }

   
}
