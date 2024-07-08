<?php

namespace App\Http\Controllers;

use App\Models\Pago_Empleado;
use App\Http\Requests\StorePago_EmpleadoRequest;
use App\Http\Requests\UpdatePago_EmpleadoRequest;
use App\Models\deduccionesempleado;
use App\Models\infoEmpleadoPerNomina;
use App\Models\pago_empleado_deducciones;
use App\Models\TipoDeduccionesNomina;
use App\Models\TipoPagoNomina;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Throwable;
use App\Mail\Nomina;
use Illuminate\Support\Facades\Mail;

class PagoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{
            
            $empleados = infoEmpleadoPerNomina::whereHas('infoEmpleadoAdminNomina', function ($query) {
                $query->where('idEstadoEmpleadoNomina', 1); // Filtrar por estado 1
            })->get();

            $tiposPago = TipoPagoNomina::all();

            $tiposdedu = TipoDeduccionesNomina::all();



            return view('Nomina.Pago.CRUD', compact('empleados', 'tiposPago', 'tiposdedu'));

        }catch(Exception $e){
            Session::flash('error', '¡Ups! Algo salió mal al cargar los pagos de los empleados: ' . $e->getMessage());
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
    public function store(StorePago_EmpleadoRequest $request)
{
    try {
        $request->validate([
            'fechaDePagoNom' => 'required|date',
            'SueldoBruto' => 'required|numeric',
            'DiasLaborados' => 'required|numeric',
            'id_EmpleadoNomina' => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
            'idTipoPagoNomina' => 'required|exists:tipo_pago_nominas,idTipoPagoNomina',
            'AuxiliodeTransporte' => 'required|numeric',
            'NumeroHoras' => 'required|numeric',
            'HorasExtras' => 'required|numeric',
            'SueldoNeto' => 'required|numeric',
            'deducciones.*.idDeduccion_EmpNom' => 'required|exists:tipo_deducciones_nominas,idTipoDeduccionesNomina',
            'deducciones.*.ValorDescuento' => 'required|numeric',
        ]);

        DB::beginTransaction();

        // Crear el pago de empleado
        $pago_empleado = Pago_Empleado::create([
            'fechaDePagoNom' => $request->fechaDePagoNom,
            'DiasLaborados' => $request->DiasLaborados,
            'SueldoBruto' => $request->SueldoBruto,
            'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
            'idTipoPagoNomina' => $request->idTipoPagoNomina,
            'AuxiliodeTransporte' => $request->AuxiliodeTransporte,
            'NumeroHoras' => $request->NumeroHoras,
            'HorasExtras' => $request->HorasExtras,
            'SueldoNeto' => $request->SueldoNeto
        ]);

        $pago_empleado = $pago_empleado->fresh('infoEmpleadoAdminNomina');

        // Acceder al nombre del empleado a través de la relación
        $name = $pago_empleado->infoEmpleadoAdminNomina->nombreEmpleadoNom;
        $cedula = $pago_empleado->infoEmpleadoAdminNomina->cedulaEmpleadoNom;

        // $cargo = $pago_empleado->infoEmpleadoAdminNomina->idEmpleadoAdmNom->infoEmpleadoAdminNomina->idCargoNomina->CargoNomina->nombreCargo;


        $deduccionesCompletas = [];
        foreach ($request->deducciones as $deduccion) {
            // Crear deducción empleado
            $deduccionEmpleado = deduccionesempleado::create([
                'id_EmpleadoNomina' => $pago_empleado->id_EmpleadoNomina,
                'idTipoDeduccionesNomina' => $deduccion['idDeduccion_EmpNom'],
                'MontoDeduccionNom' => $deduccion['ValorDescuento']
            ]);

            // Obtener nombre de la deducción
            $nombreDeduccion = TipoDeduccionesNomina::findOrFail($deduccion['idDeduccion_EmpNom'])->nombreTipoDeduccion;

            // Guardar deducción completa
            $deduccionesCompletas[] = [
                'nombre' => $nombreDeduccion,
                'ValorDescuento' => $deduccion['ValorDescuento']
            ];

            // Relacionar deducción empleado con pago empleado
            pago_empleado_deducciones::create([
                'id_PagoEmpleado' => $pago_empleado->id_PagoEmpleado,
                'idDeduccion_EmpNom' => $deduccionEmpleado->idDeduccion_EmpNom
            ]);
        }
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('Nomina.Pago.PDF', compact('pago_empleado', 'deduccionesCompletas', 'name', 'cedula'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfOutput = $dompdf->output();

        // Envía el correo electrónico con los datos completos y adjunto
        $emailEmpleado = $pago_empleado->infoEmpleadoAdminNomina->emailEmpleadoNom;
        Mail::to($emailEmpleado)->send(new Nomina($pago_empleado, $deduccionesCompletas, $pdfOutput, $name));
        

        DB::commit();

        Session::flash('success', 'Nómina creada exitosamente y correo enviado.');
        return back();

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Captura errores de validación
        DB::rollBack();
        $errors = $e->validator->errors()->all();
        Session::flash('error', 'Error de validación: ' . implode(', ', $errors));
        return back();

    } catch (QueryException $e) {
        // Captura errores de base de datos
        DB::rollBack();
        Session::flash('error', 'Error de base de datos: ' . $e->getMessage());
        return back();

    } catch (Exception $e) {
        // Captura cualquier otra excepción
        DB::rollBack();
        Session::flash('error', 'Error inesperado: ' . $e->getMessage());
        return back();
    }
}


    
    
    

    /**
     * Display the specified resource.
     */
    public function show(Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePago_EmpleadoRequest $request, Pago_Empleado $pago_Empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago_Empleado $pago_Empleado)
    {
        //
    }
}
