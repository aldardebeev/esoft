<?php

namespace App\Modules\Note;

use App\Modules\Note\Repositories\NoteRepository;
use App\Modules\Note\Repositories\NoteRepositoryInterface;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class Repositories extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
    }
}
