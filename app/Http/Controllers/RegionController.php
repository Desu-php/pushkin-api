<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRegionRequest;
use App\Models\Region;
use App\Services\RegionService;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    public function __construct(RegionService $regionService)
    {
        $this->regionService = $regionService;

        $this->middleware('jwt.auth', ['except' => 'getAll']);
    }

    public function index(): JsonResponse
    {
        return $this->regionService->pagination();
    }
    public function getAll(): JsonResponse
    {
        return $this->regionService->getAll();
    }

    public function store(CreateRegionRequest $request): JsonResponse
    {
        return $this->regionService->store($request->validated());
    }

    public function update(Region $region, CreateRegionRequest $request): JsonResponse
    {
        return $this->regionService->update($region, $request->validated());
    }

    public function destroy(Region $region): JsonResponse
    {
        return $this->regionService->delete($region);
    }
}
