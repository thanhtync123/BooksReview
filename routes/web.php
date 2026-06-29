<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;

use Illuminate\Support\Facades\Artisan;
Route::get('/seed', function () {
    Artisan::call('migrate --force');
    Artisan::call('db:seed --force');
    return 'Seed done';
});


Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);

    Route::resource('books.reviews', ReviewController::class)
        ->only(['create', 'store']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/my-reviews', [ReviewController::class, 'myReviews'])
        ->name('reviews.my');
    Route::delete('/my-reviews/{id}', [ReviewController::class, 'deleteMyReviews'])
        ->name('reviews.deleteMyReviews');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
