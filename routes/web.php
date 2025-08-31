<?php

use App\Http\Controllers\projects\ProjectsController;
use App\Http\Controllers\Programs\ProgramController;
use App\Http\Controllers\Facilities\FacilityController;
<<<<<<< Updated upstream
use App\Http\Controllers\services\ServicesController;
=======
use App\Http\Controllers\Equipment\EquipmentController;
>>>>>>> Stashed changes
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
Route::get('programs/{program}/projects', [ProgramController::class, 'projects'])->name('programs.projects.index');



Route::resource('facilities', FacilityController::class);

// Equipment routes
Route::get('facilities/{facility}/equipment', [EquipmentController::class, 'byFacility'])->name('facilities.equipment.index');
Route::resource('equipment', EquipmentController::class);


Route::resource('projects', ProjectsController::class);

Route::resource('services', ServicesController::class);
Route::get('facilities/{facility}/services', [ServicesController::class, 'byFacility'])->name('facilities.services.index');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
