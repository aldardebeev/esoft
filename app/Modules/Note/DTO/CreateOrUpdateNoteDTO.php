<?php

namespace App\Modules\Note\DTO;

use App\Common\VO\EmailVO;

class CreateOrUpdateNoteDTO
{
    public function __construct(
        private readonly string $title,
        private readonly string $content,
    )
    {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
