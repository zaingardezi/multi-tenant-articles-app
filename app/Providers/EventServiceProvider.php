<?php

namespace App\Providers;

use App\Events\UserDeleted;
use App\Events\UserUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\UserCreated;
use App\Events\ArticleCreated;
use App\Events\ArticleUpdated;
use App\Events\ArticleDeleted;

use App\Listeners\NotifySuperAdmin;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCreated::class => [
            NotifySuperAdmin::class,
        ],
        ArticleCreated::class => [
            NotifySuperAdmin::class,
        ],
        ArticleUpdated::class => [
            NotifySuperAdmin::class,
        ],
        ArticleDeleted::class => [
            NotifySuperAdmin::class,
        ],
        UserUpdated::class => [
            NotifySuperAdmin::class,
        ],
        UserDeleted::class => [
            NotifySuperAdmin::class,
        ],
    ];

    public function boot(): void
    {
        
    }
}