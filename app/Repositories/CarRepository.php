<?php


namespace App\Repositories;


use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CarRepository
{

    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function getAll()
    {
        return $this->car
            ->all();
    }

    public function find($id, $with = [])
    {
        $car = $this->car;
        $car->when(count($with) > 0, function ($query) use ($with, $car) {
            $car->with($with);
        });
        return $car->findOrFail($id);

    }
    public function save($data)
    {
        try {
            DB::connection()->getPdo()->beginTransaction();
            $car = $this->car;
            $car->fill($data);
            $car->save();
            DB::connection()->getPdo()->commit();
            return $this->find($car->id);
        } catch (\PDOException $e) {
            Log::error("Error (".__CLASS__."), (" . __METHOD__ . ")", ['Payload:' => $e->getMessage()]);
            DB::connection()->getPdo()->rollBack();
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            DB::connection()->getPdo()->beginTransaction();
            $car = $this->car->findOrFail($id);
            $car->update($data);
            DB::connection()->getPdo()->commit();
            return $car;
        } catch (\PDOException $e) {
            Log::error("Error (".__CLASS__."), (" . __METHOD__ . ")", ['Payload:' => $e->getMessage()]);
            DB::connection()->getPdo()->rollBack();
            return false;
        }
    }
}