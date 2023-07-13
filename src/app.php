<?php

require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/config/app.php';

use App\Services\Application;
use App\Services\Http\Router;
use App\Services\Http\Request;
use App\Services\Http\Response;
use App\Controller\ApiController;
use App\Services\Database\DatabaseConnection;
use App\Services\Database\DatabaseConfiguration;

/**
 * Register services
 */
$app = new Application();
$app->register('db', new DatabaseConnection(
    new DatabaseConfiguration(
        host: $config['mysql']['host'],
        database: $config['mysql']['database'],
        username: $config['mysql']['username'],
        password: $config['mysql']['password']
    )
));
$app->register('router', new Router(
    request: new Request(),
    response: new Response(),
    app: $app
));

/**
 * Register routes
 */
$router = $app->get('router');
$router->get('/api/cars', [
    'use' => ApiController::class,
    'action' => 'getList'
]);
$router->get('/api/cars/location', [
    'use' => ApiController::class,
    'action' => 'getListByLocation'
]);
$router->get('/api/cars/year', [
    'use' => ApiController::class,
    'action' => 'getListByYear'
]);
$router->post('/api/cars', [
    'use' => ApiController::class,
    'action' => 'create'
]);

return $app;
