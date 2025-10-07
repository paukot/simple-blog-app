<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'completeRegistration'])->name('complete-registration');
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('posts', PostController::class)
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], ['auth']);
Route::resource('posts.comments', CommentController::class)
    ->middleware(['auth'])
    ->only(['store', 'destroy']);
