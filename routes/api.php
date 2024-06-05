<?php

use App\Http\Controllers\TestController;
use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/{id}', 'UserController@show');

Route::get('/api/tests', [TestController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
