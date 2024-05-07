<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\OwnerAccessMiddleware;
use App\Http\Middleware\CashierAccessMiddleware;
use App\Http\Middleware\ManagerAccessMiddleware;

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
        $this->app['router']->aliasMiddleware('owner', OwnerAccessMiddleware::class);
        $this->app['router']->aliasMiddleware('cashier', CashierAccessMiddleware::class);
        $this->app['router']->aliasMiddleware('manager', ManagerAccessMiddleware::class);
    }

}
