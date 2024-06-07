<?php

namespace App\Modules\Note\Http\Resources;

use App\Common\Resources\DefaultResource;
use App\Modules\Note\DTO\NoteDTO;
use Illuminate\Http\Request;

class NoteResource extends DefaultResource
{
    public function toArray(Request $request): array
    {
        /** @var NoteDTO $noteDTO */
        $noteDTO = $this->resource['noteDTO'];

        return [
            'id' => $noteDTO->getId(),
            'userId' => $noteDTO->getUserId(),
            'title' => $noteDTO->getTitle(),
            'content' => $noteDTO->getContent(),
            'created_at' => $noteDTO->getCreatedAt(),
            'updated_at' => $noteDTO->getUpdatedAt(),
        ];
    }
}
