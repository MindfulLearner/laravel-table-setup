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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'apartments'], function () {

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