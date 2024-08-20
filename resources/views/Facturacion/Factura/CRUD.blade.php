@extends('layouts.app')

@section('content')

<h1>Facturas y productos</h1>


<div class="container">

    <div class="alert alert-warning" role="alert">
       <p>
        ¿No encuentras el producto?, Mira los productos disponibles 
        
        <a  class="btn btn-warning" onclick="openNewWindow()">Crear producto</a>
        </p> 
    
    </div>
    
    <div class="row">
       

        <!-- Columna para el módulo más grande -->
        <div class="col-lg-12 col-md-8 col-sm-7 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3>Módulo Grande</h3>
                </div>
                <div class="card-body">

                    <a href="{{url('/facturas/create')}}" class="btn btn-warning">Crear Factura</a>

                    <br>
                    <br>
                    <table class="table table-striped table-bordered" id="facturas">
                        <thead>
                            <tr>
                                <th>Nombre del cliente</th>
                                <th>Email del cliente</th>
                                <th>Teléfono del cliente</th>
                                <th>Hora y fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cliente A</td>
                                <td>cliente@ejemplo.com</td>
                                <td>123456789</td>
                                <td>2024-07-17 10:30 AM</td>
                            </tr>
                        </tbody>
                    </table>
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
        // Initialize Select2 on elements with class .js-example-basic-single
        $('.js-example-basic-single').select2();

        // Initialize Select2 on elements within modal
        $('#mySelect2').select2({
            dropdownParent: $('#myModal .modal-body')
        });

        // Or you can initialize Select2 specifically when the modal is shown
        $('#myModal').on('shown.bs.modal', function() {
            $('.js-example-basic-single').select2({
                dropdownParent: $('#myModal .modal-body')
            });
        });
    });



    $(document).ready(function() {
        $('#facturas').DataTable({
            responsive: true,
            autoWidth: false,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron registros",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });

    function openNewWindow() {
        var width = 640;
        var height = 480;
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var options = `width=${width}, height=${height}, top=${top}, left=${left}`;
        window.open('{{ url('/producto/create') }}', '_blank', options);
    }
</script>
@endsection
