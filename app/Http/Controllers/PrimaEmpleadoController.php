<?php

namespace App\Http\Controllers;

use App\Models\PrimaEmpleado;
use App\Http\Requests\StorePrimaEmpleadoRequest;
use App\Http\Requests\UpdatePrimaEmpleadoRequest;
use App\Models\infoEmpleadoPerNomina;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;




class PrimaEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = infoEmpleadoPerNomina::whereHas('infoEmpleadoAdminNomina', function ($query) {
            $query->where('idEstadoEmpleadoNomina', 1); // Filtrar por estado 1
        })->get();

        $primas = PrimaEmpleado::all();


        return view('Nomina.Primas.CRUD', compact('empleados', 'primas'));
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
    public function store(StorePrimaEmpleadoRequest $request)
{
    try {
        // Validación de datos
        $request->validate([
            'AnioPago' => 'required|string',
            'id_EmpleadoNomina' => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
            'PeriodoPago' => 'required|string|in:primer_semestre,segundo_semestre',
            'DiasLaborados' => 'required|string',
            'AuxTransEmp' => 'required|numeric',
            'Prima' => 'required|numeric'
        ]);

        // Verificar que el período de pago sea válido (junio o diciembre)
        if ($request->PeriodoPago === 'primer_semestre' && !in_array(date('m'), [6])) {
            Session::flash('error', 'La prima debe ser creada en el mes de junio para el primer semestre.');
            return back();
        }
        
        if ($request->PeriodoPago === 'segundo_semestre' && !in_array(date('m'), [12])) {
            Session::flash('error', 'La prima debe ser creada en el mes de diciembre para el segundo semestre.');
            return back();
        }

        // Verificar si ya existe una prima para el empleado en el período especificado
        $exists = PrimaEmpleado::where('id_EmpleadoNomina', $request->id_EmpleadoNomina)
            ->where('AnoPago', $request->AnioPago)
            ->where('periodoPago', $request->PeriodoPago)
            ->exists();

        if ($exists) {
            Session::flash('error', 'Ya existe un registro de prima para este empleado en el período especificado.');
            return back();
        }

        // Crear el nuevo registro de prima
        PrimaEmpleado::create([
            'AnoPago' => $request->AnioPago,
            'id_EmpleadoNomina' => $request->input('id_EmpleadoNomina'),
            'periodoPago' => $request->PeriodoPago,
            'diasLaborados' => $request->DiasLaborados,
            'AuxTransporte' => $request->AuxTransEmp,
            'TotalPagoPrima' => $request->Prima
        ]);

        Session::flash('success', 'La prima empleado guardada exitosamente!');
        return back();

    } catch (QueryException $e) {
        // Manejo de excepciones específicas de la base de datos
        switch ($e->errorInfo[1]) {
            case 1062:
                Session::flash('error', 'La prima empleado ya está en la base de datos. Por favor, verifica e intentalo nuevamente.');
                break;
            case 1048:
                Session::flash('error', 'Hay columnas que están enviándose vacías, comunícate con el administrador.'.$e->getMessage());
                break;
            case 1064:
            case 1452:
                Session::flash('error', 'Ha sido imposible relacionar la información.');
                break;
            case 1364:
                Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.'.$e->getMessage());
                break;
            default:
                Session::flash('error', '¡Ups! Algo salió mal al crear La prima empleado: ' . $e->getMessage());
                break;
        }
        return back();
        
    } catch (Exception $ex) {
        Session::flash('error', '¡Ups! Algo salió mal al crear La prima empleado: ' . $ex->getMessage());
        return back();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(PrimaEmpleado $primaEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrimaEmpleado $primaEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePrimaEmpleadoRequest $request, PrimaEmpleado $primaEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimaEmpleado $primaEmpleado)
    {
        //
    }

    public function obtenerPrimaSemestral($id_EmpleadoNomina, $anio, $periodo)
    {
        try {
            // Obtener la información del empleado
            $empleado = infoEmpleadoPerNomina::with(['infoEmpleadoAdminNomina', 'pagoEmpleado'])
                ->findOrFail($id_EmpleadoNomina);
    
            // Salario del empleado
            $salario = $empleado->infoEmpleadoAdminNomina->SalarioEmpleadoNom;
    
            if ($periodo == 'primer_semestre') {
                // Obtener los días trabajados de enero a junio del año especificado
                $diasTrabajados = $empleado->pagoEmpleado()
                    ->whereYear('FechaDePagoNom', $anio)
                    ->whereBetween('FechaDePagoNom', ["$anio-01-01", "$anio-06-30"])
                    ->sum('DiasLaborados');
    
                $diasTrabajados = min($diasTrabajados, 180);
            } else if ($periodo == 'segundo_semestre') {
                // Obtener los días trabajados de julio a diciembre del año especificado
                $diasTrabajados = $empleado->pagoEmpleado()
                    ->whereYear('FechaDePagoNom', $anio)
                    ->whereBetween('FechaDePagoNom', ["$anio-07-01", "$anio-12-31"])
                    ->sum('DiasLaborados');
    
                $diasTrabajados = min($diasTrabajados, 180);
            } else {
                return response()->json(['error' => 'Período no válido'], 400);
            }
    
            return response()->json([
                'nombre' => $empleado->nombreEmpleadoNom,
                'anio' => $anio,
                'salario' => $salario,
                'diasTrabajados' => $diasTrabajados,
            ]);
    
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Empleado no encontrado en la base de datos'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error al cargar los detalles del empleado'], 500);
        }
    }
    

    
    
}
