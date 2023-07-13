<?php

declare(strict_types=1);

namespace App\Services\Http;

use App\Models\Car;
use App\Services\Application;

class Router
{
    private array $handlers;

    /**
     * @param Request $request
     * @param Response $response
     * @param Application $app
     */
    public function __construct(
        private readonly Request $request,
        private readonly Response $response,
        private readonly Application $app
    ) {
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function get(string $path, array $handler): void
    {
        $this->addHandler(Request::GET, $path, $handler);
    }

    /**
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function post(string $path, array $handler): void
    {
        $this->addHandler(Request::POST, $path, $handler);
    }

    /**
     * @param string $method
     * @param string $path
     * @return mixed
     */
    public function resolve(string $method, string $path): mixed
    {
        $callback = $this->handlers[$method . $path]['handler'];

        return call_user_func_array([
            new $callback['use']($this->request),
            $callback['action']
        ], [new Car($this->app->get('db')), $this->response]);
    }

    /**
     * @param string $method
     * @param string $path
     * @param array $handler
     * @return void
     */
    public function addHandler(string $method, string $path, array $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    /**
     * @return mixed
     */
    public function run(): mixed
    {
        $method = $this->request->getMethod();
        $path = $this->request->getUri();

        foreach ($this->handlers as $handler) {
            if ($method === $handler['method'] && $handler['path'] === $path) {
                return $this->resolve($method, $path);
            }
        }

        return $this->response->send(Response::NOT_FOUND);
    }

    /**
     * @return void
     */
    public function exceptionHandler(): void
    {
        $this->response->send(Response::SERVER_ERROR);
    }

    /**
     * @return void
     */
    public function errorHandler(): void
    {
        $this->response->send(Response::BAD_REQUEST);
    }
}
