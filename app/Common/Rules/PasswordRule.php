<?php

namespace App\Common\Rules;

use App\Common\Enums\RegexType;
use App\Modules\Auth\Exceptions\InvalidPasswordException;
use Closure;
use Illuminate\Support\Facades\Validator;

class PasswordRule extends DefaultRule
{
    /**
     * @throws InvalidPasswordException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Validator::make([$attribute => $value], [$attribute => self::customRules()])->passes()) {
            $fail(self::getMessage());
        }
    }

    /**
     * Правила валидации, которые должно пройти свойство
     *
     * @return string[]
     */
    private static function customRules(): array
    {
        return [
            'string',
            'regex:' . RegexType::PASSWORD,
        ];
    }

    /**
     * Сообещние при непрошедшей валидации
     *
     * @throws InvalidPasswordException
     */
    private static function getMessage()
    {
        return throw new InvalidPasswordException();
    }
}
