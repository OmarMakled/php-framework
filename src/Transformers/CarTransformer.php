<?php

declare(strict_types=1);

namespace App\Transformers;

class CarTransformer
{
    /**
     * @param array $cars
     * @return array
     */
    public static function toArray(array $cars): array
    {
        $resource = [
            'total' => count($cars),
            'items' => []
        ];
        foreach ($cars as $car) {
            $resource['items'][] = [
                'id' => $car->id,
                'year' => $car->year,
                'location' => $car->location,
                'fuelType' => $car->fuel_type,
                'model' => $car->model,
                'doors' => $car->doors,
                'transmission' => $car->transmission,
                'seats' => $car->seats,
                'brand' => $car->brand,
                'type' => $car->type,
                'typeGroup' => $car->type_group,
                'details' => json_decode($car->details, true)
            ];
        }

        return $resource;
    }
}
