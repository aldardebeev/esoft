<?php

namespace App\Http\Response;

use App\Common\Helpers\TimeHelper;
use App\Exceptions\SystemException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JResponse
{
    /**
     * [200]
     * Успешно
     *
     * @param mixed|null $data
     * @return JsonResponse
     */
    public static function ok(mixed $data = null): JsonResponse
    {
        return self::getFormattedResponse($data, Response::HTTP_OK);
    }

    /**
     * [400]
     * Всплывающая модалка
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function badRequest(string $message): JsonResponse
    {
        return self::getFormattedResponse([
            'message' => $message,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * [422]
     * Валидационные ошибки
     *
     * @param array $errors
     * @param string|null $message
     * @return JsonResponse
     */
    public static function validationError(array $errors, string $message = null): JsonResponse
    {
        return self::getFormattedResponse([
            'message' => $message ?? 'validation_error',
            'errors' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * [404]
     * Страница не найдена
     *
     * @param string|null $message
     * @return JsonResponse
     */
    public static function notFound(string $message = null): JsonResponse
    {
        return self::getFormattedResponse([
            'message' => $message ?? __('error.HTTP_NOT_FOUND')
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * [500]
     * Внутренняя ошибка сервера
     *
     * @param SystemException $exception
     * @return JsonResponse
     */
    public static function systemException(SystemException $exception): JsonResponse
    {
        return self::getFormattedResponse([
            'error' => 'BAD_REQUEST',
            '_dev' => [
                'name' => $exception->getName(),
                'message' => $exception->getException()->getMessage(),
                'file' => $exception->getException()->getFile(),
                'line' => $exception->getException()->getLine(),
            ]
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * [401]
     * Неавторизован
     *
     * @return JsonResponse
     */
    public static function unauthorized(): JsonResponse
    {
        return self::getFormattedResponse(
            ['message' => 'Unauthorized'],
            Response::HTTP_UNAUTHORIZED
        );
    }

    public static function getFormattedResponse(mixed $data, int $status): JsonResponse
    {
        return response()->json($data, $status)->withHeaders([
            'server-time' => TimeHelper::toIsoFormat(TimeHelper::getCurrentServerTime())
        ]);
    }
}
