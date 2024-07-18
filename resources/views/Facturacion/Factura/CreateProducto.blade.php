@extends('layouts.app')

@section('content')

<style>
    /* Estilos para ocultar el navbar */
    body {
        padding-top: 0; /* Asegura que el contenido comience desde arriba */
    }

    .navbar {
        display: none; /* Oculta completamente el navbar */
    }
</style>

<h1>Crear producto</h1>

<div class="container">

    <form action="{{ url('/producto/create') }}" method="POST">
        @csrf    
        <label for="nombreProducto" class="form-label">Nombre del producto</label>
        <input type="text" name="nombreProducto" id="nombreProducto" class="form-control" required>
    
        <label for="precioProducto" class="form-label">Precio del producto</label>
        <input type="text" name="precioProducto" id="precioProducto" class="form-control" required>
    
        <br>
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
</script>

@endsection