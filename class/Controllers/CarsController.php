<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{
    /**
     * Return the html for the create action.
     */
    public function createCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['place'])) {
            // Create the Car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                null,
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['place']
            );
            if ($isOk) {
                $html = 'Voiture créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): string
    {
        $html = '';

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) {
            $html .=
                '#' . $car->getId() . ' ' .
                $car->getBrand() . ' ' .
                $car->getModel() . ' ' .
                $car->getColor() . ' ' .
                $car->getPlace() . '<br />' ;
        }

        return $html;
    }

    /**
     * Update the car.
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
            isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['place'])) {
            // Update the car :
            $carsService = new CarsService();
            $isOk = $carsService->setCar(
                $_POST['id'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['place']
            );
            if ($isOk) {
                $html = 'Voiture mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Delete an car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the Car :
            $carsService = new CarsService();
            $isOk = $carsService->deleteCar($_POST['id']);
            if ($isOk) {
                $html = 'Voiture supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
}
