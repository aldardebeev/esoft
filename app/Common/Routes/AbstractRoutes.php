<?php

namespace App\Common\Routes;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

abstract class AbstractRoutes extends ServiceProvider
{
    /**
     * Регистрация маршрутов в контейнере приложения
     *
     * @return void
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware($this->getModuleMiddleware())->group(function () {
                $this->registerWebRoutes();
            });
        });
    }

    /**
     * Список веб маршрутов
     *
     * @return void
     */
    public function getWebRoutes(): void
    {
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
        return '';
    }


    /**
     * Регистрация веб маршрутов
     *
     * @return void
     */
    private function registerWebRoutes(): void
    {
        Route::middleware($this->getWebMiddleware())->group(function () {
            Route::prefix('web')->group(function () {
                Route::prefix($this->getModulePrefix())->group(function () {
                    $this->getWebRoutes();
                });
            });
        });
    }
}
