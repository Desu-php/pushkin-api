<?php


namespace App\Services;

use App\Models\Contestant;
use Illuminate\Http\JsonResponse;

class ContestantService
{
    public function __construct()
    {
        $this->contestant = new Contestant();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(Contestant::all());
    }

    public function store(array $validated): JsonResponse
    {
        $contestant = new Contestant($validated);
        $contestant->save();

        return response()->json(['message' => 'Участник успешно добавлен', 'data' => $contestant]);
    }


    public function update(Contestant $contestant, array $validated): JsonResponse
    {

        $contestant->update($validated);

        return response()->json(['message' => 'Участник успешно обновлен', 'data' => $contestant]);
    }

    public function delete(Contestant $contestant)
    {
        $contestant->delete();
        return response()->json(['message' => 'Участник успешно удален']);
    }
}
