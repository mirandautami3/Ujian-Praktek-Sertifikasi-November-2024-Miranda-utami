<?php

use App\Http\Controllers\buku_controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\member_controller;
use App\Http\Controllers\kategori_controller;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Resource routes
Route::resource('member', member_controller::class);
Route::resource('kategori', kategori_controller::class);
Route::resource('buku', buku_controller::class);


require __DIR__.'/auth.php';
