<?php

namespace App\Services\Parser;

interface ParserInterface
{
    /**
     * @param string $file
     * @return array
     */
    public function read(string $file): array;
}
