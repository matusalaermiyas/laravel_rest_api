<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);


        if (!$token = auth()->attempt($credentials)) return response()->json(['error' => 'Invalid username or password'], 401);


        auth()->user()->tokens()->delete();


        $token =  Auth()->user()->createToken('token');

        return ['token' => $token->plainTextToken];
    }

    public function register(Request $request)
    {

        $request->validate([
            'email' => "bail|required|email",
            'name' => 'bail|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request['email'])->first();


        if ($user) return response(['message' => 'Email already taken'], 400);


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        return $user;
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'Logged out successfully'];
    }
}
