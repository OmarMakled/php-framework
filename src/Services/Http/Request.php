<?php

declare(strict_types=1);

namespace App\Services\Http;

class Request
{
    public const GET = 'get';
    public const POST = 'post';

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);

        return $requestUri['path'];
    }

    /**
     * Get request body
     *
     * @return array
     */
    public function getBody(): array
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            $data = json_decode(file_get_contents('php://input'), true) ?? [];
        }

        return $data;
    }

    /**
     * Get from request body by name
     *
     * @param string $name
     * @return string|null
     */
    public function get(string $name): ?string
    {
        $body = $this->getBody();

        return $body[$name] ?? null;
    }

    /**
     * @return bool
     */
    private function isGet(): bool
    {
        return $this->getMethod() == self::GET;
    }

    /**
     * @return bool
     */
    private function isPost(): bool
    {
        return $this->getMethod() == self::POST;
    }
}
