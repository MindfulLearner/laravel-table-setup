<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\UserContentController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SponsorController;

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
    return view('welcome');
});



Route::get('/dashboard', [ApartmentController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('apartments', ApartmentController::class)->middleware(['auth', 'verified']);

    Route::resource('user', UserContentController::class)->middleware(['auth', 'verified']);

    Route::delete('images/{id}', [ImageUploadController::class, 'destroyImage'])->name('image.destroyImage');

    Route::get('/sponsor', function () {
        return view('sponsor');
    });

    Route::get('/sponsor/bronze', [SponsorController::class, 'createBronze'])->name('sponsors.createBronze');
    Route::get('/sponsor/silver', [SponsorController::class, 'createSilver'])->name('sponsors.createSilver');
    Route::get('/sponsor/gold', [SponsorController::class, 'createGold'])->name('sponsors.createGold');


});

require __DIR__.'/auth.php';
