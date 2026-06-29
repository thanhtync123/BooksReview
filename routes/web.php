<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ReviewController as User_ReviewController;
use App\Http\Controllers\User\BookController as User_BookController;
use App\Http\Controllers\Admin\BookController as Admin_BookController;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
    return Artisan::output();
});

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('books', User_BookController::class);

    Route::resource('books.reviews', User_ReviewController::class)
        ->only(['create', 'store']);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/my-reviews', [User_ReviewController::class, 'myReviews'])
        ->name('reviews.my');
    Route::delete('/my-reviews/{id}', [User_ReviewController::class, 'deleteMyReviews'])
        ->name('reviews.deleteMyReviews');

    Route::prefix('admin')
        ->as('admin.')
        ->group(function () {
            Route::resource('books', Admin_BookController::class);
        });
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
