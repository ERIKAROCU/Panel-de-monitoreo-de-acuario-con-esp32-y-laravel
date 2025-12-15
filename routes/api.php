<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LecturaController; 
use App\Http\Controllers\AcuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lectura', [LecturaController::class, 'store']);

Route::post('/log-sensors', [AcuarioController::class, 'storeSensorLog']);