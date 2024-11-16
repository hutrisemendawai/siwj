<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

     public function boot()
     {
         // Force HTTPS if APP_URL starts with https
         if (str_starts_with(config('app.url'), 'https://')) {
             URL::forceScheme('https');
         }
     }
    
}