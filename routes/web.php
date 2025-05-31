<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth'])->group(function () {
    // Dashboard with sales chart & top services widget
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // API route for sales data for chart.js
    Route::get('/sales-last-6-months', [DashboardController::class, 'salesLast6Months'])->name('sales.last6months');

    // Order list page with filters

    // Export filtered orders as CSV
    Route::get('/orders/export', [OrderController::class, 'exportOrders'])->name('orders.export');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
 Route::get('/orders', [OrderController::class, 'index'])->name('orders.list');


});



require __DIR__ . '/auth.php';
