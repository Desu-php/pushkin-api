<?php


namespace App\Services;

use App\Models\ApplicationStatus;
use Illuminate\Http\JsonResponse;

class ApplicationStatusService
{
    public function __construct()
    {
        $this->applicationStatus = new ApplicationStatus();
    }

    public function getAll(): JsonResponse
    {
        return response()->json(ApplicationStatus::all());
    }

    public function store(array $validated): JsonResponse
    {
        $applicationStatus = new ApplicationStatus($validated);
        $applicationStatus->save();

        return response()->json(['message' => 'Статус успешно добавлен', 'data' => $applicationStatus]);
    }


    public function update(ApplicationStatus $applicationStatus, array $validated): JsonResponse
    {

        $applicationStatus->update($validated);

        return response()->json(['message' => 'Статус успешно обновлен', 'data' => $applicationStatus]);
    }

    public function delete(ApplicationStatus $applicationStatus)
    {
        $applicationStatus->delete();
        return response()->json(['message' => 'Статус успешно удален']);
    }
}
