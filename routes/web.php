<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CreateEventContoller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Society\EventManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Society\DashboardController as SocietyDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\MapcsdDemoController;

# Demo routes



#--#--#



Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/home-event', [CreateEventContoller::class, 'displayEvent'])->name('homeEvent');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'role:society'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminDashboardView'])->name('adminDashboard');
    Route::post('/admin/verify-user/{id}', [AdminDashboardController::class, 'verifyUser'])->name('VerifyUser');
    
});

// Society Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [SocietyDashboardController::class, 'index'])->name('society.dashboard');
    Route::get('/eventapplicationview', [EventManagementController::class, 'eventApplicationView'])->name('society.event_application_view');
    Route::get('/create-event-view', function () {
        return view('society.createEvent');
    })->name('society.create-event-view');
    Route::post('/create-event', [CreateEventContoller::class, 'store'])->name('society.createEvent');
    Route::post('/store-event-application-data', [EventManagementController::class, 'storeEventApplicationData'])->name('society.storeEventApplicationData');
    Route::get('/display-single-event-application/{id}', [SocietyDashboardController::class, 'displaySingleEventApplication'])
        ->name('society.displaySingleEventApplication');
    Route::delete('/society/delete-event-epplication/{id}', [SocietyDashboardController::class, 'deleteEventApplication'])->name('society.deleteEventApplication');
    Route::get('/society/add-society-advisor-view', [RegisteredUserController::class, 'add_society_advisor_view'])
        ->name('society.add_society_advisor_view');
    Route::post('/society/add-society-advisor', [RegisteredUserController::class, 'add_society_advisor'])
        ->name('society.add_society_advisor');
    Route::delete('/society/delete-advisor/{id}', [SocietyDashboardController::class, 'deleteSocietyAdvisor'])
    ->name('society.delete_society_advisor');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
