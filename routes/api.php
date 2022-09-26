<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::resource('/survey', SurveyController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/survey-by-slug/{survey:slug}', [SurveyController::class, 'show']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::post('/survey/{survey}/answer', [SurveyController::class, 'storeAnswer']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);