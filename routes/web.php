<?php

use App\Http\Controllers\CargoNominaController;
use App\Models\Empleado;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\IncapacidadeController;
use App\Http\Controllers\CruceController;
use App\Http\Controllers\InfoEmpleadoPerNominaController;
use App\Http\Controllers\PagoEmpleadoController;

use App\Models\CargoNomina;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});



//RECORDAR PONER EL / EN LAS RUTAS SOLAS COMO EN EL DOMPDF, NO OLVIDES PORFAVOR.

Auth::routes();

Route::get('/cruces/pdf', [CruceController::class, 'pdf'])->name('cruces.pdf')->middleware(['auth']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::resource('/empleados', EmpleadoController::class)->middleware(['auth']);
Route::resource('/empleadores', EmpleadorController::class)->middleware(['auth']);
Route::resource('/incapacidades', IncapacidadeController::class)->middleware(['auth']);
Route::resource('/cruces', CruceController::class)->middleware(['auth']);
Route::resource('/empleadosnomina', InfoEmpleadoPerNominaController::class)->middleware(['auth']);
Route::resource('/cargos', CargoNominaController::class)->middleware(['auth']);
Route::resource('/nomina', PagoEmpleadoController::class)->middleware(['auth']);
Route::get('/ruta/para/obtener/datos/empleado/{id_EmpleadoNomina}', [InfoEmpleadoPerNominaController::class, 'obtenerDatosEmpleado'])->middleware(['auth']);










