<?php

namespace App\Providers;

use App\Contracts\PostNotificationServiceInterface;
use App\Services\PostNotificationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostNotificationServiceInterface::class, PostNotificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
