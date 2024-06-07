<?php

namespace App\Modules\Note\DTO;

use Carbon\Carbon;

class PaginateDTO
{
    public function __construct(
        private readonly int $page,
        private readonly int $limit,
    )
    {
    }

    public function getPage(): int
    {
        return  $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
