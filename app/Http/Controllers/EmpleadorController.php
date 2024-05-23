<?php

namespace App\Http\Controllers;

use App\Models\Empleador;
use App\Http\Requests\StoreEmpleadorRequest;
use App\Http\Requests\UpdateEmpleadorRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Exception;

class EmpleadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{
            
        $empleadores= Empleador::all();

        return view("Empleador.CRUD", compact('empleadores'));

        }catch(Exception $e){

            Session::flash('error', '¡Ups! Algo salió mal al crear el empleado: ' . $e->getMessage());
            
        }


    }

    public function __construct()
    {
        $this->middleware('auth');
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
        try{
            $request->validate([
                'nombreEmpleador'=>'required|string',
            ]);

            Empleador::create([
                'nombreEmpleador'=>$request->input('nombreEmpleador'),
            ]);

            Session::flash('success', '¡El empleador se creó correctamente!');

            return back();



        }catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // El código de error 1062 indica un duplicado de clave única
                Session::flash('error', 'El número de identificación ya está en uso. Por favor, verifica e intentalo nuevamente.');
            } else {
                Session::flash('error', '¡Ups! Algo salió mal al crear el empleado: ' . $e->getMessage());
            }
            return back();
        }

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
    public function update(UpdateEmpleadorRequest $request, $numeroEmpleador)
    {
        try{

            $empleador = Empleador::findOrFail($numeroEmpleador);

            $request->validate([
                'nombreEmpleador'=>'required|string',
            ]);

            if($empleador){
                $empleador->update([
                    'nombreEmpleador'=>$request->input('nombreEmpleador')
                ]);
            }else{
                Session::flash('error', '¡Empleador no encontrado!');

            }

            Session::flash('success', '¡El empleador se actualizo correctamente!');

            return back();
            
        }catch(Exception $e){
            Session::flash('success', '¡Ups! Algo salió mal al actualizar el empleador.');

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($numeroEmpleador)
    {
        try{
            $empleador=  Empleador::findOrFail($numeroEmpleador);
            $empleador->delete();
            Session::flash('success', '¡El empleador se eliminó correctamente!');
        } catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar el empleador: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar el empleador!'. $e->getMessage());
        }
    
        return back();
    }
}
