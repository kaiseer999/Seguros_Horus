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




        return view('Nomina.Primas.CRUD', compact('empleados'));
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
        //
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
