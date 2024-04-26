<?php

use App\Models\Empleado;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\IncapacidadeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/empleados', EmpleadoController::class);
Route::resource('/empleadores', EmpleadorController::class);
Route::resource('/incapacidades', IncapacidadeController::class);



