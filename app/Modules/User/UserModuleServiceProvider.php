<?php

namespace App\Modules\User;

use Illuminate\Support\ServiceProvider;

class UserModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->app->registerDeferredProvider(Repositories::class);
    }
}
