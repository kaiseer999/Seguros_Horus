@extends('layouts.app') 

@section('content')
    <div class="container">
        <h1>Detalles del Empleado</h1>

        <div>
            <p><strong>Nombre:</strong> {{ $empleado->nombreEmpleadoNom }}</p>
            <p><strong>Cargo:</strong> {{ $empleado->infoEmpleadoAdminNomina->CargoNomina->nombreCargo }}</p>
            <p><strong>Estado Civil:</strong> {{ $empleado->EstadoCivilNomina->nombreEstadoCivil }}</p>
            <!-- Aquí muestra más detalles según sea necesario -->
        </div>
    </div>
@endsection

