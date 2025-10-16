<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AuthController extends Controller
{
    public function register (Request $request){
       $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'email|unique:users',
            'password'=>'string|min:8'
        ]);
        $user = User::create($fields);
        return $user;
    }
     public function login (Request $request){
        return 'login';
    }
}
