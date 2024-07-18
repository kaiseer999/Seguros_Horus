@extends('layouts.app')

@section('content')

<h1>tetst</h1>

<div class="container">

    <div class="row">
        <div class="col-6 mb-3">
            <label for="id_cliente" class="form-label">Seleccionar usuario</label>
            <select class="js-example-basic-single form-control" name="id_cliente" id="id_cliente">
                <option value="">Selecciona un usuario</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-6 mb-3">

            <label for="codigoProducto" class="form-label">Producto a facturar</label>
            <select class="js-example-basic-single form-control" name="codigoProducto" id="codigoProducto">
                <option value="">Selecciona un producto</option>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>

        </div>
    



    </div>
    
    <div class="mb-3 row">
        <div class="col-6">
            <label for="asesorCliente" class="form-label">Asesor del cliente</label>
            <input type="text" name="asesorCliente" id="asesorCliente" class="form-control">
        </div>

       
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
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
</script>
@endsection
