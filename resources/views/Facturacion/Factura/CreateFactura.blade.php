@extends('layouts.app')

@section('content')

<h1>Test</h1>

<div class="container justify-content-center">
    <div class="row mb-3">
        <div class="col-6">
            <label for="tipoProducto" class="form-label">Tipo de Producto</label>
            <select id="tipoProducto" class="form-control">
                <option value="">Seleccione un tipo</option>
                @foreach ($catsProducto as $catproducto)
                    <option value="{{ $catproducto->idCategoriaProducto }}">{{ $catproducto->nombreCategoria }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="row mb-3" id="campoAdicional" style="display:none;">
        <div class="col-6">
            <label for="valorAdicional" class="form-label">Valor Adicional</label>
            <input type="text" name="valorAdicional" id="valorAdicional" class="form-control">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label for="codigoProducto" class="form-label">Producto a facturar</label>
            <select class="js-example-basic-single form-control" name="codigoProducto" id="codigoProducto">
                <option value="">Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->codigoProducto }}">{{ $producto->nombreProducto }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="detallesProducto" class="mt-3">
        <!-- Los detalles del producto se mostrarán aquí -->
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label for="id_cliente" class="form-label">Seleccionar usuario</label>
            <select class="js-example-basic-single form-control" name="id_cliente" id="id_cliente">
                <option value="">Selecciona un usuario</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombreCompleto }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-6">
            <label for="asesorCliente" class="form-label">Asesor del cliente</label>
            <input type="text" name="asesorCliente" id="asesorCliente" class="form-control" readonly>
        </div>
    </div>

    <!-- Campo adicional oculto inicialmente -->
    <div class="row mb-3" id="campoAdicional" style="display:none;">
        <div class="col-6">
            <label for="valorAdicional" class="form-label">Valor Adicional</label>
            <input type="text" name="valorAdicional" id="valorAdicional" class="form-control">
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.js-example-basic-single').select2();

        // Manejar cambio en el tipo de producto
        $('#tipoProducto').change(function() {
            var tipo = $(this).val();
            if (tipo) {
                $.ajax({
                    url: '/productoCategoria/' + tipo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#codigoProducto').empty().append('<option value="">Selecciona un producto</option>');
                        $.each(data, function(key, producto) {
                            $('#codigoProducto').append('<option value="' + producto.codigoProducto + '">' + producto.nombreProducto + '</option>');
                        });
                        $('#codigoProducto').trigger('change'); // Actualizar Select2
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener los productos: " + textStatus, errorThrown);
                    }
                });

                // Mostrar el campo adicional para tipos específicos
                if (tipo === '2') { // Cambia '1' por el id del tipo de producto que deseas mostrar el campo
                    $('#campoAdicional').show();
                } else {
                    $('#campoAdicional').hide();
                }
            } else {
                $('#codigoProducto').empty().append('<option value="">Selecciona un producto</option>');
                $('#codigoProducto').trigger('change'); // Actualizar Select2
                $('#campoAdicional').hide(); // Ocultar campo adicional si no hay tipo seleccionado
            }
        });

        // Manejar cambio en el producto seleccionado
        $('#codigoProducto').change(function() {
            var codigo = $(this).val();
            if (codigo) {
                $.ajax({
                    url: '/obtenerDetallesProducto/' + codigo,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#detallesProducto').html(
                            '<p>Nombre: ' + data.nombreProducto + '</p>' +
                            '<p>Precio: ' + data.precioProducto + '</p>' +
                            '<p>Descripción: ' + data.descripcionProducto + '</p>'
                        );
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener los detalles del producto: " + textStatus, errorThrown);
                    }
                });
            } else {
                $('#detallesProducto').empty();
            }
        });

        // Manejar cambio en el usuario seleccionado
        $('#id_cliente').change(function() {
            var idCliente = $(this).val();
            if (idCliente) {
                $.ajax({
                    url: '/obtenerAsesor/' + idCliente,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#asesorCliente').val(data.nombreAsesor + ' ' + data.apellidoAsesor);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener el asesor: " + textStatus, errorThrown);
                    }
                });
            } else {
                $('#asesorCliente').val('');
            }
        });

        @if(Session::has('success'))
        Swal.fire({
            title: "¡Éxito!", 
            text: "{{ Session::get('success') }}", 
            icon: "success"
        });
        @endif
        
        @if(Session::has('error'))
        Swal.fire({
            title: "Error",
            text: "{{ Session::get('error') }}",
            icon: "error"
        });
        @endif
    });
</script>
@endsection
