<?php

namespace Test\Unit\DTO;

use Test\TestCase;
use App\DTO\CarDTO;

class CarDTOTest extends TestCase
{
    public function testCreateFromArray()
    {
        $data =  [
            "Car km" => "160402",
            "Car year" => "2015",
            "Location" => "Ede West",
            "Fuel type" => "Diesel",
            "Car Model" => "Transit Connect",
            "Number of doors" => "3",
            "Transmission" => "Manual",
            "Number of seats" => "3",
            "Car Brand" => "Ford"
         ];

        $carDTO = CarDTO::createFromArray($data);

        $this->assertEquals($carDTO->year, 2015);
        $this->assertEquals($carDTO->location, 'Ede West');
        $this->assertEquals($carDTO->fuelType, 'Diesel');
        $this->assertEquals($carDTO->model, 'Transit Connect');
        $this->assertEquals($carDTO->doors, 3);
        $this->assertEquals($carDTO->transmission, 'Manual');
        $this->assertEquals($carDTO->seats, 3);
        $this->assertEquals($carDTO->brand, 'Ford');
    }

    public function testToArray()
    {
        $data =  [
            "Car km" => "160402",
            "Car year" => "2015",
            "Location" => "Ede West",
            "Fuel type" => "Diesel",
            "Car Model" => "Transit Connect",
            "Number of doors" => "3",
            "Transmission" => "Manual",
            "Number of seats" => "3",
            "Car Brand" => "Ford"
         ];

        $data = CarDTO::createFromArray($data)->toArray();

        $this->assertEquals($data['year'], 2015);
        $this->assertEquals($data['location'], 'Ede West');
        $this->assertEquals($data['fuelType'], 'Diesel');
        $this->assertEquals($data['model'], 'Transit Connect');
        $this->assertEquals($data['doors'], 3);
        $this->assertEquals($data['transmission'], 'Manual');
        $this->assertEquals($data['seats'], 3);
        $this->assertEquals($data['brand'], 'Ford');
    }
}
