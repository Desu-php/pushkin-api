<?php


namespace App\Services;

use App\Http\Requests\CreateAgeGroupRequest;
use App\Models\AgeGroup;
use App\Models\Contest;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;

class ContestService
{
    public function __construct()
    {
        $this->contest = new Contest();
    }

    public function pagination(): JsonResponse
    {
        return response()->json(Contest::all()->paginate());
    }

    public function getAll(): JsonResponse
    {
        return response()->json(Contest::all());
    }

    public function store(array $validated): JsonResponse
    {
        $contest = new Contest($validated);
        $contest->save();

        return response()->json(['message' => 'Конкурс успешно добавлен', 'data' => $contest]);
    }


    public function update(Contest $contest, array $validated): JsonResponse
    {

        $contest->update($validated);

        return response()->json(['message' => 'Конкурс успешно обновлен', 'data' => $contest]);
    }

    public function delete(Contest $contest)
    {
        $contest->delete();
        return response()->json(['message' => 'Конкурс успешно удален']);
    }

    public function getAllThemes(): JsonResponse
    {
        return response()->json(Theme::all());
    }

    public function getAllAgeGroups(): JsonResponse
    {
        return response()->json(AgeGroup::all());
    }


    public function getAgeGroups(Contest $contest): JsonResponse
    {
        return response()->json(AgeGroup::where('contest_id', '=', $contest->id)->get());
    }

    public function setAgeGroups(Contest $contest, array $validated): JsonResponse
    {

        $ageGroup = new AgeGroup($validated);
        $ageGroup->contest_id = $contest->id;
        $ageGroup->save();
        return response()->json(['message' => 'Группа успешно добавлена', 'data' => $ageGroup]);
    }

    public function editAgeGroups(AgeGroup $ageGroup, array $validated)
    {
        $ageGroup->update($validated);
        return response()->json(['message' => 'Группа успешно обновлена', 'data' => $ageGroup]);
    }

    public function getThemes(AgeGroup $ageGroup): JsonResponse
    {
        return response()->json(Theme::where('age_group_id', '=', $ageGroup->id)->get());
    }

    public function setThemes(AgeGroup $ageGroup, array $validated): JsonResponse
    {
        $theme = new Theme($validated);
        $theme->age_group_id = $ageGroup->id;
        $theme->save();
        return response()->json(['message' => 'Тема успешно добавлена', 'data' => $theme]);
    }

    public function editThemes(Theme $theme, array $validated)
    {
        $theme->update($validated);
        return response()->json(['message' => 'Тема успешно обновлена', 'data' => $theme]);
    }

    public function removeAgeGroups(AgeGroup $ageGroup)
    {
        $ageGroup->delete();
        return response()->json(['message' => 'Группа успешно удалена']);
    }
    public function removeThemes(Theme $theme)
    {
        $theme->delete();
        return response()->json(['message' => 'Тема успешно удалена']);
    }
}
