@extends('layouts.app')

@section('content')

<h1>EMPLEADORES</h1>

<div class="row">
    <div class="card w-75">
        <div class="card-body">
            <div class="table-responsive" style="width: 100%; height: 100%;">
                <table class="table-striped table align-middle table-bordered" id="empleadores">
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
                                    <button type="button" class="btn btn-link">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                    </button>

                                    <button type="button" class="btn btn-link"  title="Borrar">
                                        <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                    </button>

                                    <button type="button" class="btn btn-link" title="Detalles">
                                        <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                                      </button>
                                
                                
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