<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        $this->middleware('jwt.auth');
        $this->middleware('admin');
    }

    public function getAll(): JsonResponse
    {
        return $this->userService->getAll();
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        return $this->userService->store($request->validated());
    }

    public function update(User $user, UpdateUserRequest $request): JsonResponse
    {
        return $this->userService->update($user, $request->validated());
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->userService->delete($user);
    }
}
