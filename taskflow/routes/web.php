<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', fn () => redirect()->route('projects.index'));

Route::middleware('auth')->group(function () {
    // Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    // Route::get('/projects/{project}', [ProjectController::class, 'show'])
        // ->middleware('project.active')          // notion 09
        // ->name('projects.show');

    Route::resource('tasks', TaskController::class);

    // notion 14 : route utilisée par l'action CompleteTask et par les tests
    Route::patch('/tasks/{task}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');

    Route::patch('/tasks/{task}/assign/{user}', [TaskController::class, 'assign'])
        ->name('tasks.assign');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
