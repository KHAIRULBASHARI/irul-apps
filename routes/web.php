<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage.index');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Dummy logout route (ganti dengan auth route jika pakai Laravel Breeze/Jetstream)
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');
