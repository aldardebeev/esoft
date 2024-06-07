<?php

namespace App\Common\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class DefaultRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

    }
}
