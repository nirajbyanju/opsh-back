<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\NotificationRepository;

class NotificationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    public function boot()
    {
        //
    }
}



