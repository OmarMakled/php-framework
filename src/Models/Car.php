<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Attributes as Attributes;
use App\Services\Validation\Rules as Rules;

#[Attributes\Table(name: 'cars')]
class Car extends Model
{
    #[Attributes\Column(name: 'year')]
    private int $year;

    #[Attributes\Column(name: 'location')]
    private string $location;

    #[Attributes\Column(name: 'fuel_type')]
    private ?string $fuelType;

    #[Attributes\Column(name: 'model')]
    private string $model;

    #[Attributes\Column(name: 'doors')]
    #[Rules\GreaterThan(val: 0)]
    private int $doors;

    #[Attributes\Column(name: 'transmission')]
    private ?string $transmission;

    #[Attributes\Column(name: 'seats')]
    #[Rules\GreaterThan(val: 0)]
    private int $seats;

    #[Attributes\Column(name: 'brand')]
    private string $brand;

    #[Attributes\Column(name: 'type')]
    private ?string $type;

    #[Attributes\Column(name: 'type_group')]
    private ?string $typeGroup;

    #[Attributes\Column(name: 'details')]
    private array|string $details;

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string|null
     */
    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    /**
     * @param string|null $fuelType
     */
    public function setFuelType(?string $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getDoors(): int
    {
        return $this->doors;
    }

    /**
     * @param int $doors
     */
    public function setDoors(int $doors): void
    {
        $this->doors = $doors;
    }

    /**
     * @return string|null
     */
    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    /**
     * @param string|null $transmission
     */
    public function setTransmission(?string $transmission): void
    {
        $this->transmission = $transmission;
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     */
    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getTypeGroup(): ?string
    {
        return $this->typeGroup;
    }

    /**
     * @param string|null $typeGroup
     */
    public function setTypeGroup(?string $typeGroup): void
    {
        $this->typeGroup = $typeGroup;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return json_decode($this->details, true);
    }

    /**
     * @param string $details
     */
    public function setDetails(string $details): void
    {
        $this->details = $details;
    }
}
