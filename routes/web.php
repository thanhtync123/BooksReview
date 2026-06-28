<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookController;
Route::get('/', function () {
return redirect()->route('books.index');
});

Route::resource('books', BookController::class)->only(['index', 'show']);
Route::resource('books.reviews', ReviewController::class)->only(['create', 'store']);