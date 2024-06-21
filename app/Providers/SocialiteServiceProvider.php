<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Socialite::extend('facebook', function ($app) {
            $config = $app['config']['services.facebook'];
            return Socialite::buildProvider(\Laravel\Socialite\Two\FacebookProvider::class, $config)->setHttpClient(new Client(['verify' => false]));
        });
    }
}
