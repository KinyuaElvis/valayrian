<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\Admin\AdminRegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PestAnalysisController;



// Route::get('/', function () {
//     return view('welcome');
// });




// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store']);
    Route::post('/logout', [AdminAuthController::class, 'destroy'])->middleware('auth:admin')->name('logout');
    
    // Admin Registration
    Route::get('/register', [AdminRegisterController::class, 'create'])->name('register');
    Route::post('/register', [AdminRegisterController::class, 'store']);
    
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return 'Admin Dashboard'; // Placeholder
    })->middleware('auth:admin')->name('dashboard');
});

Route::get('/', function () {
    return redirect()->route('login');
});

// USER AUTHENTICATION ROUTES
// =========================================================================
Route::middleware('guest')->group(function () {
    // Show Registration Form
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // Handle Registration
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Show Login Form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // Handle Login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route to show the upload page
    Route::get('/analyze', [PestAnalysisController::class, 'create'])->name('analysis.create');

    // Route to handle the form submission
    Route::post('/analyze', [PestAnalysisController::class, 'store'])->name('analysis.store');

    // Route to show the results of a specific analysis
    Route::get('analysis/{result}', [PestAnalysisController::class, 'show'])->name('analysis.show');

    // Route for the user's history/dashboard
    Route::get('/dashboard', [PestAnalysisController::class, 'index'])->name('dashboard');
});
