<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApartmentApi;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Api\ReceiverController as EmailReceiverController;
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


//upload
Route::post('/upload', [ImageUploadController::class, '__invoke'])->name('apartments.upload');
//delete
Route::delete('/delete/{image_string}', [ImageUploadController::class, 'destroy'])->name('apartments.destroy');


//emailreceiver
Route::post('/emailreceiver', [EmailReceiverController::class, '__invoke'])->name('emailreceiver');



// Read
Route::get('/apartments', [ApartmentApi::class, 'index']);

// Create
Route::post('/apartments', [ApartmentApi::class, 'store']);

// Update
Route::put('/apartments/{id}', [ApartmentApi::class, 'update']);

// Delete
Route::delete('/apartments/{id}', [ApartmentApi::class, 'destroy']);

// Show
Route::get('/apartments/{id}', [ApartmentApi::class, 'show']);

