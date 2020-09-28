<?php


namespace App\Services;


use App\Repositories\CarRepository;

class CarService
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function getAll()
    {
        return $this->carRepository->getAll();
    }

    public function saveCar($collection)
    {
        return $this->carRepository->save($collection);
    }

}