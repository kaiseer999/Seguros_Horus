<?php

namespace App\Http\Controllers;

use App\Models\Incapacidade;
use App\Models\Estado;
use App\Models\Empleado;
use App\Models\Empleador;
use App\Models\TipoIncapacidad;
use App\Http\Requests\StoreIncapacidadeRequest;
use App\Http\Requests\UpdateIncapacidadeRequest;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Throwable;

class IncapacidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        try{

        //Filtro para incapacidades que no se mostraran en este caso son las pagadas, ya que se mostraran en cruce
        $ids_a_filtrar = []; 

        // Consultar las incapacidades excluyendo aquellas que tengan los estados que deseas filtrar
        $incapacidades = Incapacidade::with('empleado','empleadors')
            ->whereNotIn('idEstadoInc', $ids_a_filtrar)
            ->get();

        // Obtener otros datos 
        $tiposIncapacidad = DB::table('tipo_incapacidads')->get();
        $estado = DB::table('estados')->get();
        
        // Pasar los datos a la vista
        return view('Incapacidades.CRUD', compact('incapacidades', 'tiposIncapacidad', 'estado'));

        }catch(Exception $e){
            Session::flash('error', '¡Ups! Algo salió mal al cargar las incapacidades: ' . $e->getMessage());
            
            return back();
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
        try{
            $empleados= Empleado::all();
            $empleadores= Empleador::all();
            $tipoInc= TipoIncapacidad::all();
            $estados= Estado::all();
            return view('Incapacidades.Create', compact('empleados','empleadores','tipoInc','estados'));

        }catch(Exception $e){
            Session::flash('error', '¡Ups! Algo salió mal al cargar los datos relacionados: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIncapacidadeRequest $request)
    {

        try{

            $request->validate([
                'FechaInicioInc' => 'required|date',
                'FechaFinInc' => 'required|date',
                'diasInc' => 'required|numeric',
                'numeroEmpleado' => 'required|exists:empleados,numeroEmpleado',
                'numeroEmpleador' => 'required|exists:empleadors,numeroEmpleador',
                'RazonSocialInc' => 'required|string',
                'EPS_ARL' => 'required|string',
                'numeroRadicado' => 'required|string',
                'idTipoInc' => 'required|exists:tipo_incapacidads,idTipoInc',
                'Historia_MedicaInc.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'Soporte_Incapacidad.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'idEstadoInc' => 'required|exists:estados,idEstadoInc',
                'Observaciones' => 'string|max:256',
            ]);
        
            $nomHistoria = null; 
            $nomSop = null; 
            
            $user_id = Auth::id();
            $ruta = $user_id;
            
            // Archivos de Historia Medica
            if ($request->hasFile('Historia_MedicaInc')) {
                $documento = $request->file('Historia_MedicaInc');
                $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                $nomHistoria = $documento->storeAs($ruta, $nomDocumento, 'public');
            }
            
            // Archivos de Soporte de Incapacidad
            if ($request->hasFile('Soporte_Incapacidad')) {
                $documento = $request->file('Soporte_Incapacidad');
                $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                $nomSop = $documento->storeAs($ruta, $nomDocumento, 'public');
            }
        
            // nueva instancia de la Incapacidad utilizando Eloquent
            $incapacidad = new Incapacidade();
            $incapacidad->FechaInicioInc = $request->input('FechaInicioInc');
            $incapacidad->FechaFinInc = $request->input('FechaFinInc');
            $incapacidad->diasInc = $request->input('diasInc');
            $incapacidad->numeroEmpleado = $request->input('numeroEmpleado');
            $incapacidad->numeroEmpleador = $request->input('numeroEmpleador');
            $incapacidad->RazonSocialInc = $request->input('RazonSocialInc');
            $incapacidad->EPS_ARL = $request->input('EPS_ARL');
            $incapacidad->numeroRadicado = $request->input('numeroRadicado');
            $incapacidad->idTipoInc = $request->input('idTipoInc');
            $incapacidad->Historia_MedicaInc = !empty($nomHistoria) ? json_encode($nomHistoria) : null;
            $incapacidad->Soporte_Incapacidad = !empty($nomSop) ? json_encode($nomSop) : null;
            $incapacidad->idEstadoInc = $request->input('idEstadoInc');
            $incapacidad->Observaciones = $request->input('Observaciones');
        
            $incapacidad->save();

            Session::flash('success', '¡La incapacidad se creó correctamente!');

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
            Session::flash('error', '¡Ups! Algo salió mal al crear la incapacidad: ' . $ex->getMessage());
            return back(); 
        }
        
    }
  

    /**
     * Display the specified resource.
     */
    public function show(Incapacidade $incapacidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incapacidade $incapacidade)
    {
        try{
            $empleados= Empleado::all();
            $empleadores= Empleador::all();
            $tipoInc= TipoIncapacidad::all();
            $estados= Estado::all();
            return view('Incapacidades.Edit', compact('empleados','empleadores','tipoInc','estados'));

        }catch(Exception $e){
            Session::flash('error', '¡Ups! Algo salió mal al cargar los datos relacionados: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIncapacidadeRequest $request, $idIncapacidades)
    {
        
        try{
            //Busco la incapacidad a editar
            $incapacidad = Incapacidade::find($idIncapacidades);

            $request->validate([
                'FechaInicioInc' => 'required|date',
                'FechaFinInc' => 'required|date',
                'diasInc' => 'required|numeric',
                'numeroEmpleado' => 'required|exists:empleados,numeroEmpleado',
                'numeroEmpleador' => 'required|exists:empleadors,numeroEmpleador',
                'RazonSocialInc' => 'required|string',
                'EPS_ARL' => 'required|string',
                'numeroRadicado' => 'required|string',
                'idTipoInc' => 'required|exists:tipo_incapacidads,idTipoInc',
                'Historia_MedicaInc.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'Soporte_Incapacidad.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240',
                'idEstadoInc' => 'required|exists:estados,idEstadoInc',
                'Observaciones' => 'string|max:256',
            ]);

            if($incapacidad){
                $incapacidad->update([
                    'FechaInicioInc'=>request('FechaInicioInc'),
                    'FechaFinInc'=>request('FechaFinInc'),
                    'diasInc'=>request('diasInc'),
                    'RazonSocialInc'=>request('RazonSocialInc'),
                    'EPS_ARL'=>request('EPS_ARL'),
                    'numeroRadicado'=>request('numeroRadicado'),
                    'idTipoInc'=>request('idTipoInc'),
                    'idEstadoInc'=>request('idEstadoInc'),
                    'Observaciones'=>request('Observaciones')
                ]);

                $historiaMedica = null;
                $soporteIncapacidad = null;
                $user_id = Auth::id();
                $ruta = $user_id;

                if ($request->hasFile('Historia_MedicaInc') || $request->hasFile('Soporte_Incapacidad')) {
                    if ($request->hasFile('Historia_MedicaInc')) {
                        $documento = $request->file('Historia_MedicaInc');
                        $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                        $historiaMedica = $documento->storeAs($ruta, $nomDocumento, 'public');
                    
                        // Eliminar archivo de Historia Medica anterior si existe
                        if ($incapacidad->Historia_MedicaInc) {
                            $rutaArchivo = storage_path('app/public/' . $ruta . '/' . $incapacidad->Historia_MedicaInc);
                            if (file_exists($rutaArchivo)) {
                                unlink($rutaArchivo);
                            }
                        }
                    
                        // Actualizar el nombre del archivo en la base de datos
                        $incapacidad->update(['Historia_MedicaInc' => json_encode($historiaMedica)]);
                    }
                    
                    if ($request->hasFile('Soporte_Incapacidad')) {
                        $documento = $request->file('Soporte_Incapacidad');
                        $nomDocumento = time() . '_' . $documento->getClientOriginalName();
                        $soporteIncapacidad = $documento->storeAs($ruta, $nomDocumento, 'public');
                    
                        // Eliminar archivo de Soporte anterior si existe
                        if ($incapacidad->Soporte_Incapacidad) {
                            $rutaArchivo = storage_path('app/public/' . $ruta . '/' . $incapacidad->Soporte);
                            if (file_exists($rutaArchivo)) {
                                unlink($rutaArchivo);
                            }
                        }
                    
                        // Actualizar el nombre del archivo en la base de datos
                        $incapacidad->update(['Soporte_Incapacidad' => json_encode($soporteIncapacidad)]);
                    }
                    



                }

                Session::flash('success', '¡La incapacidad se actualizo correctamente!');

                return back();


            }
        }catch(QueryException $e){
            if($e->errorInfo==1062){
                Session::flash('error', 'La incapacidad ya está en la base de datos. Por favor, verifica e inténtalo nuevamente.');
            } elseif($e->errorInfo==1048){
                Session::flash('error', 'Hay columnas que se están enviando vacías, comunícate con el administrador.');
            } elseif($e->errorInfo==1064 || $e->errorInfo==1452){
                Session::flash('error', 'Ha sido imposible relacionar la información.');
            } elseif($e->errorInfo==1364){
                Session::flash('error','Datos ingresados no válidos, por favor vuelve a ingresarlos.');
            } else {
                Session::flash('error', '¡Ups! Algo salió mal al actualizar la incapacidad: ' . $e->getMessage());
            }
            return back();
        } catch(Exception $ex){
            Session::flash('error', '¡Ups! Algo salió mal al actualizar la incapacidad: ' . $ex->getMessage());
            return back(); 
        }
        
     //return $request->all();
        
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idIncapacidades)
    {

        try{
            $incapacidad = Incapacidade::findOrFail($idIncapacidades);

            if ($incapacidad) {
                // Obtener la ruta del directorio del usuario
                $rutaDirectorio = $incapacidad->user_id;

                // Eliminar archivos asociados a la incapacidad
                if ($incapacidad->Historia_MedicaInc) {
                    $rutaArchivoHistoriaMedica = storage_path('app/public/' . $rutaDirectorio . '/' . $incapacidad->Historia_MedicaInc);
                    if (file_exists($rutaArchivoHistoriaMedica)) {
                        unlink($rutaArchivoHistoriaMedica);
                    }
                }

                if ($incapacidad->Soporte_Incapacidad) {
                    $rutaArchivoSoporte = storage_path('app/public/' . $rutaDirectorio . '/' . $incapacidad->Soporte_Incapacidad);
                    if (file_exists($rutaArchivoSoporte)) {
                        unlink($rutaArchivoSoporte);
                    }
                }

                // Eliminar la incapacidad de la base de datos
                $incapacidad->delete();
                Session::flash('success', '¡La incapacidad se ha eliminado correctamente!');

            }


        }catch (QueryException $e) {
            Session::flash('error', '¡Error al eliminar la incapacidad: ' . $e->getMessage());
        } catch (Exception $e) {
            Session::flash('error', '¡Error al eliminar la incapacidad!'. $e->getMessage());
        }


        return back();


    }
    
}
