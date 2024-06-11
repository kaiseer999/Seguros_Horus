<?php

namespace App\Http\Controllers;

use App\Models\infoEmpleadoPerNomina;
use App\Models\CargoNomina;
use App\Models\TipoDeduccionesNomina;
use App\Models\estados_EmpleadoNomina;


use App\Http\Requests\StoreinfoEmpleadoPerNominaRequest;
use App\Http\Requests\UpdateinfoEmpleadoPerNominaRequest;
use App\Http\Controllers\CargoNominaController;
use App\Models\EstadoCivilNomina;
use App\Models\infoEmpleadoAdminNomina;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Mail\notificacion;
use Illuminate\Support\Facades\Mail;

use Throwable;


class InfoEmpleadoPerNominaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $cargos= CargoNomina::all();
            $tdeducciones = TipoDeduccionesNomina::all();
            $estadociviles = EstadoCivilNomina::all();
            $estadosempl = estados_EmpleadoNomina::all();
            $empleados = infoEmpleadoPerNomina::with([
                'infoEmpleadoAdminNomina', 
                'infoEmpleadoAdminNomina.CargoNomina', 
                'infoEmpleadoAdminNomina.estados_EmpleadoNomina',
                'EstadoCivilNomina'
            ])->get();
            




            return view('Nomina.Empleado.CRUD', compact('cargos', 'tdeducciones', 
            'estadociviles', 'estadosempl', 'empleados'));

        }catch(Exception $e){

            Session::flash('error', '¡Ups! Algo salió mal al cargar los cargos: ' . $e->getMessage());

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
    public function store(StoreinfoEmpleadoPerNominaRequest $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'fechaIngresoEmpleadoNom' => 'required|date',
                'idCargoNomina' => 'required|exists:cargo_nominas,idCargoNomina',
                'idEstadoEmpleadoNomina' => 'required|exists:estados_empleado_nominas,idEstadoEmpleadoNomina',
                'cedulaEmpleadoNom' => 'required|string',
                'nombreEmpleadoNom' => 'required|string',
                'direccionEmpleadoNom' => 'required|string',
                'sexoEmpleadoNom' => 'required|string',
                'idEstadoCivilNomina' => 'required|exists:estado_civil_nominas,idEstadoCivilNomina',
                'fechaNacEmpleadoNom' => 'required|date',
                'emailEmpleadoNom' => 'required|string',
                'telefonoEmpleadoNom' => 'required|string'
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Guardar los datos en la tabla infoEmpleadoAdminNomina
            $infoadminempleado = InfoEmpleadoAdminNomina::create([
                'fechaIngresoEmpleadoNom' => $request->fechaIngresoEmpleadoNom,
                'idCargoNomina' => $request->idCargoNomina,
                'idEstadoEmpleadoNomina' => $request->idEstadoEmpleadoNomina,
            ]);

            // Guardar los datos en la tabla infoEmpleadoPerNomina
            infoEmpleadoPerNomina::create([
                'idEmpleadoAdmNom' => $infoadminempleado->idEmpleadoAdmNom,
                'cedulaEmpleadoNom' => $request->cedulaEmpleadoNom,
                'nombreEmpleadoNom' => $request->nombreEmpleadoNom,
                'direccionEmpleadoNom' => $request->direccionEmpleadoNom,
                'sexoEmpleadoNom' => $request->sexoEmpleadoNom,
                'idEstadoCivilNomina' => $request->idEstadoCivilNomina,
                'fechaNacEmpleadoNom' => $request->fechaNacEmpleadoNom,
                'emailEmpleadoNom' => $request->emailEmpleadoNom,
                'telefonoEmpleadoNom' => $request->telefonoEmpleadoNom
            ]);

            // Confirmar la transacción
            DB::commit();

            Mail::to($request->emailEmpleadoNom)->send(new Notificacion($request->nombreEmpleadoNom, 'Bienvenido a la empresa'));


            Session::flash('success', '¡Empleado guardado exitosamente!');
            return back();

        } catch (QueryException $e) {
            // Manejo de excepciones específicas de la base de datos
            switch ($e->errorInfo[1]) {
                case 1062:
                    Session::flash('error', 'El empleado ya está en la base de datos. Por favor, verifica e intentalo nuevamente.');
                    break;
                case 1048:
                    Session::flash('error', 'Hay columnas que están enviándose vacías, comunícate con el administrador.');
                    break;
                case 1064:
                case 1452:
                    Session::flash('error', 'Ha sido imposible relacionar la información.');
                    break;
                case 1364:
                    Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.');
                    break;
                default:
                    Session::flash('error', '¡Ups! Algo salió mal al crear la incapacidad: ' . $e->getMessage());
                    break;
            }
            return back();

        } catch (Exception $ex) {
            Session::flash('error', '¡Ups! Algo salió mal al crear el empleado: ' . $ex->getMessage());
            return back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinfoEmpleadoPerNominaRequest $request, $id_EmpleadoNomina)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'fechaIngresoEmpleadoNom' => 'required|date',
                'idCargoNomina' => 'required|exists:cargo_nominas,idCargoNomina',
                'idEstadoEmpleadoNomina' => 'required|exists:estados_empleado_nominas,idEstadoEmpleadoNomina',
                'cedulaEmpleadoNom' => 'required|string',
                'nombreEmpleadoNom' => 'required|string',
                'direccionEmpleadoNom' => 'required|string',
                'sexoEmpleadoNom' => 'required|string',
                'idEstadoCivilNomina' => 'required|exists:estado_civil_nominas,idEstadoCivilNomina',
                'fechaNacEmpleadoNom' => 'required|date',
                'emailEmpleadoNom' => 'required|string',
                'telefonoEmpleadoNom' => 'required|string'
            ]);

            // Iniciar una transacción
            DB::beginTransaction();

            // Actualizar los datos en la tabla infoEmpleadoAdminNomina
            $infoadminempleado = InfoEmpleadoAdminNomina::findOrFail($id_EmpleadoNomina);
            $infoadminempleado->update([
                'fechaIngresoEmpleadoNom' => $request->fechaIngresoEmpleadoNom,
                'idCargoNomina' => $request->idCargoNomina,
                'idEstadoEmpleadoNomina' => $request->idEstadoEmpleadoNomina,
            ]);

            // Actualizar los datos en la tabla infoEmpleadoPerNomina
            $infoempleadopersonal = infoEmpleadoPerNomina::where('idEmpleadoAdmNom', $id_EmpleadoNomina)->firstOrFail();
            $infoempleadopersonal->update([
                'cedulaEmpleadoNom' => $request->cedulaEmpleadoNom,
                'nombreEmpleadoNom' => $request->nombreEmpleadoNom,
                'direccionEmpleadoNom' => $request->direccionEmpleadoNom,
                'sexoEmpleadoNom' => $request->sexoEmpleadoNom,
                'idEstadoCivilNomina' => $request->idEstadoCivilNomina,
                'fechaNacEmpleadoNom' => $request->fechaNacEmpleadoNom,
                'emailEmpleadoNom' => $request->emailEmpleadoNom,
                'telefonoEmpleadoNom' => $request->telefonoEmpleadoNom
            ]);

            // Confirmar la transacción
            DB::commit();

            Session::flash('success', '¡Empleado actualizado exitosamente!');
            return back();

        } catch (QueryException $e) {
            // Manejo de excepciones específicas de la base de datos
            DB::rollBack();

            switch ($e->errorInfo[1]) {
                case 1062:
                    Session::flash('error', 'El empleado ya está en la base de datos. Por favor, verifica e intentalo nuevamente.');
                    break;
                case 1048:
                    Session::flash('error', 'Hay columnas que están enviándose vacías, comunícate con el administrador.');
                    break;
                case 1064:
                case 1452:
                    Session::flash('error', 'Ha sido imposible relacionar la información.');
                    break;
                case 1364:
                    Session::flash('error', 'Datos ingresados no válidos, por favor vuelve a ingresarlos.');
                    break;
                default:
                    Session::flash('error', '¡Ups! Algo salió mal al actualizar el empleado: ' . $e->getMessage());
                    break;
            }
            return back()->withInput();

        } catch (Exception $ex) {
            DB::rollBack();
            Session::flash('error', '¡Ups! Algo salió mal al actualizar el empleado: ' . $ex->getMessage());
            return back()->withInput();
        }
    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(infoEmpleadoPerNomina $infoEmpleadoPerNomina)
    {
        //
    }
}
