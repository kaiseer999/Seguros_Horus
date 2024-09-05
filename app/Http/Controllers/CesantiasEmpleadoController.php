<?php

namespace App\Http\Controllers;

use App\Models\CesantiasEmpleado;
use App\Models\infoEmpleadoPerNomina;
use App\Http\Requests\StoreCesantiasEmpleadoRequest;
use App\Http\Requests\UpdateCesantiasEmpleadoRequest;
use App\Models\InteresesCesantias;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\DB;

class CesantiasEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados =  infoEmpleadoPerNomina::whereHas('infoEmpleadoAdminNomina', function ($query) {
            $query->where('idEstadoEmpleadoNomina', 1); // Filtrar por estado 1
        })->get();

        $cesantias = CesantiasEmpleado::with('interes')->get();

        // dd($cesantias); 
        return view('Nomina.Cesantias.CRUD', compact('empleados', 'cesantias'));
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
    public function store(StoreCesantiasEmpleadoRequest $request)
    {
        try {
            // Validación de los datos
            $request->validate([
                'AnioPago' => 'required|numeric',
                'id_EmpleadoNomina' => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
                'SalarioEmpleado' => 'required|numeric',
                'DiasLaborados' => 'required|numeric',
                'Observaciones' => 'required|string',
                'CesantiasEmpleado' => 'required|numeric',
                'InteresesCesantiasEmpleado' => 'required|numeric',
            ]);
        
            DB::beginTransaction();
        
            // Creación del registro en cesantiasEmpleado
            $cesantiasEmpleado = CesantiasEmpleado::create([
                'Anio' => $request->AnioPago,
                'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
                'salarioEmpleado' => $request->SalarioEmpleado,
                'diasLaborados' => $request->DiasLaborados,
                'totalCesantias' => $request->CesantiasEmpleado,
                'Observaciones' => $request->Observaciones,
            ]);
        
            // Creación del registro en InteresesCesantias
            InteresesCesantias::create([
                'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
                'idCesantiasEmpleado' => $cesantiasEmpleado->id,  // Usa el nombre correcto de la columna
                'valorInteresesCesantias' => $request->InteresesCesantiasEmpleado,
            ]);
        
            DB::commit();
        
            Session::flash('success', '¡Cesantía guardada exitosamente!');
            return back();
        
        }catch (QueryException $e) {
            DB::rollBack(); // Deshacer la transacción en caso de error
    
            switch ($e->errorInfo[1]) {
                case 1062:
                    Session::flash('error', 'La Cesantía ya está en la base de datos. Por favor, verifica e intenta nuevamente.'. $e->getMessage());
                    break;
                case 1048:
                    Session::flash('error', 'Hay columnas que están enviándose vacías, comunícate con el administrador.'. $e->getMessage());
                    break;
                case 1064:
                case 1452:
                    Session::flash('error', 'Ha sido imposible relacionar la información.'. $e->getMessage());
                    break;
                case 1364:
                    Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.'. $e->getMessage());
                    break;
                default:
                    Session::flash('error', '¡Ups! Algo salió mal al crear la cesantía: ' . $e->getMessage());
                    break;
            }
            return back()->withInput(); // Retornar a la vista anterior con los datos ingresados
    
        } catch (Exception $ex) {
            DB::rollBack(); // Deshacer la transacción en caso de error
            Session::flash('error', '¡Ups! Algo salió mal al crear la cesantía: ' . $ex->getMessage());
            return back()->withInput(); // Retornar a la vista anterior con los datos ingresados
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(CesantiasEmpleado $cesantiasEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CesantiasEmpleado $cesantiasEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCesantiasEmpleadoRequest $request, $idCesantiaEmpleado)
    {
        try {
            // Busca el registro usando el identificador correcto
            $cesantias = CesantiasEmpleado::where('IdCesantiasEmpleado', $idCesantiaEmpleado)->firstOrFail();
        
            // Validación de los datos del request
            $request->validate([
                'AnioPago' => 'required|numeric',
                'id_EmpleadoNomina' => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
                'SalarioEmpleado' => 'required|numeric',
                'DiasLaborados' => 'required|numeric',
                'Observaciones' => 'required|string',
                'CesantiasEmpleado' => 'required|numeric',
                'InteresesCesantiasEmpleado' => 'required|numeric',
            ]);
        
            // Iniciar transacción
            DB::beginTransaction();
        
            // Actualizar el registro en cesantiasEmpleado
            $cesantias->update([
                'Anio' => $request->AnioPago,
                'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
                'salarioEmpleado' => $request->SalarioEmpleado,
                'diasLaborados' => $request->DiasLaborados,
                'totalCesantias' => $request->CesantiasEmpleado,
                'Observaciones' => $request->Observaciones,
            ]);
        
            // Actualizar o crear el registro de InteresesCesantias
            $interesesCesantias = $cesantias->interes; // Obtener el registro de intereses relacionado
            if ($interesesCesantias) {
                // Actualizar el registro de intereses
                $interesesCesantias->update([
                    'valorInteresesCesantias' => $request->InteresesCesantiasEmpleado,
                ]);
            } else {
                // Si no existe el registro de intereses, crearlo
                InteresesCesantias::create([
                    'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
                    'idCesantiasEmpleado' => $cesantias->IdCesantiasEmpleado,
                    'valorInteresesCesantias' => $request->InteresesCesantiasEmpleado,
                ]);
            }
        
            // Confirmar transacción
            DB::commit();
            
            // Devolver una respuesta exitosa
            Session::flash('success', '¡Cesantía actualizada exitosamente!');
            return back();
        
        } catch (QueryException $e) {
            DB::rollBack();
        
            switch ($e->errorInfo[1]) {
                case 1062:
                    Session::flash('error', 'El registro de Cesantía ya existe en la base de datos. Por favor, verifica e intenta nuevamente.' . $e->getMessage());
                    break;
                case 1048:
                    Session::flash('error', 'Hay columnas que están enviándose vacías, comunícate con el administrador.' . $e->getMessage());
                    break;
                case 1064:
                case 1452:
                    Session::flash('error', 'Ha sido imposible relacionar la información.' . $e->getMessage());
                    break;
                case 1364:
                    Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.' . $e->getMessage());
                    break;
                default:
                    Session::flash('error', '¡Ups! Algo salió mal al actualizar la cesantía: ' . $e->getMessage());
                    break;
            }
            return back()->withInput();
        
        } catch (Exception $ex) {
            DB::rollBack();
            Session::flash('error', '¡Ups! Algo salió mal al actualizar la cesantía: ' . $ex->getMessage());
            return back()->withInput();
        }
    }
    

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCesantiaEmpleado)
    {
        // Buscar el registro de CesantiasEmpleado por ID
        $cesantias = CesantiasEmpleado::where('IdCesantiasEmpleado', $idCesantiaEmpleado)->firstOrFail();
        
        // Obtener el registro relacionado de intereses
        $interesesCesantias = $cesantias->interes;
    
        try {
            // Iniciar una transacción para asegurar la atomicidad
            DB::beginTransaction();
            
            // Eliminar el registro de intereses
            if ($interesesCesantias) {
                $interesesCesantias->delete();
            }
            
            // Eliminar el registro de cesantías
            $cesantias->delete();
            
            // Confirmar la transacción
            DB::commit();
            
            // Mensaje de éxito
            Session::flash('success', '¡Cesantía eliminada exitosamente!');
            return back();
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            
            // Redirigir con mensaje de error
            return redirect()->route('cesantias.index')->with('error', 'Error al eliminar las cesantías: ' . $e->getMessage());
        }
    }
    
    


    public function obtenerInfoEmpleado($idEmpleado, $anio){
        try{

            $empleado = infoEmpleadoPerNomina::with(['infoEmpleadoAdminNomina', 'pagoEmpleado'])
                ->findOrFail($idEmpleado);

            $salario = $empleado->infoEmpleadoAdminNomina->SalarioEmpleadoNom;

            $diasTrabajadoAnio= $empleado->pagoEmpleado()
                                ->whereYear('FechaDePagoNom', $anio)
                                ->sum('DiasLaborados');
            

            return response()->json([
                            'nombre' => $empleado->nombreEmpleadoNom,
                            'anio' => $anio,
                            'salario' => $salario,
                            'diasTrabajados' => $diasTrabajadoAnio,
                        ]);

           

        } catch (ModelNotFoundException $e) {
                    return response()->json(['error' => 'Empleado no encontrado en la base de datos'], 404);
                } catch (Exception $e) {
                    return response()->json(['error' => 'Error al cargar los detalles del empleado'], 500);
                }

        
    }





    




}
