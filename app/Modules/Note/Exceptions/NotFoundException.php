<?php

namespace App\Modules\Note\Exceptions;

use App\Exceptions\Http\Internal\InternalErrorException;
use App\Exceptions\Http\Internal\InternalExceptionInterfaceCodeInterface;

class NotFoundException extends InternalErrorException
{
    protected static function setInternalCode(): InternalExceptionInterfaceCodeInterface
    {
        return ExceptionCode::NotFound;
    }
}
