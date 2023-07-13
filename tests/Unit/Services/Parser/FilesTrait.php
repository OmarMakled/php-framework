<?php

namespace Test\Unit\Services\Parser;

trait FilesTrait
{
    private static string $validJsonFile = __DIR__ . '/valid-json.json';
    private static string $validCsvFile = __DIR__ . '/valid-csv.csv';
    private static string $invalidJsonFile = __DIR__ . '/invalid-json.json';
    private static string $invalidCsvFile = __DIR__ . '/invalid-csv.csv';
    private static array $output = [
        ['foo' => 1, 'bar' => 2],
        ['foo' => 3, 'bar' => 4]
    ];
    private static string $validJson = '[
        {"foo": 1, "bar": 2},
        {"foo": 3, "bar": 4}
    ]';
    private static string $validCsv = 'foo,bar
        1,2
        3,4';
    private static string $invalidJson = '[
        {"foo": 1, "bar": 2},
        {"foo": 3, "bar" 4}
    ]';
    private static string $invalidCsv = 'foo
        1,2
        3,4';

    public static function setUpBeforeClass(): void
    {
        file_put_contents(self::$validJsonFile, self::$validJson);
        file_put_contents(self::$invalidJsonFile, self::$invalidJson);
        file_put_contents(self::$validCsvFile, self::$validCsv);
        file_put_contents(self::$invalidCsvFile, self::$invalidCsv);
    }

    public static function tearDownAfterClass(): void
    {
        unlink(self::$validJsonFile);
        unlink(self::$invalidJsonFile);
        unlink(self::$validCsvFile);
        unlink(self::$invalidCsvFile);
    }
}
