#!/usr/bin/env php
<?php

$app = require_once __DIR__ . '/../app.php';

use App\DTO\CarDTO;
use App\Models\Car;
use App\Services\Parser\ParserFactory;
use App\Services\Parser\ParserService;
use App\Services\Validation\Validator;

$validator = new Validator();
$parserService = new ParserService(new ParserFactory());
$car = new Car($app->get('db'));
$file = $argv[1];
$total = 0;
foreach ($parserService->read($file) as $index => $row) {
    $data = CarDTO::createFromArray($row);
    $car->fill($data->toArray());

    if (! $validator->isValid($car)) {
        echo 'ERROR: row [' . ++$index . '] ' . $validator->getError() . PHP_EOL;
        continue;
    }

    $car->save();
    ++$total;
}

echo 'Data was imported total rows ' . $total;
