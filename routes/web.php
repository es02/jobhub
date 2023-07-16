<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/job', [JobController::class, 'index'])->name('job');
    Route::put('/job', [JobController::class, 'store'])->name('job');
    Route::patch('/job/{id}', [JobController::class, 'update'])->name('job.update');
    Route::delete('/job/{id}', [JobController::class, 'destroy'])->name('job.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/training', [TrainingController::class, 'index'])->name('training');
    Route::put('/training', [TrainingController::class, 'create'])->name('training.create');
    Route::patch('/training/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('/training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');
});

require __DIR__.'/auth.php';
