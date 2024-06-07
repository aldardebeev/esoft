<?php

namespace App\Modules\Note\Http\Requests;

use App\Modules\Note\DTO\CreateOrUpdateNoteDTO;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateNoteRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'content' => [
                'required',
                'string',
                'max:1000',
            ]
        ];
    }

    public function toDto(): CreateOrUpdateNoteDTO
    {
        return new CreateOrUpdateNoteDTO(
            title:  $this->validated()['title'],
            content: $this->validated()['content'],
        );
    }
}
