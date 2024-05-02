<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;

interface UserService
{
    function login(LoginRequest $request): UserResource;

    function register(RegisterRequest $request): UserResource;

    function get(): UserResource;

    function update(UserUpdateRequest $request): UserResource;

    function logout(): bool;
}
