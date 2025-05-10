<?php declare(strict_types=1);

namespace App\GraphQL\Scalars;

use Illuminate\Support\Carbon;

class DayOfWeek extends FromIntegerDateScalar
{
    protected function format(Carbon $carbon): string
    {
        return $carbon->format('l');
    }

    protected function parse(int $value): Carbon
    {
        // @phpstan-ignore-next-line We know the format to be good, so this can never return `false`
        return Carbon::parse($value);
    }
}
