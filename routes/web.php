<?php

use App\Http\Controllers\CarSimulationController;
use Illuminate\Support\Facades\Route;


Route::get('/simulate', [CarSimulationController::class, 'simulate']);
Route::get('/simulate-csv', [CarSimulationController::class, 'simulateFromCSV']);

