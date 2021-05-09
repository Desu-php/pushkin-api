<?php


namespace App\Services;

use App\Models\ApplicationDocument;
use Illuminate\Http\JsonResponse;

class ApplicationDocumentService
{
    public function __construct()
    {
        $this->applicationDocument = new ApplicationDocument();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(ApplicationDocument::all());
    }

    public function store(array $validated): JsonResponse
    {
        $applicationDocument = new ApplicationDocument($validated);
        $applicationDocument->save();

        return response()->json(['message' => 'Документ успешно добавлен', 'data' => $applicationDocument]);
    }


    public function update(ApplicationDocument $applicationDocument, array $validated): JsonResponse
    {

        $applicationDocument->update($validated);

        return response()->json(['message' => 'Документ успешно обновлен', 'data' => $applicationDocument]);
    }

    public function delete(ApplicationDocument $applicationDocument)
    {
        $applicationDocument->delete();
        return response()->json(['message' => 'Документ успешно удален']);
    }
}
