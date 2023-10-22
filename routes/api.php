<?php

use App\Http\Controllers\FipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/fipe')->name('fipe')->group(function(){
    Route::get('/brands/{type}', [FipeController::class, 'getBrands'])->whereIn('type', ['carros', 'motos', 'caminhoes']);
    Route::get('/models/{type}/{brand_id}', [FipeController::class, 'getModels'])->whereIn('type', ['carros', 'motos', 'caminhoes'])->whereNumber('brand_id');
    Route::get('/models/{type}/{brand_id}/{model_id}', [FipeController::class, 'getVehicleYears'])->whereIn('type', ['carros', 'motos', 'caminhoes'])->whereNumber('brand_id')->whereNumber('model_id');
});