<?php

namespace Test\Unit\Services\Parser\Types;

use Test\TestCase;
use App\Services\Parser\Types\CsvParser;
use Test\Unit\Services\Parser\FilesTrait;
use App\Services\Parser\Exceptions\ParserException;

/**
 * @group unit
 */
class CsvParserTest extends TestCase
{
    use FilesTrait;

    public function testRead(): void
    {
        $reader = new CsvParser();
        $rows = $reader->read(self::$validCsvFile);

        $this->assertIsArray($rows);
        $this->assertEquals(2, count($rows));
        $this->assertEquals(self::$output, $rows);
    }

    public function testParserExceptionCanOpen(): void
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('Can not open the file foo.json');

        $parser = new CsvParser();
        $parser->read('foo.json');
    }

    public function testParserExceptionInvalidCsv(): void
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('Invalid given csv');

        $parser = new CsvParser();
        $parser->read(self::$invalidCsvFile);
    }
}
