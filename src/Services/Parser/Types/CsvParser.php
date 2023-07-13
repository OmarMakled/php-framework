<?php

declare(strict_types=1);

namespace App\Services\Parser\Types;

use Throwable;
use App\Services\Parser\ParserInterface;
use App\Services\Parser\Exceptions\ParserException;

class CsvParser implements ParserInterface
{
    /**
     * @inheritDoc
     * @throws ParserException
     */
    public function read(string $file): array
    {
        if (!($fp = @fopen($file, 'r'))) {
            throw new ParserException('Can not open the file ' . $file);
        }

        try {
            $rows = [];
            $key = fgetcsv($fp);
            while ($row = fgetcsv($fp)) {
                $rows[] = array_combine($key, $row);
            }
            fclose($fp);

            return $rows;
        } catch (Throwable $e) {
            throw new ParserException('Invalid given csv');
        }
    }
}
