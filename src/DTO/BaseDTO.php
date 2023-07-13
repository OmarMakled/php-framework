<?php

declare(strict_types=1);

namespace App\DTO;

use ReflectionClass;
use ReflectionProperty;

abstract class BaseDTO implements DTOInterface
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];
        foreach ((new ReflectionClass($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
            $data[$prop->getName()] = $prop->getValue($this);
        }

        return $data;
    }
}
