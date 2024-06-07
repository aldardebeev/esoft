<?php

namespace App\Modules\User\Repositories;

use App\Common\VO\EmailVO;
use App\Modules\Auth\DTO\LoginOrRegistrationDTO;
use App\Modules\User\Models\User;

interface UserRepositoryInterface
{
    public function createNewUser(LoginOrRegistrationDTO $registrationDTO): User;

    public function getUserByEmail(EmailVO $emailVO): ?User;

}
