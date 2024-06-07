<?php

namespace App\Common\Helpers;

use Illuminate\Support\Carbon;

class TimeHelper
{
    /**
     * Получить текущее время UTC в определенном формате
     *
     * @return Carbon
     */
    public static function getCurrentServerTime(): Carbon
    {
        return Carbon::now(self::getUtcTimeZoneName());
    }

    /**
     * Получить текущее время UTC в определенном формате
     *
     * @return Carbon
     */
    public static function getCurrentUtcTime(): Carbon
    {
        return Carbon::now(self::getUtcTimeZoneName());
    }

    /**
     * Получить название серверной таймзоны
     *
     * @return string
     */
    public static function getServerTimeZoneName(): string
    {
        return 'UTC';
    }

    /**
     * Получить название ютс таймзоны
     *
     * @return string
     */
    public static function getUtcTimeZoneName(): string
    {
        return 'UTC';
    }

    /**
     * Переформатировать кардон
     *
     * @param Carbon $time
     * @return string
     */
    public static function toIsoFormat(Carbon $time): string
    {
        return $time->toISOString();
    }

    /**
     * Создать из строки в бд объект серверного времени
     *
     * @param string|null $datetimeString
     * @return Carbon|null
     */
    public static function makeServerTimeFromString(?string $datetimeString): ?Carbon
    {
        if (is_null($datetimeString)) {
            return null;
        }

        return Carbon::make($datetimeString)->shiftTimezone(self::getServerTimeZoneName());
    }
}
