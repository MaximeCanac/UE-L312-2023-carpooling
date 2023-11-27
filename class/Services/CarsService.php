<?php

namespace App\Services;

use App\Entities\Car;
use DateTime;

class CarsService
{
    /**
     * Create or update an car.
     */
    public function setCar(?string $id, string $brand, string $model, string $year, string $place): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $yearDateTime = new DateTime($year);
        if (empty($id)) {
            $isOk = $dataBaseService->createCar($brand, $model, $yearDateTime, $place);
        } else {
            $isOk = $dataBaseService->updateCar($id,$brand, $model, $yearDateTime, $place);
        }

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $Cars = [];

        $dataBaseService = new DataBaseService();
        $CarsDTO = $dataBaseService->getCars();
        if (!empty($CarsDTO)) {
            foreach ($CarsDTO as $CarDTO) {
                $Car = new Car();
                $Car->setId($CarDTO['id']);
                $Car->setBrand($CarDTO['brand']);
                $Car->setModel($CarDTO['model']);
                $year = new DateTime($CarDTO['year']);
                if ($year !== false) {
                    $Car->setYear($year);
                }
                $Car->setPlace($CarDTO['place']);
                $Cars[] = $Car;
            }
        }

        return $Cars;
    }

    /**
     * Delete an car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $dataBaseService = new DataBaseService();
        $isOk = $dataBaseService->deleteCar($id);

        return $isOk;
    }
}
