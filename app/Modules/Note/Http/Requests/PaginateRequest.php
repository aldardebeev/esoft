<?php

namespace App\Modules\Note\Http\Requests;

use App\Modules\Note\DTO\PaginateDTO;
use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends FormRequest
{

    protected const MAX_PER_PAGE = 50;

    protected const DEFAULT_LIMIT = 10;
    protected const DEFAULT_PAGE = 1;

    public function rules(): array
    {
        return [
            'limit' => [
                'int',
                'min:1',
                'max:' . self::MAX_PER_PAGE,
            ],
            'page' => [
                'int',
                'min:1',
            ],
        ];
    }

    public function getPaginateDto(): PaginateDTO
    {
        return new PaginateDTO(
            page: $this->getValidationField('page', self::DEFAULT_PAGE),
            limit: $this->getValidationField('limit', self::DEFAULT_LIMIT),
        );
    }

    /**
     * Получить пропагинированое свойство
     *
     * @param string $filedName
     * @param mixed|null $defaultValue
     * @return mixed
     */
    private function getValidationField(string $filedName, mixed $defaultValue = null): mixed
    {
        if (!isset($this->validated()[$filedName])) {
            return $defaultValue;
        }

        return $this->validated()[$filedName];
    }
}
