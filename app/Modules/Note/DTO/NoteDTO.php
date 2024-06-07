<?php

namespace App\Modules\Note\DTO;

use Carbon\Carbon;

class NoteDTO
{
    public function __construct(
        private readonly int $id,
        private readonly int $userId,
        private readonly string $title,
        private readonly string $content,
        private readonly Carbon $created_at,
        private readonly Carbon $updated_at,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }
}
