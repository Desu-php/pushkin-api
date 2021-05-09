<?php


namespace App\Services;

use App\Models\EducationalInstitution;
use Illuminate\Http\JsonResponse;

class EducationalInstitutionService
{
    public function __construct()
    {
        $this->educationalInstitution = new EducationalInstitution();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(EducationalInstitution::all());
    }

    public function store(array $validated): JsonResponse
    {
        $educationalInstitution = new EducationalInstitution($validated);
        $educationalInstitution->save();

        return response()->json(['message' => 'Учебное заведение успешно добавлено', 'data' => $educationalInstitution]);
    }


    public function update(EducationalInstitution $educationalInstitution, array $validated): JsonResponse
    {

        $educationalInstitution->update($validated);

        return response()->json(['message' => 'Учебное заведение успешно обновлено', 'data' => $educationalInstitution]);
    }

    public function delete(EducationalInstitution $educationalInstitution)
    {
        $educationalInstitution->delete();
        return response()->json(['message' => 'Учебное заведение успешно удалено']);
    }
}
