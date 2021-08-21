<?php

namespace App\Providers;

use App\Services\Topics\TopicsService;
use App\Services\Topics\TopicsServiceContract;
use Illuminate\Support\ServiceProvider;

class TopicsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TopicsServiceContract::class,TopicsService::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
