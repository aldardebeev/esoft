<?php

namespace App\Modules\Auth\DTO;

use App\Common\VO\EmailVO;

class LoginOrRegistrationDTO
{
    public function __construct(
        private readonly EmailVO $email,
        private readonly string $password,
    )
    {
    }

    public function getEmail(): EmailVO
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
