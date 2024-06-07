<?php

namespace App\Common\Resources;

use App\Common\Helpers\TimeHelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultResource extends JsonResource
{
    public function getPropertyOrNull(string $name)
    {
        if (!empty($this->resource->$name)) {
            return $this->resource->$name ?? null;
        }

        if (is_array($this->resource) && !empty($this->resource[$name])) {
            return $this->resource[$name] ?? null;
        }

        return null;
    }

    public function toString(?string $value): string
    {
        return $value ?: '';
    }

    public function toInt(?string $value): int
    {
        return (int)$value;
    }

    public function toBool(mixed $value): bool
    {
        return (bool)$value;
    }

    public function toDatetimeString(Carbon $datetime): string
    {
        return $datetime->toISOString();
    }

    public function toTime(?string $value): ?string
    {
        try {
            return TimeHelper::toIsoFormat(TimeHelper::makeServerTimeFromString($value));
        } catch (\Throwable) {
            return null;
        }
    }
}
