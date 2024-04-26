<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Throwable;
use Exception;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $empleados = Empleado::all();
    
            // Mensaje de éxito personalizado
            
    
            // Guarda el mensaje de éxito en la sesión

    
            return view('Empleado.CRUD', compact('empleados'));
    
        } catch (Exception $e) {
    
            // Mensaje de error personalizado
            $alert = [
                'type' => 'error',
                'message' => '¡Ups! Algo salió mal al cargar los empleados.'
            ];
    
            return view('error_page', compact('alert'));
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
    public function store(StoreEmpleadoRequest $request)
    {
        try{

            $request->validate([
                'tipoDocumentoempleado' => 'required|string',
                'idEmpleado' => 'required|string',
                'nombreEmpleado' => 'required|string',
                'apellidoEmpleado' => 'required|string', 
            ]);
            

            Empleado::create([
                'tipoDocumentoempleado'=>$request->input('tipoDocumentoempleado'),
                'idEmpleado'=>$request->input('idEmpleado'),
                'nombreEmpleado'=>$request->input('nombreEmpleado'),
                'apellidoEmpleado'=>$request->input('apellidoEmpleado'),
            ]);

            Session::flash('success', '¡El empleado se creó correctamente!');


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
    public function show($idEmpleado)
    {
        try{
            //si  no lo encuentra,lanza exception osea va al catch
            $empleadoInfo = Empleado::findOrFail($idEmpleado);
            
            $alert = [
                'type' => 'success',
                'message' => '¡Empleado enocntrado correctamente!'
            ];

            return view('Empleado.CRUD', compact('empleadoInfo', 'alert'));

        }catch(Exception $e){
            
            $alert = [
                'type' => 'error',
                'message' => '¡Ups! Algo salió mal al buscar el empleado.'
            ];
    
            return back()->with($alert);
    
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idEmpleado)
    {
        try{
            //si  no lo encuentra,lanza exception osea va al catch
            $empleadoInfo = Empleado::findOrFail($idEmpleado);
            
            $alert = [
                'type' => 'success',
                'message' => '¡Empleado encontrado correctamente, listo para editar!'
            ];

            return view('Empleado.CRUD', compact('empleadoInfo', 'alert'));

        }catch(Exception $e){
            
            $alert = [
                'type' => 'error',
                'message' => '¡Ups! Algo salió mal al buscar el empleado, no es posible editarlo.'
            ];
    
            return back()->with($alert);
    
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpleadoRequest $request, $idEmpleado)
    {
        try{
            // Busca el empleado en la base de datos. Si no se encuentra, el método find() retorna null.
            $empleado = Empleado::find($idEmpleado);

            // Valida los datos de entrada.
            $request->validate([
                'tipoDocumentoempleado' => 'required|string',
                'idEmpleado' => 'required|string',
                'nombreEmpleado' => 'required|string',
                'apellidoEmpleado' => 'required|string', 
            ]);

            // Si el empleado se encuentra, actualiza sus datos.
            if ($empleado) {
                $empleado->update([
                    'tipoDocumentoempleado' => $request->input('tipoDocumentoempleado'),
                    'idEmpleado' => $request->input('idEmpleado'),
                    'nombreEmpleado' => $request->input('nombreEmpleado'),
                    'apellidoEmpleado' => $request->input('apellidoEmpleado'),
                ]);

                $alert = [
                    'type' => 'success',
                    'message' => '¡Empleado actualizado correctamente!'
                ];

                return view('Empleado.CRUD', compact('empleado', 'alert'));
            } else {

                $alert = [
                    'type' => 'error',
                    'message' => 'Empleado no encontrado.'
                ];

                // Retorna a la página anterior con el mensaje de error.
                return back()->with($alert);
            }
        } catch(Exception $e){
            // Si ocurre una excepción, define un mensaje de error.
            $alert = [
                'type' => 'error',
                'message' => '¡Ups! Algo salió mal al actualizar el empleado.'
            ];

            // Retorna a la página anterior con el mensaje de error.
            return back()->with($alert);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($numeroEmpleado)
    {
        try {
            $empleado = Empleado::findOrFail($numeroEmpleado);
            $empleado->delete();
            Session::flash('success', '¡El empleado se eliminó correctamente!');
        } catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar el empleado: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar el empleado!'. $e->getMessage());
        }
    
        return back();
    }
    

}
