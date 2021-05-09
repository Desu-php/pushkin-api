<?php


namespace App\Services;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct()
    {
        $this->user = new User();
    }


    public function getAll(): JsonResponse
    {
        return response()->json(User::all());
    }

    public function store(array $validated): JsonResponse
    {
        $user = new User($validated);
        $user->password = Hash::make($validated['password']);
        $user->save();

        return response()->json(['message' => 'Пользователь успешно добавлен', 'data' => $user]);
    }


    public function update(User $user, array $validated): JsonResponse
    {
        if ($user->id != 1) {
            $user->update($validated);
        }

        return response()->json(['message' => 'Пользователь успешно обновлен', 'data' => $user]);
    }

    public function delete(User $user)
    {
        if ($user->id != 1) {
            Application::where('user_id', '=', $user->id)->update(['user_id' => 1]);
            $user->delete();
        }

        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}
