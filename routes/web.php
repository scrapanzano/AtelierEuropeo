<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Include authentication routes
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Public Routes (Guest & Authenticated)
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', [FrontController::class, 'getHome'])->name('home');

// Static pages
Route::get('/about', [FrontController::class, 'getAbout'])->name('about');

// Portfolio (completed projects with testimonials)
Route::get('/portfolio', [ProjectController::class, 'portfolio'])->name('project.portfolio');

// Project listing (with access control middleware)
Route::get('/project', [ProjectController::class, 'index'])
    ->middleware('checkProjectAccess')
    ->name('project.index');

// Single project view (public)
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    
    /*
    |--------------------------------------------------------------------------
    | User Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | User Applications Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('applications')->name('applications.')->group(function () {
        Route::get('/', [ApplicationController::class, 'index'])->name('index');
        Route::get('/{application}', [ApplicationController::class, 'show'])->name('show');
    });

    // Project application routes (nested under project)
    Route::prefix('project/{id}')->name('applications.')->group(function () {
        Route::get('/apply', [ApplicationController::class, 'create'])->name('create');
        Route::post('/apply', [ApplicationController::class, 'store'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'isAdmin'])->group(function () {
    
    /*
    |--------------------------------------------------------------------------
    | Project Management Routes (Admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('project')->name('project.')->group(function () {
        // Project CRUD operations
        Route::get('/create', [ProjectController::class, 'create'])->name('create');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('destroy');
        
        // Project status management
        Route::get('/{id}/destroy/confirm', [ProjectController::class, 'confirmDestroy'])->name('destroy.confirm');
        Route::get('/{id}/complete/confirm', [ProjectController::class, 'confirmCompletion'])->name('confirm.completion');
        Route::put('/{id}/complete', [ProjectController::class, 'complete'])->name('complete');
        
        // AJAX validation routes
        Route::post('/validate', [ProjectController::class, 'validateAjax'])->name('validate');
        Route::post('/check-title', [ProjectController::class, 'checkTitleUnique'])->name('checkTitle');
    });

    /*
    |--------------------------------------------------------------------------
    | Application Management Routes (Admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Project applications management
        Route::prefix('project/{projectId}')->group(function () {
            Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
        });
        
        // Individual application management
        Route::prefix('applications/{application}')->name('applications.')->group(function () {
            Route::get('/', [AdminApplicationController::class, 'show'])->name('show');
            Route::patch('/update-status', [AdminApplicationController::class, 'updateStatus'])->name('update-status');
            Route::patch('/approve', [AdminApplicationController::class, 'approve'])->name('approve');
            Route::patch('/reject', [AdminApplicationController::class, 'reject'])->name('reject');
        });
    });
});