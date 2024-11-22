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


// Read
Route::get('/apartments', [ApartmentApi::class, 'index']);

// Create
Route::post('/apartments', [ApartmentApi::class, 'store']);

// Update
Route::put('/apartments/{id}', [ApartmentApi::class, 'update']);

// Delete
Route::delete('/apartments/{id}', [ApartmentApi::class, 'destroy']);

//show
Route::get('/apartments/{id}', [ApartmentApi::class, 'show']);