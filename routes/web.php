<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInUpController;
use App\Http\Controllers\SubscriptionController;

// Home route
Route::get('/', function () {
        return view('welcome');
    })->name('index');

Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

// Registration routes
Route::get('/register', [SignInUpController::class, 'vendor_registration'])->name('register');
Route::post('/register', [SignInUpController::class, 'acc_registration'])->name('acc_registration');

// Subscription routes
Route::get('subscription_confirmation/{plan_id}', [SubscriptionController::class, 'subscribe_confirmatiom'])->name('subscription_confirmation');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

// Sign-in routes
Route::get('/sign_in', [SignInUpController::class, 'vendor_signin'])->name('sign_in');
Route::post('/sign_in', [SignInUpController::class, 'sign_in_acc'])->name('sign_in_acc');

// Subscription status routes
Route::get('/success', function () {
        return view('subscription.success');
    })->name('success_subscription');

Route::get('/cancel', function () {
        return view('subscription.cancel');
    })->name('cancel_subscription');

//Product Controller
Route::get('/product', [ProductController::class, 'index'])->name('product_index');
Route::post('/product', [ProductController::class, 'store_product'])->name('product_store');
Route::put('/product{product_id}', [ProductController::class, 'update_product'])->name('product_update');
Route::delete('/product{product_id}', [ProductController::class, 'delete_product'])->name('product_delete');

Route::get('/order', [OrderController::class, 'index'])->name('order_index');

Route::get('/transaction', [ReportingController::class, 'transaction_view'])->name('reporting_transaction');

// Testing route
Route::get('/testing', [SignInUpController::class, 'testing'])->name('testing');