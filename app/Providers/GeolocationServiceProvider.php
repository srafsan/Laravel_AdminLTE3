<?php

namespace App\Providers;

use App\Services\Geolocation;
use App\Services\Map;
use App\Services\Satellite;
use Illuminate\Support\ServiceProvider;

class GeolocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Geolocation::class, function($app) {
            $map = new  Map();
            $satellite = new Satellite();

            return new Geolocation($map, $satellite);
        });
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
