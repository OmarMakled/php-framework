<?php

declare(strict_types=1);

namespace App\DTO;

interface DTOInterface
{
    /**
     * @param array $data
     * @return static
     */
    public static function createFromArray(array $data): self;

    /**
     * @return array
     */
    public function toArray(): array;
}
