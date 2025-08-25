<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/test500', [ExampleController::class, 'test500']);

Route::get('/form', [App\Http\Controllers\StudentController::class, 'form'])->name('form');
Route::post('/submit', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
