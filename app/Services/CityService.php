<?php


namespace App\Services;

use App\Models\City;
use Illuminate\Http\JsonResponse;

class CityService
{
    public function __construct()
    {
        $this->city = new City();
    }

    public function pagination(): JsonResponse
    {
        return response()->json(City::paginate());
    }

    public function getByRegion($regionId): JsonResponse
    {
        return response()->json(City::where('region_id', '=', $regionId)->get());
    }

    public function getAll(): JsonResponse
    {
        return response()->json(City::all());
    }

    public function store(array $validated): JsonResponse
    {
        $city = new City($validated);
        $city->save();

        return response()->json(['message' => 'Город успешно добавлен', 'data' => $city]);
    }


    public function update(City $city, array $validated): JsonResponse
    {

        $city->update($validated);

        return response()->json(['message' => 'Город успешно обновлен', 'data' => $city]);
    }

    public function delete(City $city)
    {
        $city->delete();
        return response()->json(['message' => 'Город успешно удален']);
    }
}
