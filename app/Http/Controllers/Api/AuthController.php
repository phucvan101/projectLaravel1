<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\UserAddRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    use HttpResponses;
    public function login(LoginUser $request)
    {
        $data = $request->validated();
        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = User::where('email', $data['email'])->first();
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], 'User logged in successfully', 200);
    }

    public function register(UserAddRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->name)->plainTextToken
        ], 'User registered successfully', 201);
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            $user->currentAccessToken()->delete();
            return $this->success([], 'User logged out successfully', 200);
        }
        return $this->error([], 'User not found', 404);
    }
}
