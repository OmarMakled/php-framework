<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\CarDTO;
use App\Models\Car;
use App\Services\Http\Response;
use App\Services\Validation\Validator;
use App\Transformers\CarTransformer;

class ApiController extends BaseController
{
    /**
     * Get list of cars
     *
     * @param Car $car
     * @param Response $response
     * @return void
     */
    public function getList(Car $car, Response $response): void
    {
        $response->send(Response::SUCCESS, CarTransformer::toArray($car->selectAll()));
    }

    /**
     * Get list of cars by location
     *
     * @param Car $car
     * @param Response $response
     * @return void
     */
    public function getListByLocation(Car $car, Response $response): void
    {
        $cars = $car->selectWhere('location', $this->request->get('query'));

        $response->send(Response::SUCCESS, CarTransformer::toArray($cars));
    }

    /**
     * Get list of cars by year
     *
     * @param Car $car
     * @param Response $response
     * @return void
     */
    public function getListByYear(Car $car, Response $response): void
    {
        $cars = $car->selectWhere('year', $this->request->get('query'));

        $response->send(Response::SUCCESS, CarTransformer::toArray($cars));
    }

    /**
     * Create new car
     *
     * @param Car $car
     * @param Response $response
     * @return void
     */
    public function create(Car $car, Response $response): void
    {
        $data = CarDTO::createFromArray($this->request->getBody())->toArray();
        $car = $car->fill($data);

        $validator = new Validator();
        if (! $validator->isValid($car)) {
            $response->send(Response::UNPROCESSABLE_ENTITY, ['error' => $validator->getError()]);
        }

        $car->save();
        $response->send(Response::CREATED);
    }
}
