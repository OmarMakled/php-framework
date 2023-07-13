<?php

declare(strict_types=1);

namespace App\Models\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Table
{
    /**
     * @param string $name
     */
    public function __construct(public string $name)
    {
    }
}
