<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\UserContentController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PaymentController;

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

    Route::get('/sponsor', function () {
        return view('sponsor');
    })->name('sponsor');
    // sponsor routes
    Route::get('/sponsor/bronze', [SponsorController::class, 'createBronze'])->name('bronze');
    Route::post('/sponsor/bronze', [SponsorController::class, 'updateSponsorBronze'])->name('updateSponsorBronze');
    Route::get('/sponsor/silver', [SponsorController::class, 'createSilver'])->name('silver');
    Route::post('/sponsor/silver', [SponsorController::class, 'updateSponsorSilver'])->name('updateSponsorSilver');
    Route::get('/sponsor/gold', [SponsorController::class, 'createGold'])->name('gold');
    Route::post('/sponsor/gold', [SponsorController::class, 'updateSponsorGold'])->name('updateSponsorGold');

    Route::get('/payment/token', [PaymentController::class, 'token']);
    Route::post('/payment/checkout', [PaymentController::class, 'checkout']);

    Route::post('/sponsors/payment', [SponsorController::class, 'showPaymentPage'])->name('payment');

});

require __DIR__.'/auth.php';
