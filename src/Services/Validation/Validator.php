<?php

declare(strict_types=1);

namespace App\Services\Validation;

use App\Services\Validation\Rules\RuleInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

class Validator
{
    private ?string $error = null;

    /**
     * Determine whether the given object is valid based on the defined rules
     *
     * @param mixed $class
     * @return bool
     * @throws \ReflectionException
     */
    public function isValid(mixed $class): bool
    {
        foreach ((new ReflectionClass($class))->getProperties(ReflectionProperty::IS_PRIVATE) as $prop) {
            foreach ($prop->getAttributes(RuleInterface::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $rule = $attribute->newInstance();
                if (!$rule->isValid($prop->getValue($class))) {
                    $this->error = $rule->getMessage($prop->getName());

                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }
}
