<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/explore', [LandingController::class, 'explore'])->name('explore');
Route::get('/category/{category:slug}', [LandingController::class, 'category'])->name('category.show');
Route::get('/worker/{user}', [WorkerController::class, 'show'])->name('worker.profile');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('services', ServiceController::class)->except(['show']);
    
    Route::resource('requests', RequestController::class)
        ->parameters(['requests' => 'serviceRequest'])
        ->except(['edit', 'update', 'destroy']);
    Route::patch('/requests/{serviceRequest}/status', [RequestController::class, 'updateStatus'])->name('requests.status');
    
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

require __DIR__.'/auth.php';