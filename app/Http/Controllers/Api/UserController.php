<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->userService->register($request);

        return response()->json([
            'data' => $response
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->userService->login($request);

        return response()->json([
            'data' => $response
        ], 200);
    }

    public function get(): UserResource
    {
        return  $this->userService->get();
    }

    public function update(UserUpdateRequest $request): UserResource
    {
        return $this->userService->update($request);
    }

    public function logout(): JsonResponse
    {
        $response = $this->userService->logout();
        return response()->json([
            'data' => $response
        ]);
    }
}
