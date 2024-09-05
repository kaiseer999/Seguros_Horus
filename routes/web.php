<?php


use App\Models\Empleado;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpleadorController;
use App\Http\Controllers\IncapacidadeController;
use App\Http\Controllers\CruceController;
use App\Http\Controllers\InfoEmpleadoPerNominaController;
use App\Http\Controllers\PagoEmpleadoController;
use App\Http\Controllers\PrimaEmpleadoController;
use App\Http\Controllers\VacacionesEmpleadoController;
use App\Http\Controllers\ClienteFacturaController;
use App\Http\Controllers\AsesorComercialController;
use App\Http\Controllers\CargoNominaController;
use App\Http\Controllers\CesantiasEmpleadoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProductoFacturaController;
use App\Http\Controllers\VencimientosPolizasController;
use App\Models\CargoNomina;
use App\Models\CesantiasEmpleado;
use App\Models\Factura;
use App\Models\PrimaEmpleado;
use App\Models\ProductoFactura;
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
Route::get('/datosempleado/{id_EmpleadoNomina}', [InfoEmpleadoPerNominaController::class, 'obtenerEmpleado'])->middleware(['auth']);
Route::resource('/prima', PrimaEmpleadoController::class)->middleware(['auth']);
Route::resource('/cesantias', CesantiasEmpleadoController::class)->middleware(['auth']);
Route::get('/datosPrima/{id_EmpleadoNomina}/{anio}/{periodo}', [PrimaEmpleadoController::class, 'obtenerPrimaSemestral'])->middleware(['auth']);
Route::resource('/vacaciones', VacacionesEmpleadoController::class)->middleware(['auth']);
Route::resource('/clientes', ClienteFacturaController::class)->middleware(['auth']);
Route::resource('/asesores', AsesorComercialController::class)->middleware(['auth']);
Route::resource('/facturas', FacturaController::class)->middleware(['auth']);
Route::get('/producto/create', [ProductoFacturaController::class, 'create'])->middleware(['auth']);
Route::post('/producto/create', [ProductoFacturaController::class, 'store'])->middleware(['auth']);
Route::get('/productoCategoria/{idCategoriaProducto}', [FacturaController::class, 'obtenerProductoCategoria'])->middleware(['auth']);
Route::get('/obtenerDetallesProducto/{codigoProducto}', [FacturaController::class, 'obtenerDetallesProducto'])->middleware(['auth']);
Route::get('/obtenerAsesor/{idAsesorComercial}', [ClienteFacturaController::class, 'obtenerAsesores'] )->middleware(['auth']);
Route::resource('/vencimientos', VencimientosPolizasController::class)->middleware(['auth']);
Route::get('/infoEmpleadoCesantias/{idEmpleado}/{anio}', [CesantiasEmpleadoController::class, 'obtenerInfoEmpleado'])->middleware(['auth']);
Route::get('/test/', [FacturaController::class, 'test'])->middleware(['auth']);







