<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\IdentityVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\IdentityVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegisteredHostController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\VerifyIdentityController;
use App\Http\Controllers\Auth\VerifyPhoneController;


use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

        // Route for verifying identity
        // Route::post('/verify-identity', [VerifyIdentityController::class, '__invoke'])
        //     ->name('verification.verify');

        // Route for showing identity document
        // Route::get('/identity-documents/{filename}', [VerifyIdentityController::class, 'showIdentityDocument'])
        //     ->name('identity-document.show');

        // Route for sending verification for identity
        // Route::post('/verification/send', [VerifyIdentityController::class, 'sendVerification'])
        //     ->name('verification.send-identity');

        // Route for verifying identity
        // Route::post('/identity/verify', [VerifyIdentityController::class, 'verifyIdentity'])
        //     ->name('identity.verify');


        // Phone verification :
        // Route::post('/verify-phone', [VerifyPhoneController::class, 'verifyPhone'])->name('verify-phone');




    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    // Creating a Host Account for the 1st time : 
    Route::get('/become-host', [RegisteredHostController::class, 'render']);
    
    Route::post('/become-host', [RegisteredHostController::class, 'create'])
        ->name('become.host');

    
});
