<?php

namespace Test;

use PHPUnit\Framework\TestCase as BaseTestCase;
use App\Services\Database\DatabaseConnectionInterface;
use PDO;

abstract class TestCase extends BaseTestCase
{
    public function getDatabaseConnection(): DatabaseConnectionInterface
    {
        return new FakeDatabaseConnection();
    }
}

class FakeDatabaseConnection implements DatabaseConnectionInterface
{
    public function getPDO(): PDO
    {
        return new PDO('', '', '');
    }
}
