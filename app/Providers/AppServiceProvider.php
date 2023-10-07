<?php

namespace App\Providers;

use App\Services\PostcardService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Postcard', function ($app) {
            return new PostcardService("us", 23, 10);
        });
    }
}
