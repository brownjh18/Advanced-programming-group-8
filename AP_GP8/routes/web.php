<?php

use App\Http\Controllers\projects\ProjectsController;
use App\Http\Controllers\Programs\ProgramController;
use App\Http\Controllers\Facilities\FacilityController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});


Route::resource('programs', ProgramController::class);



Route::resource('facilities', FacilityController::class);


Route::resource('projects', ProjectsController::class);


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
