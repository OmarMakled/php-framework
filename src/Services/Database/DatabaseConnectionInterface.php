<?php

namespace App\Services\Database;

use PDO;

interface DatabaseConnectionInterface
{
    /**
     * @return PDO
     */
    public function getPDO(): PDO;
}
