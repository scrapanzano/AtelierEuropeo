<?php

use App\Http\Controllers\CreatorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Home
Route::get('/', [FrontController::class, 'getHome'])->name('home');

// Progetti
Route::resource('project', ProjectController::class);
Route::get('/project/{id}/destroy/confirm', [ProjectController::class, 'confirmDestroy'])->name('project.destroy.confirm');

// Creatori
Route::resource('creator', CreatorController::class);
Route::get('/creator/{id}/destroy/confirm', [CreatorController:: class, 'confirmDestroy'])->name('creator.destroy.confirm');