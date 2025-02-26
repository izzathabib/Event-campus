<?php

use Illuminate\Support\Facades\Route;

Route::get(' ', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/eventmanagement', function () {
    return view('eventManagement');
})->name('eventManagement');