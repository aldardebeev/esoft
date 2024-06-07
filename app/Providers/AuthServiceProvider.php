<?php

namespace App\Providers;

use App\Common\Enums\RoleType;
use App\Modules\Auth\Exceptions\UnauthorizedException;
use App\Modules\Note\Models\Note;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Passport::loadKeysFrom(__DIR__ . '/../../storage');

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Gate::define('action-note', function (User $user, Note $note) {
            return ($user->getRole() === RoleType::Admin || $user->getId() === $note->getUserId())
                ? true
                : throw new UnauthorizedException();
        });
    }
}
