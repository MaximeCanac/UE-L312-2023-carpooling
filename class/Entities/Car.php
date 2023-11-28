<?php

namespace App\Entities;

use DateTime;

class Car
{
    private $id;
    private $brand;
    private $model;
    private $year;
    private $place;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getYear(): DateTime
    {
        return $this->year;
    }

    public function setYear(DateTime $year): void
    {
        $this->year = $year;
    }

    public function getPlace(): int
    {
        return $this->place;
    }

    public function setPlace(int $place): void
    {
        $this->place= $place;
    }
}
