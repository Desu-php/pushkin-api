<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateApplicationStatusRequest;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\ApplicationStatusService;

class ApplicationStatusController extends Controller
{
    public function __construct(ApplicationStatusService $applicationStatusService)
    {
        $this->applicationStatusService = $applicationStatusService;

        $this->middleware('jwt.auth');
    }

    public function getAll(): JsonResponse
    {
        return $this->applicationStatusService->getAll();
    }

    public function store(CreateApplicationStatusRequest $request): JsonResponse
    {
        return $this->applicationStatusService->store($request->validated());
    }

    public function update(ApplicationStatus $status, CreateApplicationStatusRequest $request): JsonResponse
    {
        return $this->applicationStatusService->update($status, $request->validated());
    }

    public function destroy(ApplicationStatus $status): JsonResponse
    {
        return $this->applicationStatusService->delete($status);
    }
}
