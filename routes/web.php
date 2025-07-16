<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
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

require __DIR__.'/auth.php';

// Home
Route::get('/', [FrontController::class, 'getHome'])->name('home');

// About
Route::get('/about', [FrontController::class, 'getAbout'])->name('about');

// Portfolio progetti (progetti chiusi con testimonianze)
Route::get('/portfolio', [ProjectController::class, 'portfolio'])->name('project.portfolio');

// Progetti con controllo accesso per status
Route::get('/project', [ProjectController::class, 'index'])
    ->middleware('checkProjectAccess')
    ->name('project.index');

// Progetti - altre route
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

Route::middleware(['auth', 'isRegisteredUser'])->group(function () {
    
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/{id}/destroy/confirm', [ProjectController::class, 'confirmDestroy'])->name('project.destroy.confirm');
});