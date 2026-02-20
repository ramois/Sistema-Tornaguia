<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TornaguiaController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use App\Models\Tornaguia;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $counts = [
        'tornaguias' => Tornaguia::count(),
        'vehicles' => Vehicle::count(),
        'drivers' => Driver::count(),
        'users' => $user && $user->role === 'admin' ? User::count() : null,
    ];
    return view('dashboard', compact('counts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,operador'])->group(function () {
    Route::get('tornaguias/{tornaguia}/print', [TornaguiaController::class, 'print'])->name('tornaguias.print');
    Route::resource('tornaguias', TornaguiaController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('drivers', DriverController::class);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
