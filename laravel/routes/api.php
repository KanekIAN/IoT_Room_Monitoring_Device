<?php

use App\Http\Controllers\SensorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('datasensor', SensorController::class);
