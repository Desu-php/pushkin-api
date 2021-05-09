<?php


namespace App\Services;

use App\Models\AgeGroup;
use Illuminate\Http\JsonResponse;

class AgeGroupService
{
    public function __construct()
    {
        $this->ageGroup = new AgeGroup();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(AgeGroup::all());
    }

    public function store(array $validated): JsonResponse
    {
        $ageGroup = new AgeGroup($validated);
        $ageGroup->save();

        return response()->json(['message' => 'Возрастная группа успешно добавлена', 'data' => $ageGroup]);
    }


    public function update(AgeGroup $ageGroup, array $validated): JsonResponse
    {

        $ageGroup->update($validated);

        return response()->json(['message' => 'Возрастная группа успешно обновлена', 'data' => $ageGroup]);
    }

    public function delete(AgeGroup $ageGroup)
    {
        $ageGroup->delete();
        return response()->json(['message' => 'Возрастная группа успешно удалена']);
    }
}
