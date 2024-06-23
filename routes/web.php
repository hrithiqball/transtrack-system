<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');

    Route::get('/admin', [ProfileController::class, 'admin'])->name('admin.index')->middleware(AdminMiddleware::class);
    Route::put('/admin/role/{id}', [ProfileController::class, 'update_role'])->name('admin.update-role')->middleware(AdminMiddleware::class);

    Route::get('/profile/{id}', [ProfileController::class, 'detail'])->name('profile.detail');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/list', [UserController::class, 'list'])->name('user.list');

    Route::get('/vehicle', [VehicleController::class, 'view'])->name('vehicle.view');
    Route::get('/vehicle/{id}', [VehicleController::class, 'detail'])->name('vehicle.detail');
    Route::get('/vehicle/{id}/edit', [VehicleController::class, 'edit'])->name('vehicle.edit');
    Route::post('/vehicle', [VehicleController::class, 'store'])->name('vehicle.store');
    Route::put('/vehicle/{id}', [VehicleController::class, 'update'])->name('vehicle.update');
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');

    Route::get('/booking', [BookingController::class, 'view'])->name('booking.view');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');

    Route::get('/maintenance', [MaintenanceController::class, 'view'])->name('maintenance.view');
    Route::get('/maintenance/{id}', [MaintenanceController::class, 'detail'])->name('maintenance.detail');
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');
    Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy');
});


require __DIR__ . '/auth.php';
