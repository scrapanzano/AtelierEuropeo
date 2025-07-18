<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminApplicationController;
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

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/project/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/project/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/project/{id}/destroy/confirm', [ProjectController::class, 'confirmDestroy'])->name('project.destroy.confirm');
    Route::get('/project/{id}/complete/confirm', [ProjectController::class, 'confirmCompletion'])->name('project.confirm.completion');
    Route::put('/project/{id}/complete', [ProjectController::class, 'complete'])->name('project.complete');
    Route::post('/project/validate', [ProjectController::class, 'validateAjax'])->name('project.validate');
    Route::post('/project/check-title', [ProjectController::class, 'checkTitleUnique'])->name('project.checkTitle');
    
    // Route per amministrazione candidature
    Route::get('/admin/project/{projectId}/applications', [AdminApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{application}', [AdminApplicationController::class, 'show'])->name('admin.applications.show');
    Route::patch('/admin/applications/{application}/update-status', [AdminApplicationController::class, 'updateStatus'])->name('admin.applications.update-status');
    Route::patch('/admin/applications/{application}/approve', [AdminApplicationController::class, 'approve'])->name('admin.applications.approve');
    Route::patch('/admin/applications/{application}/reject', [AdminApplicationController::class, 'reject'])->name('admin.applications.reject');
});

// Progetti - altre route 
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

// Route per le candidature
Route::middleware('auth')->group(function () {
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/project/{id}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/project/{id}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
});