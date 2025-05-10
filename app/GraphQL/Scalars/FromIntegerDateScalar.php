<?php

namespace App\GraphQL\Scalars;

use Carbon\Carbon as CarbonCarbon;
use Carbon\CarbonImmutable;
use GraphQL\Error\Error;
use GraphQL\Error\InvariantViolation;
use GraphQL\Language\AST\IntValueNode;
use GraphQL\Language\AST\Node;
use GraphQL\Language\AST\StringValueNode;
use GraphQL\Type\Definition\ScalarType;
use Illuminate\Support\Carbon as IlluminateCarbon;
use Nuwave\Lighthouse\Schema\Types\Scalars\DateScalar;

abstract class FromIntegerDateScalar extends ScalarType
{
    public function serialize($value): string
    {
        if (! $value instanceof IlluminateCarbon) {
            $value = $this->tryParsingDate($value, InvariantViolation::class);
        }

        return $this->format($value);
    }

    /** Parse an externally provided variable value into a Carbon instance. */
    public function parseValue(mixed $value): IlluminateCarbon
    {
        return $this->tryParsingDate($value, Error::class);
    }

    public function parseLiteral(Node $valueNode, ?array $variables = null): IlluminateCarbon
    {
        if (! $valueNode instanceof IntValueNode) {
            throw new Error("Query error: Can only parse strings, got {$valueNode->kind}.", $valueNode);
        }

        return $this->tryParsingDate($valueNode->value, Error::class);
    }

    protected function tryParsingDate(mixed $value, string $exceptionClass): IlluminateCarbon
    {
        try {
            if (is_object($value)) {
                if ($value::class === IlluminateCarbon::class) {
                    return $value;
                }

                // We want to know if we have exactly a Carbon\Carbon, not a subclass thereof
                if ($value::class === CarbonCarbon::class
                    || $value::class === CarbonImmutable::class
                ) {
                    $carbon = IlluminateCarbon::create(
                        $value->year,
                        $value->month,
                        $value->day,
                        $value->hour,
                        $value->minute,
                        $value->second,
                        $value->timezone,
                    );
                    assert($carbon instanceof IlluminateCarbon, 'Given we had a valid Carbon instance before, this can not fail.');

                    return $carbon;
                }
            }

            if (!is_integer($value)) {
                throw new $exceptionClass('Query error: Can only parse an integer.');
            }

            return $this->parse($value);
        } catch (\Exception $exception) {
            throw new $exceptionClass($exception->getMessage());
        }
    }

    /** Serialize the Carbon instance. */
    abstract protected function format(IlluminateCarbon $carbon): string;

    /**
     * Try turning a client value into a Carbon instance.
     *
     * @param  int  $value a possibly faulty client value
     */
    abstract protected function parse(int $value): IlluminateCarbon;
}
