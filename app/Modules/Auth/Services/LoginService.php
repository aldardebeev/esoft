<?php

namespace App\Modules\Auth\Services;

use App\Modules\Auth\DTO\LoginOrRegistrationDTO;
use App\Modules\Auth\DTO\LoginOrRegistrationResultDTO;
use App\Modules\Auth\Exceptions\InvalidPasswordException;
use App\Modules\User\Models\User;
use App\Modules\User\Repositories\UserRepositoryInterface;

class LoginService
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     *  Логин
     *
     * @throws InvalidPasswordException
     */
    public function login(LoginOrRegistrationDTO $registrationDTO): LoginOrRegistrationResultDTO
    {
        $user = $this->userRepository->getUserByEmail($registrationDTO->getEmail());

        $this->passwordsIsEqual($registrationDTO->getPassword(), $user);

        return new LoginOrRegistrationResultDTO(
            token: $user->createToken('e-soft')->accessToken
        );
    }

    /**
     *  Равны ли пароли
     *
     * @throws InvalidPasswordException
     */
    private function passwordsIsEqual(string $password, User $user,): void
    {
        if (!password_verify($password, $user->getPassword())) {
            throw new InvalidPasswordException;
        }
    }
}
