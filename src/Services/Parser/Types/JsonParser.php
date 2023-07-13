<?php

declare(strict_types=1);

namespace App\Services\Parser\Types;

use App\Services\Parser\ParserInterface;
use App\Services\Parser\Exceptions\ParserException;

class JsonParser implements ParserInterface
{
    /**
     * @inheritDoc
     * @throws ParserException
     */
    public function read(string $file): array
    {
        if (!$data = @file_get_contents($file)) {
            throw new ParserException('Can not open the file ' . $file);
        }

        if (is_null($rows = json_decode($data, true))) {
            throw new ParserException('Invalid given json');
        }

        return $rows;
    }
}
