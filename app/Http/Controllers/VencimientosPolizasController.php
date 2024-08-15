<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\vencimientosPolizas;
use App\Http\Requests\StorevencimientosPolizasRequest;
use App\Http\Requests\UpdatevencimientosPolizasRequest;
use App\Models\categoriaProducto;
use App\Models\ClienteFactura;
use App\Models\DetalleFactura;
use App\Models\FormasPago;
use App\Models\ProductoFactura;

class VencimientosPolizasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catsProducto = categoriaProducto::all();
        $productos = ProductoFactura::all();
        $clientes = ClienteFactura::all();
        $formas = FormasPago::all();
        $vencimientos = vencimientosPolizas::all();
        
        return view('Facturacion.Vencimiento.CRUD', compact('vencimientos','productos', 'clientes', 'catsProducto', 'formas'));
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
    public function store(StorevencimientosPolizasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(vencimientosPolizas $vencimientosPolizas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vencimientosPolizas $vencimientosPolizas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevencimientosPolizasRequest $request, vencimientosPolizas $vencimientosPolizas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vencimientosPolizas $vencimientosPolizas)
    {
        //
    }
}
