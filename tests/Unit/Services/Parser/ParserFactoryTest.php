<?php

namespace Test\Unit\Services\Parser;

use App\Services\Parser\Exceptions\ParserException;
use App\Services\Parser\ParserFactory;
use App\Services\Parser\Types\CsvParser;
use App\Services\Parser\Types\JsonParser;
use Test\TestCase;

/**
 * @group unit
 */
class ParserFactoryTest extends TestCase
{
    public function testCreateCsvParser(): void
    {
        $factory = new ParserFactory();

        $parser = $factory->create('var/app/foo.csv');
        $this->assertInstanceOf(CsvParser::class, $parser);
    }

    public function testCreateJsonParser(): void
    {
        $factory = new ParserFactory();

        $parser = $factory->create('var/app/foo.json');
        $this->assertInstanceOf(JsonParser::class, $parser);
    }

    public function testParserException(): void
    {
        $factory = new ParserFactory();

        $this->expectException(ParserException::class);
        $this->expectExceptionMessage('There is no parser for the given file');

        $factory->create('var/app/foo.txt');
    }
}
