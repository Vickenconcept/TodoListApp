<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request): RedirectResponse
    {
        log('helo we arevhere');
       User::create($request->validated());

       return to_route('login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $request->wantsJson() ? Response::api('Invalid Credentials', Response::HTTP_BAD_REQUEST) :
             back()->with('error', 'Invalid Credentials');
        }

        
        $userData = $this->createAccessToken();

        return $request->wantsJson() ? $userData : to_route('/');
    }

    private function createAccessToken() : User
    {
        $user = user();
        $user->token = $user->createToken($user->email)->plainTextToken;

        session()->put('access_token', $user->token);

        return $user;
    }

    public function destroy(Request $request)
    {
        user()->tokens()->delete();
        Auth::logout();
        
        return to_route('login');
    }
}
