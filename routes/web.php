<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Society\EventManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Society\DashboardController as SocietyDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\MapcsdDemoController;

# Demo routes

Route::get('/schedule-builder', function () {
    return view('schedule-builder');
});

// Route to display the form
Route::get('/my-csd-form', [MapcsdDemoController::class, 'showForm'])->name('csd.form.show');

// Route to handle form submission
Route::post('/my-csd-form', [MapcsdDemoController::class, 'submitForm'])->name('csd.form.submit');

#--#--#



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
    Route::get('/eventapplicationview', [EventManagementController::class, 'eventApplicationView'])->name('society.event_application_view');
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
