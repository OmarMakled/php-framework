<?php

namespace Test\Unit\Services\Database;

use PDO;
use Test\TestCase;
use App\Services\Application;
use App\Services\Database\DatabaseConnection;
use App\Services\Database\DatabaseConfiguration;

/**
 * @group unit
 */
class DatabaseConnectionTest extends TestCase
{
    protected function setUp(): void
    {
        $config = (new Application())->getConfig()['mysql'];
        $dbConfig = new DatabaseConfiguration(
            host: $config['host'],
            database: $config['database'],
            username: $config['username'],
            password: $config['password']
        );

        $this->dbConn = new DatabaseConnection($dbConfig);
    }

    public function testGetPDO()
    {
        $this->assertInstanceOf(PDO::class, $this->dbConn->getPDO());
    }
}
