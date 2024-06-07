<?php

namespace App\Providers;

use App\Modules\Auth\AuthModuleServiceProvider;
use App\Modules\Note\NoteModuleServiceProvider;
use App\Modules\User\UserModuleServiceProvider;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ModulesServiceProvider extends LaravelServiceProvider
{
    public function register(): void
    {
        $this->app->registerDeferredProvider(AuthModuleServiceProvider::class);
        $this->app->registerDeferredProvider(UserModuleServiceProvider::class);
        $this->app->registerDeferredProvider(NoteModuleServiceProvider::class);
    }

    public function boot(): void
    {
    }
}
