<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Society\DashboardController as SocietyDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

Route::get('/', function () {
    return view('auth/login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:society'])->name('dashboard');

// Admin Routes
// Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
//     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//     // Add other admin-specific routes here, for example:
//     // Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
// });

// Society Routes
Route::middleware(['auth', 'verified', 'IsSociety'])->group(function () {
    Route::get('/dashboard', [SocietyDashboardController::class, 'index'])->name('society.dashboard');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    // Add other admin-specific routes here, for example:
    // Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);
});

// Student Routes
// Route::middleware(['auth', 'verified', 'role:student'])->group(function () {
//     Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
//     // Add other student-specific routes here, for example:
//     // Route::get('/courses', [\App\Http\Controllers\Student\CourseController::class, 'index'])->name('courses.index');
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
