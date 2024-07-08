<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Cruce;
use App\Models\Incapacidade;
use App\Models\Empleado;
use App\Models\Empleador;
use App\Http\Requests\StoreCruceRequest;
use App\Http\Requests\UpdateCruceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Throwable;
use Validator;





class CruceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ids_a_filtrar = [6,3,1]; 

        // Consultar las incapacidades excluyendo aquellas que tengan los estados que deseas filtrar
        $incapacidades = Incapacidade::with('empleado','empleadors')
            ->whereNotIn('idEstadoInc', $ids_a_filtrar)
            ->get();
            $cruces = Cruce::with('incapacidade.empleado')->get();



        return view("Cruce.CRUD", compact('incapacidades', 'cruces'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pdf(){


        $fechaActual = Carbon::now()->format('d  F  Y');
        $cruces= Cruce::all();
        $pdf = Pdf::loadView('Cruce.PDF');
        return $pdf->stream('recibo_nomina.pdf');
    
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
    public function store(StoreCruceRequest $request)
    {
        // Imprimir todos los datos del formulario
       // return $request->all();
        
        try{

           
            $nomPago=null;
            $user_id = Auth::id();
            $ruta = $user_id;

            if ($request->hasFile('PagoEPS')) {
                $documento = $request->file('PagoEPS');
                $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                $nomPago = $documento->storeAs($ruta, $nomDocumento, 'public');
            }
            
            if ($request->hasFile('PagoCruce')) {
                $documento = $request->file('PagoCruce');
                $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                $nomPagocruce = $documento->storeAs($ruta, $nomDocumento, 'public');
            }

            $cruce= new Cruce();

            $cruce->idIncapacidades = $request->input('idIncapacidades');
            $cruce->valorIncapacidad = $request->input('valorIncapacidad');
            $cruce->valorCruce= $request->input('valorCruce');
            $cruce->saldoCruce = $request->input('saldoCruce');
            $cruce->PagoEPS=!empty($nomPago) ?json_encode($nomPago):null;
            $cruce->PagoCruce=!empty($nomPagocruce) ?json_encode($nomPagocruce):null;
            $cruce->Observaciones= $request->input('Observaciones');

            $cruce->save();

            $incapacidad = Incapacidade::findOrFail($request->input('idIncapacidades'));
            $incapacidad-> idEstadoInc = 6;
            $incapacidad->save();

            
            Session::flash('success', '¡El cruce se creó correctamente!');

            return back();
            
        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'La incapacidad ya esta en la base de datos. Por favor, verifica e intentalo nuevamente.');
            }elseif($e->errorInfo==1048){
                Session::flash('error', 'Hay columnas que estan enviandose vacias, comunicate con el administrador');
            }elseif($e->errorInfo==1064 || $e->errorInfo==1452){
                Session::flash('error', 'Ha sido imposible relacionar la informacion');
            }elseif($e->errorInfo==1364){
                Session::flash('error','Datos ingresados no validos, porfavor vuelve a ingresarlos');
            }else {
                Session::flash('error', '¡Ups! Algo salió mal al crear la incapacidad: ' . $e->getMessage());
            }

            return back();
        }catch(Exception $ex){
            Session::flash('error', '¡Ups! Algo salió csacmal al crear la incapacidad: ' . $ex->getMessage());
            return back(); 
        }


    }
    

    /**
     * Display the specified resource.
     */
    public function show(Cruce $cruce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cruce $cruce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCruceRequest $request, $idCruce)
    {                

        try{
            $cruce = Cruce::findOrFail($idCruce);

            $request->validate([
                'valorIncapacidad' => 'required|numeric',
                'valorCruce' => 'required|numeric',
                'saldoCruce' => 'required|numeric',
                'PagoEPS.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'PagoCruce.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'Observaciones' => 'string|max:256',
            ]);

            if($cruce){

                $cruce->update([
                    'valorIncapacidad'=>request('valorIncapacidad'),
                    'valorCruce'=>request('valorCruce'),
                    'saldoCruce'=>request('saldoCruce'),
                    'Observaciones'=>request('Observaciones')
                ]);




           





            
            $user_id = Auth::id();
            $ruta = $user_id;
            
            if ($request->hasFile('PagoEPS')) {
                $documento = $request->file('PagoEPS');
                $nomdoc = time() . '_' . $documento->getClientOriginalName();
                $pagoeps = $documento->storeAs($ruta, $nomdoc, 'public');
            
                // Eliminar archivo anterior si existe
                $rutaArchivo = storage_path('app/public/' . $ruta . '/' . $cruce->PagoEPS);
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            
                // Actualizar la información del archivo en el modelo
                $cruce->PagoEPS = $pagoeps;
                $cruce->save();
            }

            if ($request->hasFile('PagoCruce')) {
                $documento = $request->file('PagoCruce');
                $nomdoc = time() . '_' . $documento->getClientOriginalName();
                $pagocruce = $documento->storeAs($ruta, $nomdoc, 'public');
            
                // Eliminar archivo anterior si existe
                $rutaArchivo = storage_path('app/public/' . $ruta . '/' . $cruce->PagoCruce);
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            
                // Actualizar la información del archivo en el modelo
                $cruce->PagoCruce = $pagocruce;
                $cruce->save();
            }
            
            Session::flash('success', '¡El cruce se actualizó correctamente!');
            
            return back();
            
        }

        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'El cruce ya está en la base de datos. Por favor, verifica e inténtalo nuevamente.');
            } elseif($e->errorInfo==1048){
                Session::flash('error', 'Hay columnas que se están enviando vacías, comunícate con el administrador.');
            } elseif($e->errorInfo==1064 || $e->errorInfo==1452){
                Session::flash('error', 'Ha sido imposible relacionar la información.');
            } elseif($e->errorInfo==1364){
                Session::flash('error','Datos ingresados no válidos, por favor vuelve a ingresarlos.');
            } else {
                Session::flash('error', '¡Ups! Algo salió mal al actualizar el cruce: ' . $e->getMessage());
            }
            return back();
        } catch(Exception $ex){
            Session::flash('error', '¡Ups! Algo salió mal al actualizar el cruce: ' . $ex->getMessage());
            return back(); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCruce)
    {
        try{
            $cruce = Cruce::findOrFail($idCruce);
            if($cruce){
                $rutadirectorio = $cruce->user_id;


                if($cruce->PagoEPS){
                    $rutapagoeps = storage_path('app/public/' . $rutadirectorio . '/' . $cruce->PagoEPS);
                    if(file_exists($rutapagoeps)){
                        unlink($rutapagoeps);
                    }
                }

                $cruce->delete();
                Session::flash('success', '¡El cruce se eliminó correctamente!');


            }


        }catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar la incapacidad: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar la incapacidad!'. $e->getMessage());
        }


        return back();
    }
}
