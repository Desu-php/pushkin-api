<?php


namespace App\Services;

use App\Models\Region;
use Illuminate\Http\JsonResponse;

class RegionService
{
	public function __construct()
	{
		$this->region = new Region();
	}


    public function pagination(): JsonResponse
    {
        return response()->json(Region::paginate());
    }


    public function getAll() : JsonResponse
	{
		return response()->json(Region::all());
	}

    public function store(array $validated) : JsonResponse
	{
		$region = new Region($validated);
		$region->save();

		return response()->json(['message' => 'Регион успешно добавлен', 'data'=> $region]);
	}


    public function update(Region $region, array $validated) : JsonResponse
	{

		$region->update($validated);

		return response()->json(['message' => 'Регион успешно обновлен', 'data' => $region]);

	}

    public function delete(Region $region)
	{
		$region->delete();
		return response()->json(['message' => 'Регион успешно удален']);
	}

}
