<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        // register is_admin middleware alias
        if ($this->app->runningInConsole() === false) {
            $router = $this->app['router'];
            $router->aliasMiddleware('is_admin', \App\Http\Middleware\IsAdmin::class);
        }
    }
}
