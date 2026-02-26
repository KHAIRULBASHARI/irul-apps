<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage.index');
});

use App\Http\Controllers\Admin\PatientController;

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('patients', PatientController::class)->except(['show']);
});
