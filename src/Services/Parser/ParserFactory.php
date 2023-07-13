<?php

declare(strict_types=1);

namespace App\Services\Parser;

use App\Services\Parser\Types\CsvParser;
use App\Services\Parser\Types\JsonParser;
use App\Services\Parser\Exceptions\ParserException;

class ParserFactory
{
    /**
     * @param string $file
     * @return ParserInterface
     * @throws ParserException
     */
    public function create(string $file): ParserInterface
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if ($ext == 'csv') {
            return new CsvParser();
        }

        if ($ext == 'json') {
            return new JsonParser();
        }

        throw new ParserException('There is no parser for the given file');
    }
}
