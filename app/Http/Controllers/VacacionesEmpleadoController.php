<?php

namespace App\Http\Controllers;

use App\Models\VacacionesEmpleado;
use App\Http\Requests\StoreVacacionesEmpleadoRequest;
use App\Http\Requests\UpdateVacacionesEmpleadoRequest;
use App\Models\infoEmpleadoPerNomina;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class VacacionesEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = infoEmpleadoPerNomina::all();
        $vacaciones = VacacionesEmpleado::all();
        return view('Nomina.Vacaciones.CRUD', compact('vacaciones', 'empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(StoreVacacionesEmpleadoRequest $request)
     {
         try {
             $request->validate([
                 "id_EmpleadoNomina" => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
                 "fecha_inicio" => 'required|date',
                 "fecha_salida" => 'required|date',
                 "dias_trabajados" => 'required|numeric',
                 "dias_vacaciones" => 'required|numeric',
                 "dias_descanso" => 'required|numeric',
                 "pago_vacaciones" => 'required|numeric',
                 "Observacion" => 'required|string',
             ]);
     
             // Verificar si el empleado puede tomar vacaciones en base a la fecha de la última vacación
             $ultimaVacacion = VacacionesEmpleado::where('id_EmpleadoNomina', $request->input('id_EmpleadoNomina'))
                             ->orderBy('fecha_salida', 'desc')
                             ->first();
     
             if ($ultimaVacacion) {
                 $fechaSalida = Carbon::parse($ultimaVacacion->fecha_salida);
                 if ($fechaSalida->addYear()->isFuture()) {
                     Session::flash('error', 'El empleado debe esperar un año desde su última vacación.');
                     return back();
                 }
             }
     
             // Validar si cumple con la cantidad de días trabajados
             $minimoDiasTrabajados = 365; // Por ejemplo, un año de trabajo requerido
             $diasTrabajados = $request->input('dias_trabajados');
     
             if ($diasTrabajados < $minimoDiasTrabajados) {
                 Session::flash('error', 'El empleado debe haber trabajado al menos ' . $minimoDiasTrabajados . ' días para tomar vacaciones.');
                 return back();
             }
     
             // Si las validaciones pasan, se registran las vacaciones
             VacacionesEmpleado::create([
                 'id_EmpleadoNomina' => $request->input('id_EmpleadoNomina'),
                 'fecha_inicio' => $request->input('fecha_inicio'),
                 'fecha_salida' => $request->input('fecha_salida'),
                 'dias_trabajados' => $request->input('dias_trabajados'),
                 'dias_vacaciones' => $request->input('dias_vacaciones'),
                 'dias_descanso' => $request->input('dias_descanso'),
                 'pago_vacaciones' => $request->input('pago_vacaciones'),
                 'Observacion' => $request->input('Observacion'),
             ]);
     
             Session::flash('success', 'Las vacaciones fueron creadas exitosamente!');
             return back();
     
         } catch (QueryException $e) {
             // Manejo de excepciones específicas de la base de datos
             switch ($e->errorInfo[1]) {
                 case 1062:
                     Session::flash('error', 'El empleado ya está registrado en la base de datos. Por favor, verifica e intenta nuevamente.');
                     break;
                 case 1048:
                     Session::flash('error', 'Hay columnas que se están enviando vacías. Por favor, comunícate con el administrador.');
                     break;
                 case 1064:
                 case 1452:
                     Session::flash('error', 'Ha sido imposible relacionar la información. Verifica los datos ingresados.');
                     break;
                 case 1364:
                     Session::flash('error', 'Datos ingresados no válidos. Por favor, vuelve a ingresarlos.');
                     break;
                 default:
                     Session::flash('error', '¡Ups! Algo salió mal al crear las vacaciones: ' . $e->getMessage());
                     break;
             }
             return back();
     
         } catch (Exception $ex) {
             Session::flash('error', '¡Ups! Algo salió mal al procesar la solicitud: ' . $ex->getMessage());
             return back();
         }
     }
     
    

    /**
     * Display the specified resource.
     */
    public function show(VacacionesEmpleado $vacacionesEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VacacionesEmpleado $vacacionesEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacacionesEmpleadoRequest $request, $idVacacionesEmpleado)
    {   
        try {
            // Encuentra el registro por el id usando el nombre correcto de la columna
            $vacacionEmpleado = VacacionesEmpleado::findOrFail($idVacacionesEmpleado);
        
            // Valida los datos del request
            $request->validate([
                "id_EmpleadoNomina" => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
                "fecha_inicio" => 'required|date',
                "fecha_salida" => 'required|date',
                "dias_trabajados" => 'required|numeric',
                "dias_vacaciones" => 'required|numeric',
                "dias_descanso" => 'required|numeric',
                "pago_vacaciones" => 'required|numeric',
                "Observacion" => 'required|string',
            ]);
        
            if ($vacacionEmpleado) {
                // Actualiza el registro
                $vacacionEmpleado->update([
                    'id_EmpleadoNomina' => request('id_EmpleadoNomina'),
                    'fecha_inicio' => request('fecha_inicio'),
                    'fecha_salida' => request('fecha_salida'),
                    'dias_trabajados' => request('dias_trabajados'),
                    'dias_vacaciones' => request('dias_vacaciones'),
                    'dias_descanso' => request('dias_descanso'),
                    'pago_vacaciones' => request('pago_vacaciones'),
                    'Observacion' => request('Observacion'),
                ]);
            }
        
            Session::flash('success', '¡La Vacación se actualizó correctamente!');
            return back();
        }catch (QueryException $e) {
            // Manejo de excepciones específicas de la base de datos
            if ($e->errorInfo[1] == 1062) {
                Session::flash('error', 'La Vacación ya está en la base de datos. Por favor, verifica e inténtalo nuevamente.');
            } elseif ($e->errorInfo[1] == 1048) {
                Session::flash('error', 'Hay columnas que se están enviando vacías, comunícate con el administrador.');
            } elseif ($e->errorInfo[1] == 1064 || $e->errorInfo[1] == 1452) {
                Session::flash('error', 'Ha sido imposible relacionar la información.');
            } elseif ($e->errorInfo[1] == 1364) {
                Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.');
            } else {
                Session::flash('error', '¡Ups! Algo salió mal al actualizar la Vacación: ' . $e->getMessage());
            }
            return back();
        } catch (Exception $ex) {
            Session::flash('error', '¡Ups! Algo salió mal al actualizar la Vacación: ' . $ex->getMessage());
            return back();
        }
        
        



        // return  dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacacionesEmpleado $vacacionesEmpleado)
    {
        //
    }
}
