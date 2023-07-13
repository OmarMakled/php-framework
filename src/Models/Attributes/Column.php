<?php

declare(strict_types=1);

namespace App\Models\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    /**
     * @param string $name
     */
    public function __construct(public string $name)
    {
    }
}
