<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;

// use Illuminate\Support\Facades\Artisan;
// Route::get('/seed', function () {
//     Artisan::call('migrate --force');
//     Artisan::call('db:seed --force');
//     return 'Seed done';
// });

Route::get('/', function () {
return redirect()->route('books.index');
});

Route::resource('books', BookController::class)->only(['index', 'show']);
Route::resource('books.reviews', ReviewController::class)->only(['create', 'store']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout']);

Route::get('/register',[AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register',[AuthController::class, 'store'])->name('register.store');