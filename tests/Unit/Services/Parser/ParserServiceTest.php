<?php

namespace Test\Unit\Services\Parser;

use Test\TestCase;
use App\Services\Parser\FileReader;
use App\Services\Parser\ParserFactory;
use App\Services\Parser\ParserService;
use Test\Unit\Services\Parser\FilesTrait;
use App\Services\Parser\Exceptions\ParserException;

/**
 * @group unit
 */
class ParserServiceTest extends TestCase
{
    use FilesTrait;

    public function testReadJson()
    {
        $parserService = new ParserService(new ParserFactory());
        foreach ($parserService->read(self::$validJsonFile) as $key => $row) {
            $this->assertEquals(self::$output[$key], $row);
        }
    }

    public function testCsvFile()
    {
        $parserService = new ParserService(new ParserFactory());

        foreach ($parserService->read(self::$validCsvFile) as $key => $row) {
            $this->assertEquals(self::$output[$key], $row);
        }
    }
}
