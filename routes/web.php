<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TravelerDashboardController;
use App\Http\Controllers\HostDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\VerifyPhoneController;
use App\Http\Controllers\MessageController;


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

// Home page
Route::get('/', [OfferController::class, 'index'])->name('home');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Public profile
    Route::get('/public-profile/{id}', [ProfileController::class, 'showPublicProfile'])->name('public-profile.show');
    Route::get('/public-profile/edit', [ProfileController::class, 'publicProfileEditForm'])
    ->name('public-profile.edit');

    // Update public profile edits
    Route::post('/public-profile/update', [ProfileController::class, 'updatePublicProfile'])
    ->name('public-profile.update');


    // Identity verification
    Route::patch('/verify-identity', [ProfileController::class, 'verifyIdentity'])->name('verify-identity');
    Route::delete('/delete-identity-document', [ProfileController::class, 'deleteIdentityDocument'])->name('delete-identity-document');

    // Phone verification
    Route::patch('/verify-phone', [VerifyPhoneController::class, 'verifyPhone'])->name('verify-phone');

});

// Offers 
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::middleware('host')->group(function () {
    Route::get('/offers/create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('/offers', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/offers/{offer}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/offers/{offer}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy'])->name('offers.destroy');
});

// Search and filter offers
Route::get('/search', [OfferController::class, 'search'])->name('offers.search');


// Selected offer details
Route::get('/offers/{offerId}', [OfferController::class, 'detail'])->name('offers.detail');


// Reservations 
Route::middleware('auth')->group(function () {
    Route::get('/reservations/create/{offerId}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/store/{offerId}', [ReservationController::class, 'store'])->name('reservations.store');
    Route::patch('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
});

// Traveler Dashboard 
Route::middleware('auth')->group(function () {
    Route::get('/traveler-dashboard', [TravelerDashboardController::class, 'index'])->name('traveler.dashboard');
    Route::get('/checkout/form/{reservationId}', [TravelerDashboardController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/reservation/confirm/{reservationId}', [TravelerDashboardController::class, 'confirmPayStay'])->name('reservation.confirm');
    Route::view('/thankyou', 'reservations.thank-you')->name('traveler.thankyou');
    Route::get('/traveler/confirmed-stays', [TravelerDashboardController::class, 'confirmedStays'])
        ->name('traveler.confirmed-stays');
    Route::get('/traveler/past-stays', [TravelerDashboardController::class, 'pastStays'])
        ->name('traveler.past-stays');
    Route::get('/traveler/reservations-requests', [TravelerDashboardController::class, 'reservationsRequests'])
        ->name('traveler.reservations-requests');
});


// Host Dashboard
Route::middleware(['auth', 'host'])->group(function () {
    Route::get('/host-dashboard', [HostDashboardController::class, 'index'])->name('host.dashboard');
    Route::get('/host-reservations', [HostDashboardController::class, 'allReservations'])
        ->name('host.reservations.all');
    Route::get('/reservations/pending', [HostDashboardController::class, 'pendingReservations'])->name('host.reservations.pending');
    Route::post('/reservations/accept/{reservationId}', [HostDashboardController::class, 'acceptReservation'])->name('host.reservations.accept');
    Route::post('/reservations/decline/{reservationId}', [HostDashboardController::class, 'declineReservation'])->name('host.reservations.decline');
    Route::get('/reservations/ongoing-accepted', [HostDashboardController::class, 'ongoingAcceptedReservations'])->name('host.ongoing.accepted.reservations');
    Route::get('/reservations/future-accepted', [HostDashboardController::class, 'futureAcceptedReservations'])->name('host.future.accepted.stays');
    Route::get('/reservations/history', [HostDashboardController::class, 'reservationsHistory'])->name('host.reservations.history');
});

// Admin Dashboard 
Route::get('/admin/verify-identity/{userId}', [AdminDashboardController::class, 'showVerifyIdentityForm'])
    ->name('admin.verify-identity.form');
Route::post('/admin/verify-identity/{userId}', [AdminDashboardController::class, 'verifyIdentity'])
    ->name('admin.verify-identity.verify');


// Messaging system : 
Route::post('/messages/store', [MessageController::class, 'storeMessage'])->name('messages.store');
Route::get('/messages', [MessageController::class, 'getMessages'])->name('messages.get');
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/{receiver_id}', [MessageController::class, 'getUserMessages'])->name('messages.user');
Route::get('/messages/long-polling', [MessageController::class, 'longPollMessages']);
Route::get('/users', [MessageController::class, 'getUsers'])->name('users.get');




require __DIR__.'/auth.php';
