<?php

namespace App\Modules\Note;

use App\Common\Routes\AbstractRoutes;
use App\Modules\Note\Http\Controllers\CreateNoteController;
use App\Modules\Note\Http\Controllers\ListNoteController;
use App\Modules\Note\Http\Controllers\ShowNoteController;
use App\Modules\Note\Http\Controllers\UpdateNoteController;
use Illuminate\Support\Facades\Route;

class Routes extends AbstractRoutes
{

    /**
     * Список веб маршрутов
     *
     * @return void
     */
    public function getWebRoutes(): void
    {
        Route::get('{id}', ShowNoteController::class);
        Route::get('', ListNoteController::class);
        Route::post('create', CreateNoteController::class);
        Route::patch('update/{id}', UpdateNoteController::class);
    }


    /**
     * Получить список общих проверок
     *
     * @return array
     */
    public function getModuleMiddleware(): array
    {
        return ["auth:api"];
    }

    /**
     * Префикс модуля
     *
     * @return string
     */
    public function getModulePrefix(): string
    {
        return 'note';
    }
}
