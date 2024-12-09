<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test500', [ExampleController::class, 'test500']);

Route::get('/form', [App\Http\Controllers\StudentController::class, 'form'])->name('form');
Route::post('/submit', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');

Route::resource('/notes', NoteController::class);
Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::get('/notes/delete/{note}', [\App\Http\Controllers\NoteController::class, 'delete'])->name('notes.delete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
