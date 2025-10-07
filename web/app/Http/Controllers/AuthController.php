<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            return to_route('home')
                ->with('message', __('Welcome back!'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function completeRegistration(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return to_route('home')
            ->with('message', __('Account created successfully!'));
    }

    public function logout()
    {
        auth()->logout();

        return to_route('home')
            ->with('message', __('You have been logged out.'));
    }
}
