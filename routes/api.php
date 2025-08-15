<?php

use App\Http\Controllers\Api\Public\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Routes de test
Route::prefix('test')->group(function () {
    Route::get('/hello', [TestController::class, 'helloWorld']);
    Route::post('/echo', [TestController::class, 'echoText']);
    Route::get('/echo/{text}', [TestController::class, 'echoUrl']);
});
