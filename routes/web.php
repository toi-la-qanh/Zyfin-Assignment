<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GetInTouchController;

// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/contact', [GetInTouchController::class, 'index']);
Route::post('/contact', [GetInTouchController::class, 'store'])->name('contact.store');
