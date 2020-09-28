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

    public function find($id)
    {
        return $this->carRepository->find($id);
    }

    public function getAll()
    {
        return $this->carRepository->getAll();
    }

    public function saveCar($data)
    {
        return $this->carRepository->save($data);
    }

    public function updateCar($data, $id)
    {
        return $this->carRepository->update($data, $id);
    }

    public function delete($id) {
        return $this->carRepository->delete($id);
    }

}