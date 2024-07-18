@php
$user = auth()->user();
@endphp

@extends('layouts.app')

@section('content')



<h1>Incapacidades</h1>

<div class="row">
    <div class="card w-100">
        <div class="card-body">
            <div class="table-responsive" style="width: 100%; height: 100%;">
                <table class="table-striped table align-middle table-bordered" id="incapacidades">
                    
                    @if($user->hasRole('seguros') || $user->hasRole('admin'))
                    <a href="{{ url('incapacidades/create') }}" class="btn btn-warning">Crear incapacidad</a>
                    @endif
                    <thead>
                        <th>Nombre del empleado</th>
                        <th>Tipo de incapacidad</th>
                        <th>Razon social</th>
                        <th>EPS / ARL</th>
                        <th>Dias de incapacidad</th>
                        <th>Estado</th>
                        <th>Hora y fecha de creacion</th>

                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @foreach ($incapacidades as $inc)
                        <tr>
                         
                            <td>{{$inc->empleado->nombreEmpleado." ".$inc->empleado->apellidoEmpleado}}</td>
                            <td>{{$inc->tipoIncapacidad->NombreTipoInc}}</td> 
                            <td>{{$inc->RazonSocialInc}}</td>
                            <td>{{$inc->EPS_ARL}}</td>
                            <td>{{$inc->diasInc}}</td>
                            <td>{{ $inc->estado->NombreEstado }}</td>
                            <td>{{$inc->created_at}}</td>


                           

                            <td class="align-middle ">
                                <div class="d-inline-flex">
                                    @if($user->hasRole('seguros') || $user->hasRole('admin'))

                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEditar{{$inc->idIncapacidades}}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                    </button>
                                    <div class="modal fade" id="modalEditar{{$inc->idIncapacidades}}" tabindex="-1" aria-labelledby="modalEditarLabel{{$inc->idIncapacidades}}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalEditarLabel{{$inc->idIncapacidades}}">Editar</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                <form action="{{ route('incapacidades.update', $inc->idIncapacidades) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3 row">
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <input type="date" class="form-control" id="FechaInicioInc"  value="{{$inc->FechaInicioInc}}" name="FechaInicioInc" placeholder="Fecha de inicio de la incapacidad" >
                                                                <label for="FechaInicioInc">Fecha de inicio de la incapacidad</label>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <input type="date" class="form-control" id="FechaFinInc" name="FechaFinInc" value="{{$inc->FechaFinInc}}" placeholder="Fecha de fin de la incapacidad" >
                                                                <label for="FechaFinInc">Fecha de fin de la incapacidad</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="diasInc" name="diasInc" value="{{$inc->diasInc}}" placeholder="Dias de incapacidad"  >
                                                            <label for="DiasInc">Dias de incapacidad</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="mb-3">
                                                        <label for="numeroEmpleado" class="form-label">Empleado incapacitado</label>
                                                        <input type="text" class="form-control" id="numeroEmpleado" name="numeroEmpleado" value="{{ $inc->empleado->nombreEmpleado . ' ' . $inc->empleado->apellidoEmpleado }}" readonly >
                                                        <input type="hidden" name="numeroEmpleado" value="{{ $inc->numeroEmpleado }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="numeroEmpleador" class="form-label">Empleador</label>
                                                        <input type="text" class="form-control" id="numeroEmpleador" name="numeroEmpleador" value="{{ $inc->empleadors->nombreEmpleador }}" readonly >
                                                        <input type="hidden" name="numeroEmpleador" value="{{ $inc->numeroEmpleador }}">
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="RazonSocialInc" name="RazonSocialInc" value="{{$inc->RazonSocialInc}}" placeholder="RazonSocialInc" >
                                                            <label for="RazonSocialInc">Razon social</label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="EPS_ARL" value="{{$inc->EPS_ARL}}" name="EPS_ARL" placeholder="EPS_ARL" >
                                                            <label for="EPS_ARL">EPS/ARL</label>
                                                        </div>
                                                    </div> 
                                                    <br>
                                                    <div class="mb-3">
                                                        <label for="tIncSelect" class="form-label">Tipo de incapacidad</label>
                                                        <select class="form-select" id="tIncSelect" name="idTipoInc">
                                                            <option value="" disabled>Selecciona...</option>
                                                            @foreach($tiposIncapacidad as $tinc)
                                                            <option value="{{ $tinc->idTipoInc }}" {{ $tinc->idTipoInc == $inc->idTipoInc ? 'selected' : '' }}>{{$tinc->NombreTipoInc }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <br>
                                                    <div>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" id="numeroRadicado" name="numeroRadicado" value="{{$inc->numeroRadicado}}" placeholder="Numero de radicado" >
                                                            <label for="numeroRadicado">Numero de radicado</label>
                                                        </div>
                                                    </div> 

                                                    <br>

                                                    <div class="mb-3">
                                                        <label for="EstadoSelect" class="form-label">Estado de la incapacidad</label>
                                                        <select class="form-select" id="EstadoSelect" name="idEstadoInc" >
                                                            <option value="" disabled>Selecciona...</option>
                                                            @foreach($estado as $estados)
                                                            <option value="{{ $estados->idEstadoInc }}">{{$estados->NombreEstado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <br>
                                                    <label for="idEmpleado" class="form-label"><b>¡Importante!</b> Si deseas modificar o editar algún archivo, ¡adelante! Sube archivos solo si es 
                                                        necesario para la actualización. La previsualización no está disponible en esta vista.</label>
                                                    <div class="mb-3">
                                                        <label for="Historia_MedicaInc">Historia medica</label>
                                                        <input type="file" class="form-control" id="Historia_MedicaInc" placeholder="Historia medica" name="Historia_MedicaInc" >
                                                    </div>
                                                    <br>
                                                    <div class="mb-3">
                                                        <label for="Soporte_Incapacidad">Soporte de incapacidad</label>
                                                        <input type="file" class="form-control" id="Soporte_Incapacidad" placeholder="Soporte de incapacidad" name="Soporte_Incapacidad" >
                                                    </div>

                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Agrega una observacion" id="Observaciones" style="height: 100px" name="Observaciones">{{ old('Observaciones', $inc->Observaciones) }}</textarea>
                                                        <label for="Observaciones">Observaciones</label>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                                    </div>
                                                    

                                                </form>
                                                    
                                                    
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <form id="deleteForm{{ $inc->idIncapacidades }}" action="{{ url('/incapacidades/'.$inc->idIncapacidades) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-link" title="Borrar" onclick="confirmDelete({{ $inc->idIncapacidades }})">
                                            <i class="fa-solid fa-trash fa-lg" title="Borrar incapacidad de {{ $inc->empleado->nombreEmpleado }}"></i>
                                        </button>
                                    </form>

                                    @endif

                                    <button type="button" class="btn btn-link" title="Detalles" data-bs-toggle="modal" data-bs-target="#modalDetalles{{$inc->idIncapacidades}}">
                                        <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                                    </button>
                                    
                                    <!-- Modal de detalles -->
                                    <div class="modal fade" id="modalDetalles{{$inc->idIncapacidades}}" tabindex="-1" aria-labelledby="modalDetallesLabel{{$inc->idIncapacidades}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDetallesLabel{{$inc->idIncapacidades}}">Detalles</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div style="text-align: left;"><b>Nombre del empleado :</b> {{$inc->empleado->nombreEmpleado." ".$inc->empleado->apellidoEmpleado}}</div>
                                                    <div style="text-align: left;"><b>Nombre del empleador :</b> {{ $inc->empleadors->nombreEmpleador }}</div>
                                                    <div style="text-align: left;"><b>Fecha de inicio :</b> {{$inc->FechaInicioInc}}</div>
                                                    <div style="text-align: left;"><b>Fecha de terminacion :</b> {{$inc->FechaFinInc}}</div>
                                                    <div style="text-align: left;"><b>Dias de incapacidad :</b> {{$inc->diasInc}}</div>
                                                    <div style="text-align: left;"><b>Razon social :</b> {{$inc->RazonSocialInc}}</div>
                                                    <div style="text-align: left;"><b>EPS/ARL :</b> {{$inc->EPS_ARL}}</div>
                                                    <div style="text-align: left;"><b>Numero de radicado :</b> {{$inc->numeroRadicado}}</div>
                                                    <div style="text-align: left;"><b>Tipo de incapacidad :</b> {{$inc->tipoIncapacidad->NombreTipoInc}}</div>
                                                    <div style="text-align: left;"><b>Estado de la incapacidad :</b> {{$inc->estado->NombreEstado }}</div>
                                                    <div style="text-align: left;">
                                                        <b>Historia médica:</b> 
                                                        @php
                                                            $nombrehismed = trim($inc->Historia_MedicaInc, '"');
                                                            $ruta= 'storage/'.$nombrehismed;

                                                        @endphp

                                                        <a href="{{ asset($ruta) }}" target="_blank">{{ "Historia medica de ".$inc->empleado->nombreEmpleado }}</a>
                                                    </div>
                                                    <div style="text-align: left;">
                                                        <b>Soporte de incapacidad:</b>
                                                        @php
                                                            // Quitar las comillas dobles alrededor del nombre del archivo
                                                            $nombreArchivo = trim($inc->Soporte_Incapacidad, '"');
                                                            $filePath = 'storage/' . $nombreArchivo;
                                                        @endphp
                                                        <a href="{{ asset($filePath) }}" target="_blank">{{ "Soporte de incapacidad de ".$inc->empleado->nombreEmpleado }}</a>
                                                        <br>
                                                    </div>
                                                    <div style="text-align: left;"><b>Observaciones :</b> {{$inc->Observaciones }}</div>

                                                    
                                                    

                                                  
                                                    


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                                </div>
                            </td>
                        </tr>
                    @endforeach     
                    </tbody>
                </table>
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






    function confirmDelete(idIncapacidades) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + idIncapacidades).submit();
            }
        });
      }

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







    $(document).ready(function() {
        $('#incapacidades').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Incapacidad no encontrada, lo sentimos",
                "info": "Pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Registro no encontrado",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search": "Buscar", 
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                }
            }

        });

    });
</script>

@endsection