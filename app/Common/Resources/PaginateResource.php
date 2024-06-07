<?php

namespace App\Common\Resources;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property LengthAwarePaginator resource
 */
class PaginateResource extends DefaultResource
{
    public function toArray(Request $request): array
    {
        return [
            'per_page' => $this->resource->perPage(),
            'page' => $this->resource->currentPage(),
            'count' => $this->resource->total(),
            'pages' => ceil($this->resource->total() / $this->resource->perPage()),
        ];
    }
}
