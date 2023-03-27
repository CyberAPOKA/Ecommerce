<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\PicPayController;
use App\Http\Controllers\Site\ProductController;
use Inertia\Inertia;
use Illuminate\Foundation\Application;

// Route::get('/', [HomeController::class, 'home',])->name('home');
Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('payments', [PicPayController::class, 'teste'])->name('payment');

    Route::get('product/{slug}', [ProductController::class, 'show'])->name('product.show');
});
Route::post('buy/product', [PicPayController::class, 'payment'])->name('product.payment');

Route::post('notification', [PicPayController::class, 'notification'])->name('notification');
