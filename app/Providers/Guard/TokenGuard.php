<?php

namespace App\Providers\Guard;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenGuard implements Guard
{
    use GuardHelpers;

    private Request $request;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function user()
    {
        // check if user is not null
        if ($this->user != null) {
            return $this->user;
        }

        // check token user is valid
        $token = $this->request->header('Authorization');
        if ($token) {
            $this->user = $this->provider->retrieveByCredentials(['remember_token' => $token]);
        }

        if ($this->user == null) {
            return abort(401);
        }

        return $this->user;
    }

    public function validate(array $credentials = [])
    {
        return $this->provider->validateCredentials($this->user, $credentials);
    }
}
