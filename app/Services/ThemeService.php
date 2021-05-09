<?php


namespace App\Services;

use App\Models\Theme;
use Illuminate\Http\JsonResponse;

class ThemeService
{
    public function __construct()
    {
        $this->theme = new Theme();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(Theme::all());
    }

    public function store(array $validated): JsonResponse
    {
        $theme = new Theme($validated);
        $theme->save();

        return response()->json(['message' => 'Тема конкурса успешно добавлена', 'data' => $theme]);
    }


    public function update(Theme $theme, array $validated): JsonResponse
    {

        $theme->update($validated);

        return response()->json(['message' => 'Тема конкурса успешно обновлена', 'data' => $theme]);
    }

    public function delete(Theme $theme)
    {
        $theme->delete();
        return response()->json(['message' => 'Тема конкурса успешно удалена']);
    }
}
