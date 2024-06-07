<?php

namespace App\Exceptions\Http\Internal;

interface InternalExceptionInterfaceCodeInterface
{
    public function getCode(): int;

    public function getMessage(array $data = []): string;

    public function getDescription(): ?string;
}
