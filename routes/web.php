<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GearCategoryController;
use App\Http\Controllers\GearController;
use App\Http\Controllers\MountainController;
use App\Http\Controllers\MountainRecommendationController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', UserDashboardController::class)->name('dashboard');
    Route::get('/mountains', [MountainController::class, 'catalog'])->name('mountains.catalog');
    Route::get('/gear', [GearController::class, 'catalog'])->name('gear.catalog');
    Route::resource('rentals', RentalController::class)->only(['index', 'create', 'store', 'show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');
    Route::resource('mountains', MountainController::class)->except('show');
    Route::resource('gear-categories', GearCategoryController::class)->except('show');
    Route::resource('gear', GearController::class)->except('show');
    Route::resource('rentals', RentalController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('rental-items', RentalItemController::class)->except('show');
    Route::resource('recommendations', MountainRecommendationController::class)->except('show');
    
    // Reports routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.export-excel');
});

require __DIR__.'/auth.php';
