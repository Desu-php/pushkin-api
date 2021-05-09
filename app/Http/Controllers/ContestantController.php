<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContestantRequest;
use App\Models\Contestant;
use App\Services\ContestantService;
use Illuminate\Http\JsonResponse;

class ContestantController extends Controller
{
    public function __construct(ContestantService $contestantService)
    {
        $this->contestantService = $contestantService;

        $this->middleware('jwt.auth');
    }

    public function index(): JsonResponse
    {
        return $this->contestantService->pagination();
    }

    public function getAll(): JsonResponse
    {
        return $this->contestantService->getAll();
    }

    public function store(CreateContestantRequest $request): JsonResponse
    {
        return $this->contestantService->store($request->validated());
    }

    public function update(Contestant $contestant, CreateContestantRequest $request): JsonResponse
    {
        return $this->contestantService->update($contestant, $request->validated());
    }

    public function destroy(Contestant $contestant): JsonResponse
    {
        return $this->contestantService->delete($contestant);
    }
}
