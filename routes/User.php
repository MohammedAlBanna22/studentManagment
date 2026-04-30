<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CacheDemoController;
use App\Http\Controllers\EmailsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionDemoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

route::get('users',[UserController::class,"index"]);
Auth::routes(['verify'=>true]);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Show verification notice page
Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

// Handle the verification link click
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

// Resend verification email
Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

route::get('/session',action: [SessionDemoController::class,'index']);

route::get('/demochace',action: [CacheDemoController::class,'index']);

route::get('send-mail',action: [EmailsController::class,'WelcomeEmail']);
