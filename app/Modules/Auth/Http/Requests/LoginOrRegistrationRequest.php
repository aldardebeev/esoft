<?php

namespace App\Modules\Auth\Http\Requests;

use App\Common\Rules\EmailRule;
use App\Common\Rules\PasswordRule;
use App\Common\VO\EmailVO;
use App\Modules\Auth\DTO\LoginOrRegistrationDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginOrRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                new EmailRule(),
            ],
            'password' => [
                'required',
                new PasswordRule(),
            ]
        ];
    }

    public function toDto(): LoginOrRegistrationDTO
    {
        return new LoginOrRegistrationDTO(
            email:  EmailVO::fromValue($this->validated()['email']),
            password: $this->validated()['password'],
        );
    }
}
