<!DOCTYPE html>
<html>
<head>
    <title>Recibo de Nómina</title>
</head>
<body>
    <h1>Recibo de Nómina</h1>
    <p>Fecha de Pago: {{ $fechaDePagoNom }}</p>
    <p>Sueldo Bruto: {{ $SueldoBruto }}</p>
    <p>Días Laborados: {{ $DiasLaborados }}</p>
    <p>Auxilio de Transporte: {{ $AuxiliodeTransporte }}</p>
    <p>Horas Extras: {{ $HorasExtras }}</p>
    <p>Sueldo Neto: {{ $SueldoNeto }}</p>

    <h2>Información del Empleado</h2>
    <p>Nombre: {{ $empleadoNomina->nombre }}</p>
    <p>Cargo: {{ $empleadoNomina->cargo }}</p>
    <p>Identificación: {{ $empleadoNomina->identificacion }}</p>

    <h3>Deducciones:</h3>
    <ul>
        @foreach ($deducciones as $deduccion)
            <li>{{ $deduccion }}</li>
        @endforeach
    </ul>
</body>
</html>
