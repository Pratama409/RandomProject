<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        // MySQL installations with a 1000-byte index limit cannot index
        // a default utf8mb4 VARCHAR(255). Keep default indexed strings safe.
        Schema::defaultStringLength(191);
    }
}
