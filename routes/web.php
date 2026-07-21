<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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
Route::middleware('auth')->group(function () {
    Route::resource('reservations', ReservationController::class)->except(['show']);

});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('tables', TableController::class);
    Route::resource('menus', MenuController::class);

    Route::get('/reservations', [AdminReservationController::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/confirm', [AdminReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::patch('/reservations/{reservation}/reject', [AdminReservationController::class, 'reject'])->name('reservations.reject');
    Route::patch('/reservations/{reservation}/complete', [AdminReservationController::class, 'complete'])->name('reservations.complete');
});

require __DIR__.'/auth.php';