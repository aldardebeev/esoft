<?php

namespace App\Common\Resources;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property LengthAwarePaginator resource
 */
abstract class ResponseWithPaginateResource extends DefaultResource
{
    abstract protected function getItemResource(): DefaultResource;

    public function toArray(Request $request): array
    {
        return [
            'list' => $this->getItemResource()::collection($this->resource->items()),
            'paginate' => new PaginateResource($this->resource),
            'common' => $this->when(
                !is_null($this->getCommonResource()),
                $this->getCommonResource(),
            ),
        ];
    }

    /**
     * Общие данные для всего списка
     *
     * @return DefaultResource|null
     */
    protected function getCommonResource(): ?DefaultResource
    {
        return null;
    }
}
