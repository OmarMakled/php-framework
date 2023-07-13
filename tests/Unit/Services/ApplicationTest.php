<?php

namespace Test\Unit\Services;

use App\Services\Application;
use Test\TestCase;

/**
 * @group unit
 */
class ApplicationTest extends TestCase
{
    private readonly Application $app;

    protected function setUp(): void
    {
        $this->app = new Application();
    }

    public function testRegister()
    {
        $service = new class () {
            public function log(): string
            {
                return 'logger';
            }
        };
        $this->app->register('logger', $service);
        $logger = $this->app->get('logger');

        $this->assertInstanceOf($service::class, $logger);
        $this->assertEquals('logger', $logger->log());
    }

    public function testGetConfig()
    {
        $this->assertIsArray($this->app->getConfig());
    }
}
