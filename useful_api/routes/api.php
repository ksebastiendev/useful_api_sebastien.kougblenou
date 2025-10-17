<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('modules', ModuleController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('/modules', [ModuleController::class, 'index']);
Route::post('/modules/{id}/activate',   [ModuleController::class, 'activate']);
Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);

Route::middleware('module.active:1')->get('/shortener/links', fn() => response()->json(['ok' => true]));
Route::middleware('module.active:2')->get('/wallet/balance',  fn() => response()->json(['ok' => true]));
Route::middleware('module.active:3')->get('/market/products', fn() => response()->json(['ok' => true]));
Route::middleware('module.active:4')->get('/time/sessions',   fn() => response()->json(['ok' => true]));
Route::middleware('module.active:5')->get('/invest/portfolio', fn() => response()->json(['ok' => true]));
