<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users',UserController::class);
    Route::get('logout',[AuthController::class,'logout']);
});

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
