<?php

namespace Test\Unit\Models;

use Test\TestCase;
use App\DTO\CarDTO;
use App\Models\Car;

class CarTest extends TestCase
{
    private $car;

    protected function setUp(): void
    {
        $this->car = new Car($this->getDatabaseConnection());
    }

    public function testCreateCartDTO()
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
            "Car Brand" => "Ford",
            "Car Type Group" => "Car",
            "Car Type" => "Small Car",
            "Inside height" => null,
            "Inside length" => null,
            "Inside width" => null,
            "License plate" => null
         ];

        $car = $this->car->fill(
            CarDTO::createFromArray($data)->toArray()
        );
         $this->assertEquals($this->car->getYear(), 2015);
         $this->assertEquals($this->car->getLocation(), 'Ede West');
         $this->assertEquals($this->car->getFuelType(), 'Diesel');
         $this->assertEquals($this->car->getModel(), 'Transit Connect');
         $this->assertEquals($this->car->getDoors(), 3);
         $this->assertEquals($this->car->getTransmission(), 'Manual');
         $this->assertEquals($this->car->getSeats(), 3);
         $this->assertEquals($this->car->getBrand(), 'Ford');
         $this->assertEquals($this->car->getTypeGroup(), 'Car');
         $this->assertEquals($this->car->getType(), 'Small Car');
         $this->assertEquals($this->car->getDetails(), [
            "Inside height" => null,
            "Inside length" => null,
            "Inside width" => null,
            "License plate" => null
         ]);
        $this->assertInstanceOf(Car::class, $car);
    }
}
