<?php

namespace App\Modules\Note\Exceptions;

use App\Exceptions\Http\Internal\InternalExceptionInterfaceCodeInterface;

enum ExceptionCode: int implements InternalExceptionInterfaceCodeInterface
{
    case NotFound = 1;

    public function getCode(): int
    {
        return $this->value;
    }

    public function getMessage(array $data = []): string
    {
        return __('auth::exception.' . $this->name . '.message', $data);
    }

    public function getDescription(): ?string
    {
        return __('auth::exception.' . $this->name . '.description');
    }
}
