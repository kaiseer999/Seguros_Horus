<?php

use App\Models\Empleado;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\IncapacidadeController;
use App\Http\Controllers\CruceController;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//RECORDAR PONER EL / EN LAS RUTAS SOLAS COMO EN EL DOMPDF, NO OLVIDES PORFAVOR.

Auth::routes();

Route::get('/cruces/pdf', [CruceController::class, 'pdf'])->name('cruces.pdf');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/empleados', EmpleadoController::class);
Route::resource('/empleadores', EmpleadorController::class);
Route::resource('/incapacidades', IncapacidadeController::class);
Route::resource('/cruces', CruceController::class);




