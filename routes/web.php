<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/favicon.ico', function () {
    return response()->file(public_path('favicon.ico'));
});

Route::get('/', [WelcomeController::class, 'show'])->name('welcome');
Route::get('/cart', [CartController::class, 'show']);
Route::get('/signup', [AccountController::class, 'signup']);

Route::prefix('products')->group(function () {
    Route::get('/{product_id}', [ProductController::class, 'getProduct'])->name('products.id');
});

Route::middleware('auth:sanctum')->get('/profile', [AccountController::class, 'profile']);

Route::middleware('auth:sanctum')->prefix('orders')->group(function () {
    Route::get('/', [CartController::class, 'orders']);
    Route::get('/{id_cart}', [CartController::class, 'getOrderById']);
});

Route::middleware(['auth:sanctum','admin'])
  ->prefix('admin')
  ->group(function () {
    Route::get('/peripherals', [ProductController::class, 'adminIndex'])
         ->name('admin.peripherals');

    Route::put('/peripherals/{id}', [ProductController::class, 'updateStock'])
         ->name('admin.peripherals.update');
  });