<?php

namespace App\Http\Controllers;

use App\Models\categoriaProducto;
use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Models\ClienteFactura;
use App\Models\ProductoFactura;
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
        return view('Facturacion.Factura.CRUD', compact('productos', 'clientes', 'catsProducto'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catsProducto = categoriaProducto::all();
        $productos = ProductoFactura::all();
        $clientes = ClienteFactura::all();
        return view('Facturacion.Factura.CreateFactura', compact('productos', 'clientes', 'catsProducto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFacturaRequest $request)
    {
        //
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
