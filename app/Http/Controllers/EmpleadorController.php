<?php

namespace App\Http\Controllers;

use App\Models\Empleador;
use App\Http\Requests\StoreEmpleadorRequest;
use App\Http\Requests\UpdateEmpleadorRequest;

class EmpleadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleadores= Empleador::all();

        return view("Empleador.CRUD", compact('empleadores'));
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
    public function store(StoreEmpleadorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleador $empleador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleador $empleador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadorRequest $request, Empleador $empleador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleador $empleador)
    {
        //
    }
}
