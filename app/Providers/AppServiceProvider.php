<?php

namespace App\Providers;
use App\Observers\ArticleObserver;
use App\Observers\UserObserver;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Article;


class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );


        $this->app->bind(
          ArticleRepositoryInterface::class,
          ArticleRepository::class

        );
    }


    public function boot(): void
    {
        User::observe(UserObserver::class);
        Article::observe(ArticleObserver::class);
    }
}
