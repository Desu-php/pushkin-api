<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCityRequest;
use App\Models\City;
use App\Models\Region;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;

        $this->middleware('jwt.auth', ['except' => ['getAll', 'getByRegion']]);
    }

    public function index(): JsonResponse
    {
        return $this->cityService->pagination();
    }

    public function getByRegion(Region $region){
        return $this->cityService->getByRegion($region->id);
    }

    public function getAll(): JsonResponse
    {
        return $this->cityService->getAll();
    }

    public function store(CreateCityRequest $request): JsonResponse
    {
        return $this->cityService->store($request->validated());
    }

    public function update(City $city, CreateCityRequest $request): JsonResponse
    {
        return $this->cityService->update($city, $request->validated());
    }

    public function destroy(City $city): JsonResponse
    {
        return $this->cityService->delete($city);
    }
}
