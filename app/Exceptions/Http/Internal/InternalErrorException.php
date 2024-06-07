<?php

namespace App\Exceptions\Http\Internal;

use App\Exceptions\Http\DefaultHttpException;
use App\Http\Response\JResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * 400 http response
 *
 */
abstract class InternalErrorException extends DefaultHttpException
{
    private const HTTP_CODE = Response::HTTP_BAD_REQUEST;

    protected InternalExceptionInterfaceCodeInterface $internalCode;
    protected string $description;

    public function __construct()
    {
        $this->internalCode = $this->setInternalCode();
        $this->description = $this->getInternalCode()->getDescription();

        parent::__construct(
            message: $this->getInternalCode()->getMessage($this->getErrorMessageData()),
            code: self::HTTP_CODE
        );
    }

    abstract protected static function setInternalCode(): InternalExceptionInterfaceCodeInterface;

    protected function getErrorMessageData(): array
    {
        return [];
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getInternalCode(): InternalExceptionInterfaceCodeInterface
    {
        return $this->internalCode;
    }

    public function render(): JsonResponse
    {
        return JResponse::getFormattedResponse([
            'code' => $this->getInternalCode(),
            'message' => $this->getMessage(),
            'description' => $this->getDescription()
        ], $this->getCode());
    }
}
