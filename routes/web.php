<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\TenantController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route khusus Super Admin
    Route::get('/admin', function () {
        return \Inertia\Inertia::render('Dashboard');
    })->middleware('role:super_admin')->name('admin.dashboard');

    // Route khusus Manajemen Toko (Tenant)
    Route::get('/admin/tenants', [TenantController::class, 'index'])
        ->middleware('role:super_admin')
        ->name('admin.tenants.index');
    Route::get('/admin/tenants/create', [TenantController::class, 'create'])
        ->middleware('role:super_admin')
        ->name('admin.tenants.create');
    Route::post('/admin/tenants', [TenantController::class, 'store'])
        ->middleware('role:super_admin')
        ->name('admin.tenants.store');

    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])
        ->middleware('role:super_admin')
        ->name('admin.activity_logs.index');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    
    // Rute Modul Kasbon Mandor
    Route::get('/debts', [DebtController::class, 'index'])->name('debts.index');
    Route::get('/debts/create', [DebtController::class, 'create'])->name('debts.create');
    Route::post('/debts', [DebtController::class, 'store'])->name('debts.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
