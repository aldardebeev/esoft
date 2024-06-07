<?php

namespace App\Modules\Auth;

use App\Common\Routes\AbstractRoutes;
use App\Modules\Auth\Http\Controllers\LoginController;
use App\Modules\Auth\Http\Controllers\LogoutController;
use App\Modules\Auth\Http\Controllers\RegistrationController;
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
        Route::post('register', RegistrationController::class);
        Route::post('login', LoginController::class);

        Route::group(["middleware" => ["auth:api"]], function () {
            Route::post('logout', LogoutController::class);
        });


    }

    /**
     * Получить список веб проверок
     *
     * @return array
     */
    public function getWebMiddleware(): array
    {
        return [];
    }

    /**
     * Получить список общих проверок
     *
     * @return array
     */
    public function getModuleMiddleware(): array
    {
        return [];
    }

    /**
     * Префикс модуля
     *
     * @return string
     */
    public function getModulePrefix(): string
    {
        return 'auth';
    }
}
