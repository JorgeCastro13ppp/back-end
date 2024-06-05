<?php

use App\Http\Controllers\TestController;
use App\Http\Middleware\Cors;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tests', [TestController::class, 'index'])->middleware(Cors::class);


