<?php

namespace App\Http\Controllers;

use App\Models\ClienteFactura;
use App\Http\Requests\StoreClienteFacturaRequest;
use App\Http\Requests\UpdateClienteFacturaRequest;
use App\Models\AsesorComercial;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class ClienteFacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{

            $clientes = ClienteFactura::all();
            $asesores = AsesorComercial::all();

            return view('Facturacion.Cliente.CRUD', compact('clientes', 'asesores'));


        }catch(Exception $e){

            Session::flash('error', '¡Ups! Algo salió mal al cargar los clientes: ' . $e->getMessage());
            
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
    public function store(StoreClienteFacturaRequest $request)
    {

        try{


            $request->validate([
               'idAsesorComercial' => 'required|exists:asesor_comercials,idAsesorComercial',
                'tipoDocumento' => 'required|string',
                'numeroIdentificacion' => 'required|string',
                'nombreCompleto' => 'required|string',
                'direccionCliente' => 'required|string',
                'fechaNacimientoCliente' => 'required|date',
                'telefono' => 'required|string',
                'email' => 'required|string|email',
            ]);

            ClienteFactura::create([
                'idAsesorComercial'=>$request->input('idAsesorComercial'),
                'tipoDocumento'=>$request->input('tipoDocumento'),
                'numeroIdentificacion'=>$request->input('numeroIdentificacion'),
                'nombreCompleto'=>$request->input('nombreCompleto'),
                'direccionCliente'=>$request->input('direccionCliente'),
                'fechaNacimientoCliente'=>$request->input('fechaNacimientoCliente'),
                'telefono'=>$request->input('telefono'),
                'email'=>$request->input('email'),
            ]);

            Session::flash('success', '¡El cliente se creo correctamente!');

            return back();

        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'El cliente ya esta en la base de datos. Por favor, verifica e intentalo nuevamente.');
            }elseif($e->errorInfo==1048){
                Session::flash('error', 'Hay columnas que estan enviandose vacias, comunicate con el administrador');
            }elseif($e->errorInfo==1064 || $e->errorInfo==1452){
                Session::flash('error', 'Ha sido imposible relacionar la informacion');
            }elseif($e->errorInfo==1364){
                Session::flash('error','Datos ingresados no validos, porfavor vuelve a ingresarlos');
            }else {
                Session::flash('error', '¡Ups! Algo salió mal al crear al cliente: ' . $e->getMessage());
            }

            return back();
        }catch(Exception $ex){
            Session::flash('error', '¡Ups! Algo salió mal al crear al cliente: ' . $ex->getMessage());
            return back(); 
        }

        // dd($request->all());
    }





    /**
     * Display the specified resource.
     */
    public function show(ClienteFactura $clienteFactura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClienteFactura $clienteFactura)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteFacturaRequest $request, $id_cliente)
    {
       try{ 
            
            $cliente = ClienteFactura::findOrFail($id_cliente);

            $request->validate([
                'nombreCompleto'=>'required|string',
                'direccionCliente'=>'required|string',
                'fechaNacimientoCliente'=>'required|date',
                'telefono'=>'required|string',
                'email'=>'required|string'
            ]);

            if($cliente){
                $cliente->update([
                    'nombreCompleto'=>$request->input('nombreCompleto'),
                    'direccionCliente'=>$request->input('direccionCliente'),
                    'fechaNacimientoCliente'=>$request->input('fechaNacimientoCliente'),
                    'telefono'=>$request->input('telefono'),
                    'email'=>$request->input('email'),
                    ]);
            }else{
                Session::flash('error', '¡Cliente no encontrado!');

            }

            Session::flash('succes','¡El cliente se actuliazo correctamente!');

            return back();
        }catch(Exception $e){
            Session::flash('success', '¡Ups! Algo salió mal al actualizar el cleinte.' . $e->getMessage());
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_cliente)
    {
        try{
            $cliente = ClienteFactura::findOrFail($id_cliente);
            $cliente->delete();
            Session::flash('success', '¡El cliente se elimino con exito!');
        }catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar el cliente: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar el cliente!'. $e->getMessage());
        }

        return back();

    }


    public function obtenerAsesores($idAsesorComercial){
        try{

            $asesor = AsesorComercial::findOrFail($idAsesorComercial);

          
          

            return response()->json($asesor);
    
        } catch (ModelNotFoundException $e) {
            // Retornar error 404 si no se encuentra el asesor
            return response()->json(['error' => 'Asesor no encontrado en la base de datos' , $e->getMessage()], 404);
        } catch (Exception $e) {
            // Retornar error 500 para errores generales
            return response()->json(['error' => 'Error al cargar los detalles del asesor' , $e->getMessage()], 500);
        }
    }
    





    
}
