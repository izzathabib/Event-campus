<?php

use Illuminate\Support\Facades\Route;

Route::get(' ', function () {
    return redirect()->route('registerEvent');
});

Route::get('/registerEvent', function () {
    return view('registerEvent');
})->name('registerEvent');;