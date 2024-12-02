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

Route::get('geocode', function (Request $request) {
    $apiKey = 'SooRbYbji9V5qUxAh3i2ijnD8m9ZWVZ7';
    $url = 'https://api.tomtom.com/search/2/geocode/' . urlencode($request->indirizzo) . '.json?key=' . $apiKey . '&limit=1&countrySet=IT&language=it-IT';

    $client = new \GuzzleHttp\Client();
    $response = $client->get($url);


    return response($response->getBody(), $response->getStatusCode())
        ->header('Content-Type', $response->getHeader('Content-Type')[0]);
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

