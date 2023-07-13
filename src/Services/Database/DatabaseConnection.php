<?php

declare(strict_types=1);

namespace App\Services\Database;

use PDO;

class DatabaseConnection implements DatabaseConnectionInterface
{
    private readonly PDO $pdo;

    /**
     * @param DatabaseConfiguration $dbConfig
     */
    public function __construct(DatabaseConfiguration $dbConfig)
    {
        $this->pdo = new PDO(
            $dbConfig->getDsn(),
            $dbConfig->getUsername(),
            $dbConfig->getPassword(),
            []
        );
    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
