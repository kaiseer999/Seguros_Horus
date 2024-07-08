<?php

namespace App\Http\Controllers;

use App\Models\VacacionesEmpleado;
use App\Http\Requests\StoreVacacionesEmpleadoRequest;
use App\Http\Requests\UpdateVacacionesEmpleadoRequest;

class VacacionesEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Nomina.Vacaciones.CRUD');
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
        //
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
    public function update(UpdateVacacionesEmpleadoRequest $request, VacacionesEmpleado $vacacionesEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VacacionesEmpleado $vacacionesEmpleado)
    {
        //
    }
}
