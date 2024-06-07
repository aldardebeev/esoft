<?php

namespace App\Modules\Auth\Exceptions;

use App\Exceptions\Http\Internal\InternalErrorException;
use App\Exceptions\Http\Internal\InternalExceptionInterfaceCodeInterface;

class EmailExistException extends InternalErrorException
{
    protected static function setInternalCode(): InternalExceptionInterfaceCodeInterface
    {
        return ExceptionCode::EmailExist;
    }
}
