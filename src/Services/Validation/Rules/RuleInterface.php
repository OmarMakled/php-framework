<?php

namespace App\Services\Validation\Rules;

interface RuleInterface
{
    /**
     * @param mixed $val
     * @return bool
     */
    public function isValid(mixed $val): bool;

    /**
     * @param string $filed
     * @return string
     */
    public function getMessage(string $filed): string;
}
