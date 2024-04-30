@extends('layouts.app')

@section('content')

<h1>Incapacidades</h1>

<div class="row">
    <div class="card w-100">
        <div class="card-body">
            <div class="table-responsive" style="width: 100%; height: 100%;">
                <table class="table-striped table align-middle table-bordered" id="incapacidades">
                    <a href="{{ url('incapacidades/create') }}" class="btn btn-warning">Crear incapacidad</a>
                    <thead>
                        <th>Nombre del empleado</th>
                        <th>Tipo de incapacidad</th>
                        <th>Razon social</th>
                        <th>EPS / ARL</th>
                        <th>Dias de incapacidad</th>
                        <th>Estado</th>

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

                            <td class="align-middle text-center">
                                <div class="d-inline-flex">
                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              ...
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                              <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    <button type="button" class="btn btn-link"  title="Borrar">
                                        <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                    </button>

                                    <button type="button" class="btn btn-link" title="Detalles">
                                        <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                                      </button>
                                
                                
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