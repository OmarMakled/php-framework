<?php

$app = require_once __DIR__ . '/../src/app.php';
$router = $app->get('router');

/**
 * Set exception handler
 */
set_exception_handler(function () use ($router) {
    $router->exceptionHandler();
});
set_error_handler(function () use ($router) {
    $router->errorHandler();
}, E_ALL);

$router->run();
  