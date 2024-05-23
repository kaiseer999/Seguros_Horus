@extends('layouts.app')

@section('content')

<h1>EMPLEADORES</h1>

<div class="row">
    <div class="card w-75">
        <div class="card-body">
            <div class="table-responsive" style="width: 100%; height: 100%;">
                <table class="table-striped table align-middle table-bordered" id="empleadores">
                    @role('admin')

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#empleadorModalCrear">
                        Crear empleador
                    </button>

                    <div class="modal fade" id="empleadorModalCrear" tabindex="-1" aria-labelledby="empleadorModalCrearLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="empleadorModalCrearLabel">Nuevo empleador</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url("/empleadores")}}" method="post">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="nombreEmpleador" class="form-label">Nombre del empleador</label>
                                            <input type="text" class="form-control" id="nombreEmpleador" name="nombreEmpleador"  required>
                                        </div>
                                    
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-success">Crear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endrole
                    <thead>
                        <tr>
                            <th>{{'#'}}</th>
                            <th>Nombre empleador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleadores as $empleador)
                        <tr>
                            <td>{{$empleador->numeroEmpleador}}</td>
                            <td>{{$empleador->nombreEmpleador}}</td>
                            <td class="align-middle text-center">
                                <div class="d-inline-flex">
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#empleadorModalEdit{{$empleador->numeroEmpleador}}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                    </button>

                                    <div class="modal fade" id="empleadorModalEdit{{$empleador->numeroEmpleador}}" tabindex="-1" aria-labelledby="empleadorModalEditLabel{{$empleador->numeroEmpleador}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="empleadorModalEditLabel{{$empleador->numeroEmpleador}}">Editar Empleado</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('empleadores.update', $empleador->numeroEmpleador) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="nombreEmpleador" class="form-label">Número de identificación</label>
                                                            <input type="text" class="form-control" id="nombreEmpleador" name="nombreEmpleador" value="{{$empleador->nombreEmpleador}}" required>
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

                                    <form id="deleteForm" action="{{ url('/empleadores/'.$empleador->numeroEmpleador) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-link" onclick="confirmDelete()" >
                                            <i class="fa-solid fa-trash fa-lg" ></i>
                                        </button>
                                    </form>

                                    <button type="button" class="btn btn-link" title="Detalles" data-bs-toggle="modal" data-bs-target="#empleadorModalDetalles{{$empleador->numeroEmpleador}}">
                                        <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                                    </button>  
                                    
                                    <div class="modal fade" id="empleadorModalDetalles{{$empleador->numeroEmpleador}}" tabindex="-1" aria-labelledby="empleadorModalDetallesLabel{{$empleador->numeroEmpleador}}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg ">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="empleadorModalDetallesLabel{{$empleador->numeroEmpleador}}">Editar Empleado</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>pruebaa{{$empleador->numeroEmpleador}} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                
                                </div>
                            </td>
                        @endforeach
                        </tr>
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


function confirmDelete() {
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
            document.getElementById('deleteForm').submit();
        }
    });
  }

    $(document).ready(function() {
        $('#empleadores').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Empleador no encontrada, lo sentimos",
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