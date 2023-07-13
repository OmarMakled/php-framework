<?php

declare(strict_types=1);

namespace App\Services;

class Application
{
    private array $services = [];

    /**
     * @param string $key
     * @param mixed $service
     * @return void
     */
    public function register(string $key, mixed $service): void
    {
        $this->services[$key] = $service;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->services[$key];
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return require __DIR__ . '/../config/app.php';
    }
}
