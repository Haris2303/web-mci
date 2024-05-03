<?php

namespace App\Services\Impl;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserServiceImpl implements UserService
{
    public function login(LoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        // check password
        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "username or password wrong"
                    ]
                ]
            ], 401));
        }

        $user->remember_token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }

    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();

        // check email
        if (User::where('email', $data['email'])->count() === 1) {
            throw new HttpResponseException(response([
                "errors" => [
                    "username" => [
                        "username already registered"
                    ]
                ]
            ], 400));
        }

        $user = new User($data);

        DB::transaction(function () use ($data, $user) {
            $user->password = Hash::make($data['password']);
            $user->is_active = true;
            $user->save();

            $user->roles()->attach($data['role_id']);
        });


        return new UserResource($user);
    }

    public function get(): UserResource
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request): UserResource
    {
        $data = $request->validated();

        $user = Auth::user();
        $user = User::where('email', $user->email)->firstOrFail();

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return new UserResource($user);
    }

    public function logout(): bool
    {
        $user = Auth::user();
        $user = User::where('email', $user->email)->firstOrFail();

        $user->remember_token = null;
        $user->save();

        return true;
    }

    public function delete(int $id): bool
    {
        $user = User::where('id', $id)->first();

        DB::transaction(function () use ($user) {
            $user->roles()->detach($user->roles[0]->id);
            $user->delete();
        });

        return true;
    }
}
