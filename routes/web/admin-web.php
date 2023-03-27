<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::namespace('Admin')->prefix('/admin')->group(function () {

    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/register', [AuthController::class, 'register'])->name('admin.register');

    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');

    Route::post('/auth', [AuthController::class, 'auth'])->name('admin.auth');

    Route::middleware('admin')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});
