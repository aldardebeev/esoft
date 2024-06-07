<?php

namespace App\Modules\Auth\Services;

use App\Common\VO\EmailVO;
use App\Modules\Auth\DTO\LoginOrRegistrationDTO;
use App\Modules\Auth\DTO\LoginOrRegistrationResultDTO;
use App\Modules\Auth\Exceptions\EmailExistException;
use App\Modules\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     *  Регистрации
     *
     * @throws EmailExistException
     */
    public function registration(LoginOrRegistrationDTO $registrationDTO): LoginOrRegistrationResultDTO
    {
        $this->checkAlreadyExistUser($registrationDTO->getEmail());

        return DB::transaction(function () use ($registrationDTO) {
            $user = $this->userRepository->createNewUser($registrationDTO);

            return new LoginOrRegistrationResultDTO(
                token: $user->createToken('e-soft')->accessToken
            );
        });
    }

    /**
     * Проверить, что пользователь с такой почтой не существует
     *
     * @param EmailVO $emailVO
     * @return void
     * @throws EmailExistException
     */
    protected function checkAlreadyExistUser(EmailVO $emailVO): void
    {
        if (!empty($this->userRepository->getUserByEmail($emailVO))) {
            throw new EmailExistException;
        }
    }
}
