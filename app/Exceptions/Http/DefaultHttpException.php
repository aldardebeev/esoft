<?php

namespace App\Exceptions\Http;

use Illuminate\Http\JsonResponse;

abstract class DefaultHttpException extends \Exception
{
    abstract public function render(): JsonResponse;
}
