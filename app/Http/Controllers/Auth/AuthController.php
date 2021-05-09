<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;


        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @OA\Post(
     ** path="/api/v1/auth/login",
     *   tags={"Login"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    /**
     * Get a JWT via given credentials.
     *
     * @param UserLoginRequest $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        return $this->authService->login($request->validated());
    }

    /**
     * Get the authenticated User.
     */
    public function me(): JsonResponse
    {
        if (!auth()->user()) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return $this->authService->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     */
    public function guard(): StatefulGuard
    {
        return Auth::guard('api');
    }
}
