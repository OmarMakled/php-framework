<?php

declare(strict_types=1);

namespace App\Services\Database;

class DatabaseConfiguration
{
    /**
     * @param string $host
     * @param string $database
     * @param string $username
     * @param string $password
     */
    public function __construct(
        private readonly string $host,
        private readonly string $database,
        private readonly string $username,
        private readonly string $password
    ) {
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return sprintf(
            'mysql:host=%s;dbname=%s',
            $this->host,
            $this->database
        );
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
