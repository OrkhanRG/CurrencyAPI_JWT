<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\CurrencyService;
use App\Contracts\AuthServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Contracts\CurrencyServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(CurrencyServiceInterface::class, CurrencyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
