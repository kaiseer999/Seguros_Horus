@extends('layouts.app')

@section('content')

<h1>Test</h1>

<div class="container justify-content-center">

    <form action="{{url('/facturas')}}" method="POST">
        @csrf  
        <div class="row mb-3">
            <div class="col-6">
                <label for="fecha_Pago" class="form-label">Fecha de pago</label>
                <input type="date" name="fecha_Pago" id="fecha_Pago" value="{{ now()->format('Y-m-d') }}" class="form-control">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-6">
                <label for="fecha_Vencimiento" class="form-label">Fecha de vencimiento</label>
                <input type="date" name="fecha_Vencimiento" id="fecha_Vencimiento" class="form-control">
            </div>
        </div>

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

        <!-- Campo oculto para enviar el precio del producto -->
        <input type="hidden" name="precioProducto" id="precioProductoHidden">

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

        <!-- Campo oculto para el idAsesor -->
        <input type="hidden" name="idAsesor" id="idAsesor">

        <div class="row mb-3">
            <div class="col-6">
                <label for="FormaPago" class="form-label">Forma de pago</label>
                <select class="form-select" id="FormaPago" name="FormaPago" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    @foreach($formas as $forma)
                        <option value="{{ $forma->idFormaPago }}">{{ $forma->nombreFormaPago }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="Observacion" class="form-label">Observaciones</label>
                <textarea name="Observacion" id="Observacion" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>

        <button class="btn btn-success">Crear</button>

    </form>

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
        // Inicializar Select2
        $('.js-example-basic-single').select2();

        // Función para establecer la fecha de vencimiento un año después de la fecha de pago
        function actualizarFechaVencimiento() {
            var fechaPago = new Date($('#fecha_Pago').val());
            if (!isNaN(fechaPago)) {
                var fechaVencimiento = new Date(fechaPago);
                fechaVencimiento.setFullYear(fechaPago.getFullYear() + 1);
                var day = String(fechaVencimiento.getDate()).padStart(2, '0');
                var month = String(fechaVencimiento.getMonth() + 1).padStart(2, '0');
                var year = fechaVencimiento.getFullYear();
                var formattedDate = year + '-' + month + '-' + day;
                $('#fecha_Vencimiento').val(formattedDate);
            }
        }

        // Actualizar fecha de vencimiento cuando cambia la fecha de pago
        $('#fecha_Pago').change(function() {
            actualizarFechaVencimiento();
        });

        // Establecer fecha de vencimiento al cargar la página
        actualizarFechaVencimiento();

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

                        if (tipo === '2') {
                            $('#campoAdicional').show();
                            $('#codigoProducto').val('42').trigger('change');
                        } else {
                            $('#campoAdicional').hide();
                        }

                        $('#codigoProducto').trigger('change');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener los productos: " + textStatus, errorThrown);
                    }
                });
            } else {
                $('#codigoProducto').empty().append('<option value="">Selecciona un producto</option>');
                $('#codigoProducto').trigger('change');
                $('#campoAdicional').hide();
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
                        // Actualizar detalles del producto
                        $('#detallesProducto').html(
                            '<p>Nombre: ' + data.nombreProducto + '</p>' +
                            '<p id="precioProducto" data-precio="' + data.precioProducto + '">Precio: ' + data.precioProducto.toLocaleString('es-CO') + '</p>' +
                            '<p>Descripción: ' + data.descripcionProducto + '</p>'
                        );
                        
                        // Actualizar el campo oculto con el precio del producto
                        $('#precioProductoHidden').val(data.precioProducto);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener los detalles del producto: " + textStatus, errorThrown);
                    }
                });
            } else {
                $('#detallesProducto').empty();
                $('#precioProductoHidden').val('');
            }
        });

        // Manejar cambio en el valor adicional
        $('#valorAdicional').on('input', function() {
            var valorAdicional = parseFloat($(this).val()) || 0;
            var precioProducto = parseFloat($('#precioProducto').data('precio')) || 0;
            var precioTotal = precioProducto + valorAdicional;
            $('#precioProducto').text('Precio: ' + precioTotal.toLocaleString('es-CO'));
            $('#precioProductoHidden').val(precioTotal); // Actualizar el campo oculto con el precio total
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
                        $('#idAsesor').val(data.idAsesorComercial);  // Actualizar el campo oculto con el idAsesor
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error al obtener los datos del asesor: " + textStatus, errorThrown);
                    }
                });
            } else {
                $('#asesorCliente').val('');
                $('#idAsesor').val('');  // Limpiar el campo oculto con el idAsesor
            }
        });

    });
</script>
@endsection
