<?php

namespace Test\Unit\Services\Http;

use App\Services\Application;
use App\Services\Http\Request;
use App\Services\Http\Response;
use App\Services\Http\Router;
use Test\TestCase;

/**
 * @group unit
 */
class RouterTest extends TestCase
{
    private readonly Router $router;

    protected function setUp(): void
    {
        $app = new Application();
        $app->register('db', $this->getDatabaseConnection());
        $app->register('router', new Router(
            request: new Request(),
            response: new Response(),
            app: $app
        ));

        $this->router = $app->get('router');
    }

    public function testGetRouter()
    {
        $this->assertInstanceOf(Router::class, $this->router);
    }

    public function testResolveGet()
    {
        $controller = new class () {
            public function getAction(): string
            {
                return 'this is an action';
            }
        };
        $this->router->get('/api/foo', [
            'use' => $controller,
            'action' =>  'getAction'
        ]);
        $this->assertEquals('this is an action', $this->router->resolve('get', '/api/foo'));
    }

    public function testResolvePost()
    {
        $controller = new class () {
            public function getAction(): string
            {
                return 'this is an action';
            }
        };
        $this->router->post('/api/foo', [
            'use' => $controller,
            'action' =>  'getAction'
        ]);
        $this->assertEquals('this is an action', $this->router->resolve('post', '/api/foo'));
    }
}
