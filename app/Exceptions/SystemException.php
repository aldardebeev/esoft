<?php

namespace App\Exceptions;

use App\Http\Response\JResponse;
use Illuminate\Support\Facades\Log;

class SystemException
{
    private string $exceptionName;

    public function __construct(private \Throwable $exception)
    {
        $this->exceptionName = self::getGeneratedExceptionName();
    }

    public static function make(\Throwable $exception): static
    {
        return new static($exception);
    }

    /**
     * Получить сгенерированное id ошибки
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->exceptionName;
    }

    /**
     * Получить ответ для пользователя
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHttpResponse(): \Illuminate\Http\JsonResponse
    {
        if (app()->isProduction()) {
            return JResponse::badRequest('Internal error');
        }

        return JResponse::systemException($this);
    }

    public function getException(): \Throwable
    {
        return $this->exception;
    }

    /**
     * Сгенерировать id ошибки, чтобы отследить её в логах
     *
     * @return string
     */
    private static function getGeneratedExceptionName(): string
    {
        return date('Ymd') . '_' . uniqid();
    }
}
