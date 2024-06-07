<?php

namespace App\Modules\User\Repositories;

use App\Common\VO\EmailVO;
use App\Modules\Auth\DTO\LoginOrRegistrationDTO;
use App\Modules\User\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function createNewUser(LoginOrRegistrationDTO $registrationDTO): User
    {
        return User::query()->create([
            'email' => $registrationDTO->getEmail()->getValue(),
            'password' => $registrationDTO->getPassword(),
            'name' => User::getNameFromEmail($registrationDTO->getEmail()),
        ]);
    }

    public function getUserByEmail(EmailVO $emailVO): ?User
    {
        return User::byEmail($emailVO)->first();
    }
}
