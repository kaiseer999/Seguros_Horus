<?php

namespace App\Http\Controllers;

use App\Models\Pago_Empleado;
use App\Http\Requests\StorePago_EmpleadoRequest;
use App\Http\Requests\UpdatePago_EmpleadoRequest;

class PagoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Nomina.Pago.CRUD');
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
    public function store(StorePago_EmpleadoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePago_EmpleadoRequest $request, Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago_Empleado $pago_Empleado)
    {
        //
    }
}
