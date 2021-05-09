<?php


namespace App\Services;

use App\Models\Teacher;
use Illuminate\Http\JsonResponse;

class TeacherService
{
	public function __construct()
	{
		$this->teacher = new Teacher();
	}


    public function getAll() : JsonResponse
	{
		return response()->json(Teacher::all());
	}

    public function store(array $validated) : JsonResponse
	{
		$teacher = new Teacher($validated);
		$teacher->save();

		return response()->json(['message' => 'Педагог успешно добавлен', 'data'=> $teacher]);
	}


    public function update(Teacher $teacher, array $validated) : JsonResponse
	{

		$teacher->update($validated);

		return response()->json(['message' => 'Педагог успешно обновлен', 'data' => $teacher]);

	}

    public function delete(Teacher $teacher)
	{
		$teacher->delete();
		return response()->json(['message' => 'Педагог успешно удален']);
	}

}
