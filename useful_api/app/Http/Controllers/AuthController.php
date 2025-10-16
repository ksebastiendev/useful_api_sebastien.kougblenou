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
            'name' => 'required|string',
            'email' => 'email|unique:users',
            'password' => 'string|min:8'
        ]);
        $user = User::create($fields);
        return $user;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|exists:users',
            'password' => 'string|min:8'
        ]);
        $user = User::where('email', $request->email)->first();
        // $token = $user->createToken($request->email);

        // return [
        //     'user'=> $user,
        //     'token' => $token->plainTextToken,

        // ];

         if(!$user || !Hash::check($request->password, $user->password) ){
            return[ 'message' => '401'];
         }
          $token = $user->createToken($request->email);
          return [
            'user'=> $user,
            'token'=> $token->plainTextToken
          ];

    }
}
