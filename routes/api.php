<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentApi;
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


Route::group(['prefix' => 'apartments'], function () {

    // Filter
    //how to use? /api/apartments/filter?rooms=2
    Route::get('/filter', [ApartmentApi::class, 'filter']);

    // Read
    Route::get('/', [ApartmentApi::class, 'index']);

    // Create
    Route::post('/', [ApartmentApi::class, 'store']);

    // Update
    Route::put('/{id}', [ApartmentApi::class, 'update']);

    // Delete
    Route::delete('/{id}', [ApartmentApi::class, 'destroy']);

    // Show
    Route::get('/{id}', [ApartmentApi::class, 'show']);

    
});


