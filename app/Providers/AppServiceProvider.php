<?php

namespace App\Providers;

use App\View\Composer\ViewComposer;
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
        view()->composer(['components.admin.header','admin.layouts.app','site.layouts.app'], ViewComposer::class);
    }
}
