<?php

namespace App\Modules\Auth\DTO;


class LoginOrRegistrationResultDTO
{
    public function __construct(
        private readonly string $token,
    )
    {
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
