@extends('layouts.app')

@section('content')

@php
$user = auth()->user();
@endphp



<h1>LISTA DE EMPLEADOS</h1>




<div class="row">
    <div class="card w-75">
        <div class="card-body">
            <div class="table-responsive" style="width: 100%; height: 100%;">
                <table class="table-striped table align-middle table-bordered" id="empleados">
                    <!--Este modal es el formulario de creacion-->
                    
                    @if($user->hasRole('seguros') || $user->hasRole('admin'))

                    <!-- Button, para abrir el modal-->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Crear empleado
                    </button>
                    
                    <!-- Modal Form -->
                    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Crear empleado</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('/empleados')}}" id="FrmEmpleado" method="POST" >
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
                            <button type="button" class="btn btn-success" onclick="submitForm('FrmEmpleado')">Crear</button>                          </div>
                        </div>
                      </div>
                    </div>
                    <script>
                      function submitForm(formId){
                        document.getElementById(formId).submit();
                      }

                    </script>
                    @endif


                    <thead>
                        <tr>
                            <th>{{'#'}}</th>
                            <th>Tipo de documento</th>
                            <th>Numero de documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            @role('admin')
                            <th>Acciones</th>
                            @endrole
                        </tr>
                    </thead>
            
                    <tbody>
            
                    
                        @foreach ($empleados as $empleado)
            
            
            
                        <tr>
            
                            <td>{{$empleado->numeroEmpleado}}</td>
                            <td>{{$empleado->tipoDocumentoempleado}}</td>
                            <td>{{$empleado->idEmpleado}}</td>
                            <td>{{$empleado->nombreEmpleado}}</td>
                            <td>{{$empleado->apellidoEmpleado}}</td>
                            @role('admin')
                            <td>

                              <div class="d-inline-flex">


                                  <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal{{$empleado->idEmpleado}}">
                                    <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                  </button>
                                
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal{{$empleado->idEmpleado}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$empleado->idEmpleado}}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel{{$empleado->idEmpleado}}">Editar Empleado</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('empleados.update', $empleado->numeroEmpleado) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="tipoDocumentoempleado" class="form-label">Tipo de documento</label>
                                                        <select class="form-select form-select-lg mb-3" name="tipoDocumentoempleado" required>
                                                            <option value="Cedula Ciudadania">Cedula Ciudadanía</option>
                                                            <option value="Cedula Extranjeria">Cedula Extranjería</option>
                                                            <option value="Permiso Especial Permanencia">Permiso Especial Permanencia</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="idEmpleado" class="form-label">Número de identificación</label>
                                                        <input type="text" class="form-control" id="idEmpleado" name="idEmpleado" value="{{$empleado->idEmpleado}}" required>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col">
                                                            <label for="nombreEmpleado" class="form-label">Nombre del Empleado</label>
                                                            <input type="text" class="form-control" id="nombreEmpleado" name="nombreEmpleado" value="{{ $empleado->nombreEmpleado }}"  required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="apellidoEmpleado" class="form-label">Apellido del Empleado</label>
                                                            <input type="text" class="form-control" id="apellidoEmpleado" name="apellidoEmpleado" value="{{ $empleado->apellidoEmpleado }}"  required>
                                                        </div>
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
                                
                                <form id="deleteForm{{ $empleado->numeroEmpleado }}" action="{{ url('/empleados/'.$empleado->numeroEmpleado) }}" method="post">
                                  @csrf
                                  {{ method_field('DELETE') }}
                                  <button type="button" class="btn btn-link" onclick="confirmDelete({{ $empleado->numeroEmpleado }})" title="Borrar">
                                      <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                  </button>
                                </form>
                                

                                    

                                  </form>
                                  <!-- Botón que abre el modal -->
                                  <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detallesModal{{$empleado->idEmpleado}}" title="Detalles">
                                      <i class="fas fa-info-circle fa-lg" title="Detalles"></i>
                                  </button>

                                  <!-- Modal -->
                                  <div class="modal fade" id="detallesModal{{$empleado->idEmpleado}}" tabindex="-1" aria-labelledby="detallesModalLabel{{$empleado->idEmpleado}}" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="detallesModalLabel{{$empleado->idEmpleado}}">Detalles</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                <p>{{$empleado->tipoDocumentoempleado." : ". $empleado->idEmpleado}}</p>
                                                <p>{{"Nombre completo : ".$empleado->nombreEmpleado." ".$empleado->apellidoEmpleado}}</p>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                  <!-- Puedes agregar más botones de acción si lo necesitas -->
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  

                              </div>       
                            </td>
                            @endrole
            
                        </tr>
                            
                        @endforeach
                        
            
            
                    </tbody>
            
            
                </table>
            </div>
        
        </div>
    </div>
    <div class="col-md-3">
      
          <div class="card col-sm">
            <div class="card-header bg-warning text-dark">
              Incapacidad
            </div>
            <div class="card-body">
              <h5 class="card-title">¿Empleado incapacitado?</h5>
              <p class="card-text">¡Ingresa su incapacidad aquí! No olvides los soportes de EPS y radicación.</p>
              <a href="{{url('/incapacidades/create')}}" class="btn btn-warning">Crear aquí</a>
            </div>
          </div>
      
          <br>
          <div class="card col-sm">
            <div class="card-header bg-warning text-dark">
              Cruce
            </div>
            <div class="card-body">
              <h5 class="card-title">¿La EPS o ARL ya pagó?</h5>
              <p class="card-text">Crea un cruce lo antes posible, no juegues con el dinero de los demás.</p>
              <a href="{{url('/cruces')}}" class="btn btn-warning">Crear aquí</a>
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
  

  function confirmDelete(numeroEmpleado) {
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
            document.getElementById('deleteForm' + numeroEmpleado).submit();
        }
    });
}


   

    	
    $(document).ready(function() {
        $('#empleados').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Empleado no encontrado, lo sentimos",
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

