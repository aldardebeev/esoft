<?php

namespace App\Modules\Auth\Exceptions;

use App\Exceptions\Http\Internal\InternalErrorException;
use App\Exceptions\Http\Internal\InternalExceptionInterfaceCodeInterface;

class InvalidEmailException extends InternalErrorException
{
    protected static function setInternalCode(): InternalExceptionInterfaceCodeInterface
    {
        return ExceptionCode::InvalidEmail;
    }
}
