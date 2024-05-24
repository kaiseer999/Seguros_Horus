@php
$user = auth()->user();
@endphp
@if($user->hasRole('seguros') || $user->hasRole('admin'))

    






@extends('layouts.app')

@section('content')
    <h1>Nueva Incapacidad</h1>
 
    <div class="alert alert-warning" role="alert">
        ¡No olvides adjuntar la historia médica y la incapacidad del empleado! No te preocupes, aceptamos todos los formatos de archivo. 🩺💼
    </div>
    

<hr>
<div class="row">
    <div class="col-lg-9 mb-4">
        <div class="card-body">
            <form action="{{url('/incapacidades')}}" id="FrmIncapacidad" name="FrmIncapacidad" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="FechaInicioInc" name="FechaInicioInc" placeholder="Fecha de inicio de la incapacidad" required>
                            <label for="FechaInicioInc">Fecha de inicio de la incapacidad</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="FechaFinInc" name="FechaFinInc" placeholder="Fecha de fin de la incapacidad" required>
                            <label for="FechaFinInc">Fecha de fin de la incapacidad</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="diasInc" name="diasInc" placeholder="Dias de incapacidad" required >
                        <label for="DiasInc">Dias de incapacidad</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="EmpleadoSelect" class="form-label">Empleado incapacitado</label>
                        <select class="form-select form-select-lg" id="EmpleadoSelect" name="numeroEmpleado" required>
                            <option selected>Selecciona...</option>
                            @foreach($empleados as $empleado)
                            <option value="{{ $empleado->numeroEmpleado }}">{{ $empleado->nombreEmpleado . ' ' . $empleado->apellidoEmpleado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="EmpleadorSelect" class="form-label">Empleador</label>
                        <select class="form-select form-select-lg" id="EmpleadorSelect" name="numeroEmpleador" required>
                            <option selected>Selecciona...</option>
                            @foreach($empleadores as $empleador)
                            <option value="{{ $empleador->numeroEmpleador }}">{{ $empleador->nombreEmpleador }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <br>
                <div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="RazonS" name="RazonSocialInc" placeholder="Razon social" required>
                        <label for="RazonS">Razon social</label>
                    </div>
                </div> 

                <br>
                <div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="EPS_ARL" name="EPS_ARL" placeholder="Razon social" required>
                        <label for="EPS_ARL">EPS/ARL</label>
                    </div>
                </div> 
                <br>
                <div class="mb-3">
                    <label for="tIncSelect" class="form-label">Tipo de incapacidad</label>
                    <select class="form-select" id="tIncSelect" name="idTipoInc">
                        <option selected>Selecciona...</option>
                        @foreach($tipoInc as $tinc)
                        <option value="{{ $tinc->idTipoInc }}">{{$tinc->NombreTipoInc }}</option>
                        @endforeach
                    </select>
                </div>
                
                <br>
                <div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="Radicado" name="numeroRadicado" placeholder="Numero de radicado" >
                        <label for="Radicado">Numero de radicado</label>
                    </div>
                </div> 
                <br>
                <div class="mb-3">
                    <label for="EstadoSelect" class="form-label">Estado de la incapacidad</label>
                    <select class="form-select" id="EstadoSelect" name="idEstadoInc" required>
                        <option selected>Selecciona...</option>
                        @foreach($estados as $estado)
                        <option value="{{ $estado->idEstadoInc }}">{{$estado->NombreEstado }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="Historia_MedicaInc" placeholder="Historia medica" name="Historia_MedicaInc" required>
                        <label for="Historia_MedicaInc">Historia medica</label>
                    </div>
                </div> 
                <br>
                <div>
                    <div class="form-floating">
                        <input type="file" class="form-control" id="Soporte_Incapacidad" placeholder="Soporte de incapacidad" name="Soporte_Incapacidad" required>
                        <label for="Soporte_Incapacidad">Soporte de incapacidad</label>
                    </div>
                </div>
                
              
                <br>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Agrega una observacion" id="floatingTextarea2" style="height: 100px" name="Observaciones"></textarea>
                    <label for="floatingTextarea2">Observaciones</label>
                </div>
            
                <br>

            <div class="col-md-12 text-md-end"> 
                <button class="btn btn-success">Crear incapacidad</button>
            </div>            
            </form>
        </div>
    </div>
    <div class="col-lg-3 mb-4">

        
        <div class="card">
            <div class="card-header bg-warning text-dark text-center">
                ¿No encuentras al empleador o empleado?
            </div>
            
            
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text text-center">¡No te preocupes! ¡Crea uno!</p>

                <div class="row">
                    <!--button  empleado-->

                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-warning btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalEmpleado">
                            Crear empleado
                        </button>
                    </div>
                    <!--button  empleador-->

                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-warning btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#exampleModalEmpleador">
                            Crear empleador
                        </button>
                    </div>
                </div>

                <!--Modal form empleador-->
                <div class="modal fade modal-lg" id="exampleModalEmpleador" tabindex="-1" aria-labelledby="eexampleModalEmpleadorLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalEmpleadorLabel">Nuevo empleador</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                                <label for="nombreEmpleador" class="form-label">Nombre del empleador</label>
                                <input type="text" class="form-control" id="nombreEmpleador" name="nombreEmpleador"  required>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-success">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                
                  
                  <!-- Modal Form Empleado-->
                  <div class="modal fade modal-lg" id="exampleModalEmpleado" tabindex="-1" aria-labelledby="exampleModalEmpleadoLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalEmpleadoLabel">Nuevo empleado</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="{{url('/empleados')}}" id="FrmEmpleados" method="POST" >
                            @csrf
                              <div class="mb-3">
                                <label for="tipoDocumentoempleado" class="form-label">Tipo documento</label>
                                <select class="form-select form-select-lg mb-3" name="tipoDocumentoempleado" required>
                                  <option value="Cedula Ciudadania">Cedula Ciudadania</option>
                                  <option value="Cedula Extranjeria">Cedula Extranjeria</option>
                                  <option value="Permiso Especial Permanencia">Permiso Especial Permanencia</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="idEmpleado" class="form-label">Numero de identificacion</label>
                                <input type="text" class="form-control" id="idEmpleado" name="idEmpleado" value="pepito" required>
                              </div>
                              <div class="mb-3 row">
                                <div class="col">
                                  <label for="nombreEmpleado" class="form-label">Nombre del Empleado</label>
                                  <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" required>
                                </div>
                                <div class="col">
                                  <label for="apellidoEmpleado" class="form-label">Apellido del Empleado</label>
                                  <input type="text" class="form-control" id="apellidoEmpleado" name="apellidoEmpleado" required>
                                </div>
                              </div>
                              
                            </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-success" onclick="submitForm('FrmEmpleados')">Crear</button>                          </div>
                      </div>
                      <script>
                        function submitForm(formId){
                            document.getElementById(formId).submit();
                          }
                      </script>
                    </div>
                  </div>  
                  
                 
                </div>
            
        </div>
    </div>
    
    
    


</div>



  
 
  



@endsection

@section('js')
<script>

       




            @if(Session::has('success'))
            // Muestra una alerta de SweetAlert2
            Swal.fire({
            title: "¡Éxito!", // El título de la alerta
            text: "{{ Session::get('success') }}", // El texto de la alerta
            icon: "success" // El ícono de la alerta
            });
        @endif

        
        @if(Session::has('error'))
                Swal.fire({
                    title: "Error",
                    text: "{{ Session::get('error') }}",
                    icon: "error"
                });
        @endif




    
        $(document).ready(function() {
            $('#EmpleadoSelect').select2();
            $('#EmpleadorSelect').select2();
        });

        document.getElementById('FrmIncapacidad').addEventListener('submit', function(event) {
            calcularDias();
        
            
        });

   

                                
        document.getElementById('FechaInicioInc').addEventListener('change', calcularDias);
        document.getElementById('FechaFinInc').addEventListener('change', calcularDias);
                            
        function calcularDias() {
            var FechaInicioInc = new Date(document.getElementById('FechaInicioInc').value);
            var FechaFinInc = new Date(document.getElementById('FechaFinInc').value);

            // Calcula la diferencia en milisegundos
            var diferencia = FechaFinInc.getTime() - FechaInicioInc.getTime();
            
            // Convierte la diferencia en días y redondea hacia abajo
            var dias = Math.floor(diferencia / (1000 * 3600 * 24));

            // Muestra el resultado en el campo de texto
            document.getElementById('diasInc').value = dias;
        }

</script>
@endsection

@endif