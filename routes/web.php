<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Client\ClientDashboardController;

// HOME
Route::view('/', 'welcome')->name('home');

// AUTH routes (Breeze/Jetstream)
require __DIR__.'/auth.php';

// DASHBOARD dispatcher (redirige selon rôle)
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// PROFILE (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ton store custom (profil prestataire)
    Route::post('/profile/store', [ProfileController::class, 'store'])->name('profile.store');
});

// PROVIDER DASHBOARD
Route::middleware(['auth', 'verified'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');

    Route::get('/virtual/setup', fn () => view('provider.virtual-job'))->name('virtual.job');
    Route::get('/physical/setup', fn () => view('provider.physical-job'))->name('physical.job');
});

// CLIENT DASHBOARD
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
});

// MISSIONS
Route::middleware(['auth'])->group(function () {
    Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
    Route::get('/missions/create', [MissionController::class, 'create'])->name('missions.create');
    Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');

    // postuler
    Route::post('/missions/{mission}/apply', [ApplicationController::class, 'store'])->name('missions.apply');

    // client voit candidatures
    Route::get('/missions/{mission}/applications', [ApplicationController::class, 'index'])->name('missions.applications');

    // client accepte
    Route::post('/missions/{mission}/applications/{application}/accept', [ApplicationController::class, 'accept'])
        ->name('missions.applications.accept');

    // assigner
    Route::post('/missions/{mission}/assign', [MissionController::class, 'assign'])->name('missions.assign');
});
