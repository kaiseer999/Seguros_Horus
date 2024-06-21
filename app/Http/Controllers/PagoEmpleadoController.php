<?php

namespace App\Http\Controllers;

use App\Models\Pago_Empleado;
use App\Http\Requests\StorePago_EmpleadoRequest;
use App\Http\Requests\UpdatePago_EmpleadoRequest;
use App\Models\infoEmpleadoPerNomina;
use App\Models\pago_empleado_deducciones;
use App\Models\TipoDeduccionesNomina;
use App\Models\TipoPagoNomina;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Throwable;

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
        /*
        try{
            
            $request->validate([
                'fechaDePagoNom' => 'required|date',
                'SueldoBruto' => 'required|numeric',
                'DiasLaborados' => 'required|numeric',
                'id_EmpleadoNomina' => 'required|exists:info_empleado_per_nominas,id_EmpleadoNomina',
                'idTipoPagoNomina' => 'required|exists:tipo_pago_nominas,idTipoPagoNomina',
                'AuxiliodeTransporte' => 'required|numeric',
                'HorasExtras' => 'required|numeric',
                'SueldoNeto' => 'required|numeric',
                'idDeduccion_EmpNom1' => 'required|exists:tipo_deducciones_nominas,idDeduccion_EmpNom',
                'idDeduccion_EmpNom2' => 'required|exists:tipo_deducciones_nominas,idDeduccion_EmpNom',
                'idDeduccion_EmpNom3' => 'required|exists:tipo_deducciones_nominas,idDeduccion_EmpNom',
                'idDeduccion_EmpNom4' => 'required|exists:tipo_deducciones_nominas,idDeduccion_EmpNom'
            ]);
    
            DB::beginTransaction();
    
            $pago_empleado = Pago_Empleado::create([
                'fechaDePagoNom' => $request->fechaDePagoNom,
                'DiasLaborados' => $request->DiasLaborados,
                'SueldoBruto' => $request->SueldoBruto,
                'id_EmpleadoNomina' => $request->id_EmpleadoNomina,
                'idTipoPagoNomina' => $request->idTipoPagoNomina,
                'AuxiliodeTransporte' => $request->AuxiliodeTransporte,
                'HorasExtras' => $request->HorasExtras,
                'SueldoNeto' => $request->SueldoNeto
            ]);
    
            $deducciones = [
                'idDeduccion_EmpNom1',
                'idDeduccion_EmpNom2',
                'idDeduccion_EmpNom3',
                'idDeduccion_EmpNom4'
            ];
    
            $deduccionesData = [];
            foreach ($deducciones as $deduccion) {
                $deduccionRecord = pago_empleado_deducciones::create([
                    'id_PagoEmpleado' => $pago_empleado->id_PagoEmpleado,
                    'idDeduccion_EmpNom' => $request->input($deduccion)
                ]);
                $deduccionesData[] = $deduccionRecord;
            }
    
            DB::commit();
    
          //  $empleadoNomina = InfoEmpleadoPerNomina::findOrFail($request->id_EmpleadoNomina);
          //  $SalarioNomina = 


            // Preparar los datos para la vista del PDF
         /*   $datosParaPdf = [
                'pago_empleado' => $pago_empleado,
                'deducciones' => $deduccionesData
            ];
    
            // Generar el PDF
           // $pdf = Pdf::loadView('Nomina.Pago.PDF', $datosParaPdf);
    
            // Si deseas enviar el PDF por correo electrónico
            // Mail::to($correoDestino)->send(new NominaPdf($pdf->output()));
    
            // Retornar el PDF para que el usuario lo descargue o lo vea en el navegador
            return $pdf->stream('recibo_nomina.pdf');

            */
         /*   Session::flash('success', 'Nomina creada exitosamente!');

            return back();

        }catch(Exception $e){

            Session::flash('error', '¡Ups! Algo salió mal al crear la nomina: ' . $e->getMessage());

            return back();

        }
        */

        dd($request->all());

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
