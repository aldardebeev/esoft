<?php

namespace App\Common\VO;

class EmailVO
{
    private function __construct(private string $value)
    {
        $this->checkValidatedValue();
    }

    public static function fromValue(string $value): static
    {
        return new static(strtolower($value));
    }

    public function checkValidatedValue()
    {

    }

    public function getValue(): string
    {
        return $this->value;
    }
}
