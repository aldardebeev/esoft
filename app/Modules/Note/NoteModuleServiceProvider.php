<?php

namespace App\Modules\Note;

use App\Modules\Note\Models\Note;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class NoteModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->registerDeferredProvider(Routes::class);
        $this->app->registerDeferredProvider(Repositories::class);
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'note');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function boot()
    {
        Gate::define('update-note', function (User $user, Note $note) {
            return $user->id === $note->user_id;
        });
    }
}
