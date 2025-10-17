<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:user,email', 'max:255'],
            'password' => ['required', 'Password::min(8)']
        ]);
        $user = User::create($fields);
        return response()->json([
            'id' => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'created_at' => $user->created_at->toISOString(),

        ], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = User::where('email', $request->email)->first();
        // $token = $user->createToken($request->email);

        // return [
        //     'user'=> $user,
        //     'token' => $token->plainTextToken,

        // ];

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'invalid credentials'], 401);
        }
        $token = $user->createToken($request->email);
        return response()->json([
            'token' => $token->plainTextToken,
            'user_id' => $user->id,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json( ['message' => 'You are loged out'],200);
    }
}
