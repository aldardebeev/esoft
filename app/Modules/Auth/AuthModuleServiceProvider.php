<?php

namespace App\Modules\Auth;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AuthModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->registerDeferredProvider(Routes::class);

        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'auth');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
