<?php

namespace App\Http\Controllers;

use App\Models\CargoNomina;
use App\Http\Requests\StoreCargoNominaRequest;
use App\Http\Requests\UpdateCargoNominaRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Throwable;

class CargoNominaController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargoNominaRequest $request)
    {
        try{
            $request->validate([
                'nombreCargo'
            ]);

            CargoNomina::create([
                'nombreCargo'=>$request->input('nombreCargo')
            ]);

            Session::flash('success', '¡El cargo fue creado exitosamente!');

            return back();
            
        }catch(QueryException $e){
            if ($e->errorInfo[1] == 1062) { // El código de error 1062 indica un duplicado de clave única
                Session::flash('error', 'El número de identificación ya está en uso. Por favor, verifica e intentalo nuevamente.');
            } else {
                Session::flash('error', '¡Ups! Algo salió mal al crear el cargo para la nomina: ' . $e->getMessage());
            }
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CargoNomina $cargoNomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idCargoNomina)
    {
        try{

            $cargo= CargoNomina::findOrFail($idCargoNomina);
            return view('Nomina.Empleado.CRUD');
        }catch(Exception $e){

            Session::flash('error', '¡El cargo no fue encontrado dentro la base de datos, no es posible editarlo!');

            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargoNominaRequest $request, $idCargoNomina)
    {
        try {
            // Buscar el cargo por ID o lanzar una excepción si no se encuentra
            $cargo = CargoNomina::findOrFail($idCargoNomina);

            // Validar los datos del request
            $request->validate([
                'nombreCargo' => 'required|string|max:255',
            ]);

            if($cargo){

                $cargo->update([
                    'nombreCargo' => $request->input('nombreCargo')
                ]);

            }else{
                Session::flash('error', '¡Cargo no encontrado!');
            }
           

            Session::flash('success', '¡El cargo fue editado exitosamente!');

            // Retornar a la vista deseada con el cargo actualizado
            return back();
        } catch (Exception $e) {
            // Mostrar mensaje de error
            Session::flash('error', '¡El cargo no encontrado! ' . $e->getMessage());

            // Redirigir de vuelta con los datos anteriores
            return back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCargoNomina)
    {
        try {
            $cargo = CargoNomina::findOrFail($idCargoNomina);
            $cargo->delete();
            Session::flash('success', '¡El cargo se eliminó correctamente!');
        } catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar el cargo: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar el cargo: ' . $e->getMessage());
        }

        return redirect()->back();
    }

}
