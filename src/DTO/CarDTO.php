<?php

declare(strict_types=1);

namespace App\DTO;

class CarDTO extends BaseDTO
{
    /**
     * @param int $year
     * @param string $location
     * @param string|null $fuelType
     * @param string $model
     * @param int $doors
     * @param string|null $transmission
     * @param int $seats
     * @param string $brand
     * @param string|null $type
     * @param string|null $typeGroup
     * @param string $details
     */
    public function __construct(
        public readonly int $year,
        public readonly string $location,
        public readonly ?string $fuelType,
        public readonly string $model,
        public readonly int $doors,
        public readonly ?string $transmission,
        public readonly int $seats,
        public readonly string $brand,
        public readonly ?string $type,
        public readonly ?string $typeGroup,
        public readonly string $details
    ) {
    }

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $data): self
    {
        return new CarDTO(
            year: (int) $data['Car year'],
            location: $data['Location'],
            fuelType: $data['Fuel type'],
            model: $data['Car Model'],
            doors: (int) $data['Number of doors'],
            transmission: $data['Transmission'],
            seats: (int) $data['Number of seats'],
            brand: $data['Car Brand'],
            type: $data['Car Type'] ?? null,
            typeGroup: $data['Car Type Group'] ?? null,
            details: json_encode([
                'Inside height' => $data['Inside height'] ?? null,
                'Inside length' => $data['Inside length'] ?? null,
                'Inside width' => $data['Inside width'] ?? null,
                'License plate' => $data['License plate'] ?? null
            ])
        );
    }
}
