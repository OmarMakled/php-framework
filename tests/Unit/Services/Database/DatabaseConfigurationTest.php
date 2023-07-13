<?php

namespace Test\Unit\Services\Database;

use App\Services\Database\DatabaseConfiguration;
use Test\TestCase;

/**
 * @group unit
 */
class DatabaseConfigurationTest extends TestCase
{
    private DatabaseConfiguration $dbConfig;

    protected function setUp(): void
    {
        $this->dbConfig = new DatabaseConfiguration(
            host: 'localhost',
            database: 'test',
            username: 'root',
            password: 'password'
        );
    }

    public function testGetDsn()
    {
        $this->assertEquals($this->dbConfig->getDsn(), 'mysql:host=localhost;dbname=test');
    }

    public function testGetUsername()
    {
        $this->assertEquals($this->dbConfig->getUsername(), 'root');
    }

    public function testGetPassword()
    {
        $this->assertEquals($this->dbConfig->getPassword(), 'password');
    }
}
