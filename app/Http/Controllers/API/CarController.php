<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{

    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->carService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        $data = $request->all();
        $result = $this->carService->saveCar($data);
        if ($result) {
            return response()->json([
                'data' => $result,
                'message' => "Car created successfully !"
            ], 200);
        } else {
            return response()->json([
                'message' => "Can't create car. Try again later"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->carService->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function update(CarRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->carService->updateCar($data, $id);
        if ($result) {
            return response()->json([
                'data' => $result,
                'message' => "Car updated successfully !"
            ], 200);
        } else {
            return response()->json([
                'message' => "Can't update car. Try again later"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Car $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
