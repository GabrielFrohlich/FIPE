<?php

use App\Http\Controllers\FipeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::prefix('/fipe')->name('fipe.')->group(function(){
    Route::get('/{type}/{brand_id}', [FipeController::class, 'getModels'])->whereIn('type', ['carros', 'motos', 'caminhoes'])->whereNumber('brand')->name('models');
    Route::get('/{type}/{brand_id}/{model_id}', [FipeController::class, 'getVehicleYears'])->whereIn('type', ['carros', 'motos', 'caminhoes'])->whereNumber('brand')->whereNumber('model')->name('years');
    Route::get('/{type}/{brand_id}/{model_id}/{year}', [FipeController::class, 'viewVehicle'])
->whereIn('type', ['carros', 'motos', 'caminhoes'])->whereNumber('brand')->whereNumber('model')->name('vehicle');
});


