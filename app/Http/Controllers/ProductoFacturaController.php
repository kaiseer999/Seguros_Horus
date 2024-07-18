<?php

namespace App\Http\Controllers;

use App\Models\ProductoFactura;
use App\Http\Requests\StoreProductoFacturaRequest;
use App\Http\Requests\UpdateProductoFacturaRequest;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class ProductoFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('Facturacion.Factura.CreateProducto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoFacturaRequest $request)
    {

        try{
            $request->validate([
                'nombreProducto'=>'required|string',
                'precioProducto'=>'required|numeric'
            ]);

            ProductoFactura::create([
                'nombreProducto'=>$request->input('nombreProducto'),
                'precioProducto'=>$request->input('precioProducto'),
            ]);


            Session::flash('success', '¡El producto se creó correctamente! Puedes cerrar esta ventana si no deseas crear más productos, o continuar si lo necesitas.');

            return redirect()->back(); 


        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'El producto ya esta en la base de datos. Por favor, verifica e intentalo nuevamente.');
            }elseif($e->errorInfo==1048){
                Session::flash('error', 'Hay columnas que estan enviandose vacias, comunicate con el administrador');
            }elseif($e->errorInfo==1064 || $e->errorInfo==1452){
                Session::flash('error', 'Ha sido imposible relacionar la informacion');
            }elseif($e->errorInfo==1364){
                Session::flash('error','Datos ingresados no validos, porfavor vuelve a ingresarlos');
            }else {
                Session::flash('error', '¡Ups! Algo salió mal al crear al producto: ' . $e->getMessage());
            }

            return back();
        }catch(Exception $ex){
            Session::flash('error', '¡Ups! Algo salió mal al crear al producto: ' . $ex->getMessage());
            return back(); 
        }






        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductoFactura $productoFactura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductoFactura $productoFactura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoFacturaRequest $request, ProductoFactura $productoFactura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductoFactura $productoFactura)
    {
        //
    }
}
