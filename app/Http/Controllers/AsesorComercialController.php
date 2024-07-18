<?php

namespace App\Http\Controllers;

use App\Models\AsesorComercial;
use App\Http\Requests\StoreAsesorComercialRequest;
use App\Http\Requests\UpdateAsesorComercialRequest;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class AsesorComercialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $asesor = AsesorComercial::all();

            return view('Facturacion.Asesor.CRUD');
        }catch(Exception $e){
            Session::flash('error', '¡Ups! Algo salió mal al cargar los asesores: ' . $e->getMessage());
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
    public function store(StoreAsesorComercialRequest $request)
    {
        try{

            $request->validate([
                'nombreAsesor'=>'required|string',
                'apellidoAsesor'=>'required|string',
                'telefonoAsesor'=>'required|string',
                'emailAsesor'=>'required|string',
                'estadoAsesor'=>'required|string'
            ]);

            AsesorComercial::create([
                'nombreAsesor'=>$request->input('nombreAsesor'),
                'apellidoAsesor'=>$request->input('apellidoAsesor'),
                'telefonoAsesor'=>$request->input('telefonoAsesor'),
                'emailAsesor'=>$request->input('emailAsesor'),
                'estadoAsesor'=>$request->input('estadoAsesor'),
            ]);

            Session::flash('success', '¡El asesor se creo correctamente!');

            return back();

        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'El asesor ya esta en la base de datos. Por favor, verifica e intentalo nuevamente.');
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
    }

    /**
     * Display the specified resource.
     */
    public function show(AsesorComercial $asesorComercial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AsesorComercial $asesorComercial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsesorComercialRequest $request, AsesorComercial $asesorComercial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AsesorComercial $asesorComercial)
    {
        //
    }



    
}
