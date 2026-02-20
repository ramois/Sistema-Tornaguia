<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\DriverController;

Route::get('/vehicles/{placa}', [VehicleController::class, 'show']);
Route::get('/drivers/{licencia}', [DriverController::class, 'show']);
