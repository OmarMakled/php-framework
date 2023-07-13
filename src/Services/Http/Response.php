<?php

declare(strict_types=1);

namespace App\Services\Http;

class Response
{
    public const SUCCESS = 'HTTP/1.0 200 OK';
    public const NOT_FOUND = 'HTTP/1.0 404 Not Found';
    public const CREATED = 'HTTP/1.0 201 Created';
    public const UNPROCESSABLE_ENTITY = 'HTTP/1.0 422 Unprocessable Entity';
    public const BAD_REQUEST = 'HTTP/1.0 400 Bad Request';
    public const SERVER_ERROR = 'HTTP/1.0 500 Internal Server Error';

    /**
     * @param string $code
     * @param array|null $data
     * @return void
     */
    public function send(string $code, ?array $data = []): void
    {
        header('Content-Type: application/json; charset=utf-8');
        header($code);
        exit(json_encode($data));
    }
}
