<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('modules', ModuleController::class);

Route::post('/register', [AuthController::class ,'register'] );

Route::post('/login', [AuthController::class ,'login'] );

Route::post('/logout', [AuthController::class ,'logout'] )->middleware('auth:sanctum');


// Route::get('/modules', [ModuleController::class ,'modules'] );
// Route::post('/modules/{id}/activate', [ModuleController::class ,'active'] );
// Route::post('/modules/{id}/deactivate', [ModuleController::class ,'deactive'] );



