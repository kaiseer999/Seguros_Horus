<?php

namespace App\Http\Controllers;

use App\Models\infoEmpleadoPerNomina;
use App\Models\CargoNomina;
use App\Models\TipoDeduccionesNomina;


use App\Http\Requests\StoreinfoEmpleadoPerNominaRequest;
use App\Http\Requests\UpdateinfoEmpleadoPerNominaRequest;
use App\Http\Controllers\CargoNominaController;
use App\Models\EstadoCivilNomina;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Throwable;


class InfoEmpleadoPerNominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $cargos= CargoNomina::all();
            $tdeducciones = TipoDeduccionesNomina::all();
            $estadociviles = EstadoCivilNomina::all();

            return view('Nomina.Empleado.CRUD', compact('cargos', 'tdeducciones', 'estadociviles'));

        }catch(Exception $e){

            Session::flash('error', '¡Ups! Algo salió mal al cargar los cargos: ' . $e->getMessage());

            return back();
        }
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
    public function store(StoreinfoEmpleadoPerNominaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinfoEmpleadoPerNominaRequest $request, infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }
}
