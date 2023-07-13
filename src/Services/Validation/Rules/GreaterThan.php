<?php

declare(strict_types=1);

namespace App\Services\Validation\Rules;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class GreaterThan implements RuleInterface
{
    private const ERROR = 'The field %s should be greater than %s';

    /**
     * @param int $val
     */
    public function __construct(public readonly int $val)
    {
    }

    /**
     * @inheritDoc
     */
    public function isValid(mixed $val): bool
    {
        return $val > $this->val;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(string $filed): string
    {
        return sprintf(self::ERROR, $filed, $this->val);
    }
}
