<?php

namespace Test\Unit\Services\Parser;

use Test\TestCase;
use Test\Unit\Services\Parser\FilesTrait;
use App\Services\Parser\Types\JsonParser;
use App\Services\Parser\Exceptions\ParserException;

/**
 * @group unit
 */
class JsonParserTest extends TestCase
{
    use FilesTrait;

    public function testRead(): void
    {
        $reader = new JsonParser();
        $rows = $reader->read(self::$validJsonFile);

        $this->assertIsArray($rows);
        $this->assertEquals(2, count($rows));
        $this->assertEquals(self::$output, $rows);
    }

    public function testParserExceptionInvalidJson(): void
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('Invalid given json');

        $reader = new JsonParser();
        $reader->read(self::$invalidJsonFile);
    }

    public function testParserExceptionCanOpen(): void
    {
        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('Can not open the file foo.json');

        $reader = new JsonParser();
        $reader->read('foo.json');
    }
}
