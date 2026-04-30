<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



  Route::middleware('auth')
  ->prefix('payment')
  ->controller(PaymentController::class)
  ->name('payment.')
  ->group(function () {
    Route::get('/pay','showPaymentForm')->name('form');
    Route::post('/intent','createPaymentIntent')->name('intent');
    Route::post('/success','paymentSuccess')->name('success');
     Route::get('/','allPayment')->name('index')->middleware('role:admin');
    });