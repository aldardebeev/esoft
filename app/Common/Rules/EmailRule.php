<?php

namespace App\Common\Rules;

use App\Common\Enums\RegexType;
use App\Modules\Auth\Exceptions\InvalidEmailException;
use Closure;
use Illuminate\Support\Facades\Validator;

class EmailRule extends DefaultRule
{
    /**
     * @throws InvalidEmailException
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
            'regex:' . RegexType::EMAIL,
        ];
    }

    /**
     * Сообещние при непрошедшей валидации
     *
     * @throws InvalidEmailException
     */
    private static function getMessage(): string
    {
        return throw new InvalidEmailException;
    }
}
