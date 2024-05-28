<?php

namespace App\Http\Controllers;

use App\Models\infoEmpleadoPerNomina;
use App\Http\Requests\StoreinfoEmpleadoPerNominaRequest;
use App\Http\Requests\UpdateinfoEmpleadoPerNominaRequest;

class InfoEmpleadoPerNominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Nomina.Empleado.CRUD');
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
