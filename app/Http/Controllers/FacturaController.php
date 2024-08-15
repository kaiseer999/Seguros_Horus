<?php

namespace App\Http\Controllers;

use App\Models\categoriaProducto;
use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Models\ClienteFactura;
use App\Models\DetalleFactura;
use App\Models\FormasPago;
use App\Models\PagosFactura;
use App\Models\ProductoFactura;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Exception;

class FacturaController extends Controller
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
        return view('Facturacion.Factura.CRUD', compact('productos', 'clientes', 'catsProducto', 'formas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catsProducto = categoriaProducto::all();
        $productos = ProductoFactura::all();
        $clientes = ClienteFactura::all();
        $formas = FormasPago::all();
        return view('Facturacion.Factura.CreateFactura', compact('productos', 'clientes', 'catsProducto', 'formas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        try {
            $request->validate([
                'fecha_Pago' => 'required|date',
                'fecha_Vencimiento' => 'required|date',
                'codigoProducto' => 'required|exists:producto_facturas,codigoProducto',
                'id_cliente' => 'required|exists:clientes_facturas,id_cliente',
                'FormaPago' => 'required|exists:formas_pagos,idFormaPago',
                'precioProducto' => 'required|numeric',
                'Observacion' => 'required|string',
            ]);
        
            DB::beginTransaction(); // Inicia la transacción
        
            $factura = Factura::create([
                'id_cliente' => $request->id_cliente,
                'fecha_pago' => $request->fecha_Pago,
                'fecha_Vencimiento' => $request->fecha_Vencimiento,
                'valorOriginal' => $request->precioProducto,
                'valorFinal'=> $request->precioProducto
            ]);
        
            $detalle = DetalleFactura::create([
                'idFactura' => $factura->idFactura,
                'codigoProducto' => $request->codigoProducto,
                'precioPagarProducto' => $request->precioProducto,
                'cantidadProducto' => 1,
                'Observaciones' => $request->Observacion,
                'totalFactura' => $request->precioProducto          
            ]);

            $pago = PagosFactura::create([
                'idFactura' => $factura->idFactura,
                'idFormaPago'=>$request->FormaPago,
                'valorPagado'=>$request->precioProducto
            ]);
        
            DB::commit(); // Confirma la transacción
        
            Session::flash('success', '¡La factura se creó correctamente!');
        
            return back();
            
        } catch (\Exception $e) {
            DB::rollBack(); // Revierte la transacción en caso de error
        
            // Registro del error en el log
            // Log::error('Error al crear la factura: ' . $e->getMessage());
            
            // Redirección con un mensaje de error
            Session::flash('error', 'Hubo un problema al crear la factura. Por favor, inténtelo de nuevo. Error: ' . $e->getMessage());
        
            return back();
        }
        
        




        // return dd($request->all());
    }

    public function test(){
        return view('Facturacion.Factura.FacturaMail');
    }


    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }


    public function obtenerProductoCategoria($idcategoriaProducto){
        try{

            $productoxCategoria = ProductoFactura::where('idCategoriaProducto', $idcategoriaProducto)->get();


            return response()->json($productoxCategoria);

        }catch(Exception $e){
            return response()->json($e->getMessage());

        }
    }

    public function obtenerDetallesProducto($codigoProducto){

        try{

            $producto = ProductoFactura::findOrFail($codigoProducto);

            return response()->json($producto);


        }catch(Exception $e){
            return response()->json($e->getMessage());
        }

    }





    // public function obtenerPrimaSemestral($id_EmpleadoNomina, $anio, $periodo)
    // {
    //     try {
    //         // Obtener la información del empleado
    //         $empleado = infoEmpleadoPerNomina::with(['infoEmpleadoAdminNomina', 'pagoEmpleado'])
    //             ->findOrFail($id_EmpleadoNomina);
    
    //         // Salario del empleado
    //         $salario = $empleado->infoEmpleadoAdminNomina->SalarioEmpleadoNom;
    
    //         if ($periodo == 'primer_semestre') {
    //             // Obtener los días trabajados de enero a junio del año especificado
    //             $diasTrabajados = $empleado->pagoEmpleado()
    //                 ->whereYear('FechaDePagoNom', $anio)
    //                 ->whereBetween('FechaDePagoNom', ["$anio-01-01", "$anio-06-30"])
    //                 ->sum('DiasLaborados');
    
    //             $diasTrabajados = min($diasTrabajados, 180);
    //         } else if ($periodo == 'segundo_semestre') {
    //             // Obtener los días trabajados de julio a diciembre del año especificado
    //             $diasTrabajados = $empleado->pagoEmpleado()
    //                 ->whereYear('FechaDePagoNom', $anio)
    //                 ->whereBetween('FechaDePagoNom', ["$anio-07-01", "$anio-12-31"])
    //                 ->sum('DiasLaborados');
    
    //             $diasTrabajados = min($diasTrabajados, 180);
    //         } else {
    //             return response()->json(['error' => 'Período no válido'], 400);
    //         }
    
    //         return response()->json([
    //             'nombre' => $empleado->nombreEmpleadoNom,
    //             'anio' => $anio,
    //             'salario' => $salario,
    //             'diasTrabajados' => $diasTrabajados,
    //         ]);
    
    //     } catch (ModelNotFoundException $e) {
    //         return response()->json(['error' => 'Empleado no encontrado en la base de datos'], 404);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => 'Error al cargar los detalles del empleado'], 500);
    //     }
    // }
    


















}
