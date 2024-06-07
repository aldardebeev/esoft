<?php

namespace App\Modules\Auth\Exceptions;

use App\Exceptions\Http\Internal\InternalExceptionInterfaceCodeInterface;

enum ExceptionCode: int implements InternalExceptionInterfaceCodeInterface
{
    case InvalidEmail = 1;
    case InvalidPassword = 2;

    case EmailExist = 3;
    case Unauthorized = 4;

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
