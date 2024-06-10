<?php

use App\Http\Controllers\TestController;
use App\Http\Middleware\Cors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/users/{id}', 'UserController@show');

Route::get('/api/tests', [TestController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/users/{email}', [UserController::class, 'showByEmail']);

Route::put('/users/{email}/update-balance', [UserController::class, 'updateBalance']);

Route::put('/users/{email}/subtract-balance', [UserController::class, 'subtractBalance']);

Route::delete('/users/delete/{email}', [UserController::class, 'deleteUserByEmail']);

