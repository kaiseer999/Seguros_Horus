@extends('layouts.app')

@section('content')

<h1>Gestión de Nóminas</h1>

<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h2 class="card-title">Pagadas Recientemente</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#crearNominaModal">
                        Crear Nómina
                    </button>
                    
                    <div class="modal fade" id="crearNominaModal" tabindex="-1" aria-labelledby="crearNominaModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearNominaModalLabel">Crear Nómina</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Contenido del formulario para crear la nómina -->
                                    <form action="{{url('/nomina')}}" id="FrmNomina" method="POST" >
                                        @csrf
                                        <div class="mb-3 row">
                                            <!-- Fecha de pago -->
                                            <div class="col-md-4">
                                                <label for="fechaDePagoNom" class="form-label">Fecha de pago</label>
                                                <input type="date" class="form-control" name="fechaDePagoNom" id="fechaDePagoNom" value="{{ date('Y-m-d') }}" readonly>
                                            </div>
                                            <!-- Empleado -->
                                            <div class="col-md-4">
                                                <label for="EmpleadoSelect" class="form-label">Empleado</label>
                                                <select class="form-select" id="EmpleadoSelect" name="id_EmpleadoNomina" aria-label="Default select example" onchange="actualizarDatosEmpleado()" required>
                                                    <option selected>Selecciona...</option>
                                                    @foreach($empleados as $empleado)
                                                        <option value="{{$empleado->id_EmpleadoNomina}}">{{$empleado->nombreEmpleadoNom}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Dias Laborados -->
                                            <div class="col-md-4">
                                                <label for="DiasLaborados" class="form-label">Dias Laborados</label>
                                                <input type="text" class="form-control" id="DiasLaborados" name="DiasLaborados" required>
                                            </div>
                                        </div>
                                    
                                        <div class="mb-3 row">
                                            <!-- Salario del Empleado -->
                                            <div class="col-md-4">
                                                <label for="SalarioEmpleado" class="form-label">Salario del Empleado</label>
                                                <input type="text" class="form-control" id="SalarioEmpleado" name="salarioEmpleadoNom" required>
                                            </div>
                                            <!-- Auxilio de transporte devengado -->
                                            <div class="col-md-4">
                                                <label for="AuxiliodeTransporte" class="form-label">Auxilio de transporte devengado</label>
                                                <input type="text" class="form-control" name="AuxiliodeTransporte" id="AuxiliodeTransporte" required>
                                            </div>
                                            <!-- Auxilio de transporte legal -->
                                            <div class="col-md-4">
                                                <label for="Auxtrans" class="form-label">Auxilio de transporte legal</label>
                                                <input type="text" class="form-control" value="162000" id="Auxtrans" name="Auxtrans" required>
                                            </div>
                                        </div>
                                    
                                        <div class="mb-3 row">
                                            <!-- Horas extras -->
                                            <div class="col-md-4">
                                                <label for="NumeroHoras" class="form-label">Horas extras</label>
                                                <input type="text" class="form-control" name="NumeroHoras" id="NumeroHoras" required>
                                            </div>
                                            <!-- Valor Horas Extras -->
                                            <div class="col-md-4">
                                                <label for="HorasExtras" class="form-label">Valor Horas Extras</label>
                                                <input type="text" class="form-control" name="HorasExtras" id="HorasExtras" required>
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <label for="SueldoBruto" class="form-label">Sueldo Bruto</label>
                                                <input type="text" class="form-control" name="SueldoBruto" id="SueldoBruto" required>
                                            </div>

                                        </div>
                                    
                                        
                                        
                                    
                                        <h1>Deducciones</h1>
                                        <div class="mb-3 row">
                                            @foreach ($tiposdedu as $tipodedu)
                                            <div class="col-md-12">
                                                <label for="deducciones[{{$tipodedu->idTipoDeduccionesNomina}}][valor]" class="form-label">{{$tipodedu->nombreTipoDeduccion}}</label>
                                                <input type="hidden" name="deducciones[{{$tipodedu->idTipoDeduccionesNomina}}][idDeduccion_EmpNom]" value="{{$tipodedu->idTipoDeduccionesNomina}}">
                                                <input type="text" class="form-control input-sueldo-neto" name="deducciones[{{$tipodedu->idTipoDeduccionesNomina}}][ValorDescuento]" id="deduccion_{{$tipodedu->idTipoDeduccionesNomina}}" required>
                                            </div>
                                            @endforeach
                                        </div>
                                        
                                    
                                        
                                        <h1>Sueldo a pagar</h1>
                                        <div class="col-md-12">
                                            <label for="SueldoNeto" class="form-label">Sueldo Neto</label>
                                            <input type="text" class="form-control" name="SueldoNeto" id="SueldoNeto" required>
                                        </div>

                                        <!-- Tipo de pago -->
                                        <div class="col-md-12">
                                            <label for="TPagoSelect" class="form-label">Tipo de pago</label>
                                            <select class="form-select" id="TPagoSelect" name="idTipoPagoNomina" aria-label="Default select example" required>
                                                <option selected>Selecciona...</option>
                                                @foreach($tiposPago as $tpago)
                                                    <option value="{{$tpago->idTipoPagoNomina}}">{{$tpago->nombreTipoPago}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </form>
                                    
                                    
                                    
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success"  onclick="submitForm('FrmNomina')">Guardar Nómina</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function submitForm(formId){
                          document.getElementById(formId).submit();
                        }
  
                      </script>
                    


                    <br>
                    <br>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sueldo Bruto</th>
                            <th>Fecha de Pago</th>
                            <th>Empleado</th>
                            <th>Tipo de Pago</th>
                            <th>Auxilio de Transporte</th>
                            <th>Horas Extras</th>
                            <th>Sueldo Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>$1000</td>
                            <td>2024-06-12</td>
                            <td>Nombre del Empleado</td>
                            <td>Tipo de Pago</td>
                            <td>$50</td>
                            <td>2</td>
                            <td>$950</td>
                        </tr>
                        <!-- Aquí puedes agregar más filas con los datos que necesites -->
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


function confirmDelete(idCargoNomina) {
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
            document.getElementById('deleteForm' + idCargoNomina).submit();
        }
    });
  }


  function actualizarDatosEmpleado() {
    var empleadoId = document.getElementById('EmpleadoSelect').value;

    // Realizar una solicitud AJAX para obtener los datos del empleado
    $.ajax({
        url: '/ruta/para/obtener/datos/empleado/' + empleadoId,
        type: 'GET',
        success: function(response) {
            // Actualizar solo el campo del salario del empleado con los datos obtenidos
            document.getElementById('SalarioEmpleado').value = response.SalarioEmpleadoNom;
            
            // Llamar a la función para calcular el sueldo bruto
            calcularSueldoBruto();

            // Actualizar todos los inputs con la clase 'input-sueldo-neto' con el salario obtenido
            var inputsNeto = document.querySelectorAll('.input-sueldo-neto');
            inputsNeto.forEach(function(input, index) {
                if(index<2){
                    input.value = (response.SalarioEmpleadoNom * 0.04)/2; // o cualquier otro cálculo o texto que desees mostrar
                }else if (index == 2 && response.SalarioEmpleadoNom>4600000){
                    input.value= response.SalarioEmpleadoNom*0.01;
                }else{
                    input.value= 0;

                }
            });



            
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Manejar errores si es necesario
        }
    });
}


// Agregar event listeners para calcular el auxilio de transporte y horas extras
document.getElementById('DiasLaborados').addEventListener('input', calcularAuxilioTransporte);
document.getElementById('NumeroHoras').addEventListener('input', calcularHorasExtras);

// Función para calcular el auxilio de transporte
function calcularAuxilioTransporte() {
    var diasLaborados = parseFloat(document.getElementById('DiasLaborados').value);
    var auxTransLegal = parseFloat(document.getElementById('Auxtrans').value);
    var auxTransDevengado = document.getElementById('AuxiliodeTransporte');

    if (!isNaN(diasLaborados) && !isNaN(auxTransLegal)) {
        var resultado = (diasLaborados / 30) * auxTransLegal;
        auxTransDevengado.value = resultado.toFixed(0);
        calcularSueldoBruto();
    }
}

// Función para calcular el valor de las horas extras
function calcularHorasExtras() {
    var HorasExtrasLab = parseFloat(document.getElementById('NumeroHoras').value);
    var SalarioEmpleadoMes = parseFloat(document.getElementById('SalarioEmpleado').value);
    var ValorHoraNormal = SalarioEmpleadoMes / 235; // Asumiendo una jornada laboral estándar
    var RecargoHoraExtra = 1.25; // Asumiendo un recargo del 25% para horas extras
    var HorasExtras = document.getElementById('HorasExtras');

    if (!isNaN(HorasExtrasLab) && !isNaN(SalarioEmpleadoMes)) {
        var resultado = HorasExtrasLab * ValorHoraNormal * RecargoHoraExtra;
        HorasExtras.value = resultado.toFixed(0);
        calcularSueldoBruto();
        calcularSueldoNeto();


    }
}

document.getElementById('HorasExtras').addEventListener('input', calcularSueldoBruto);
document.getElementById('AuxiliodeTransporte').addEventListener('input', calcularSueldoBruto);
document.getElementById('SalarioEmpleado').addEventListener('input', calcularSueldoBruto);

function calcularSueldoBruto() {
    // Obtener los valores de los campos
    var HorasExtras = parseFloat(document.getElementById('HorasExtras').value) || 0;
    var auxTransDevengado = parseFloat(document.getElementById('AuxiliodeTransporte').value) || 0;
    var salarioEmpleadoMes = parseFloat(document.getElementById('SalarioEmpleado').value) || 0;

    var Diast = parseFloat(document.getElementById('DiasLaborados').value) || 0

    // No es necesario verificar si son números válidos ya que estamos usando '|| 0' para asegurar un valor numérico

    // Calcular el sueldo bruto sumando las horas extras, el auxilio de transporte y la mitad del salario del empleado
    var resultado = HorasExtras + auxTransDevengado + ((salarioEmpleadoMes / 30)*Diast);

    // Obtener el campo donde se mostrará el sueldo bruto
    var salarioBruto = document.getElementById('SueldoBruto');

    // Actualizar el valor del campo sueldo bruto con el resultado redondeado
    salarioBruto.value = resultado.toFixed(0);
}



document.addEventListener('DOMContentLoaded', function() {
    // Escuchar cambios en todos los campos input-sueldo-neto
    var inputsNeto = document.querySelectorAll('.input-sueldo-neto');
    inputsNeto.forEach(function(input) {
        input.addEventListener('input', function() {
            calcularSueldoNeto();
        });
    });

    // Calcular el sueldo neto inicialmente al cargar la página
    calcularSueldoNeto();
});

function calcularSueldoNeto() {
    var salarioBruto = parseFloat(document.getElementById('SueldoBruto').value) || 0;
    var deducciones = 0;

    // Iterar sobre todos los campos de deducción
    var inputsNeto = document.querySelectorAll('.input-sueldo-neto');
    inputsNeto.forEach(function(input) {
        deducciones += parseFloat(input.value) || 0;
    });

    var salarioNomina = salarioBruto - deducciones;

    // Actualizar el campo de Sueldo Neto con el resultado
    var sueldoNeto = document.getElementById('SueldoNeto');
    sueldoNeto.value = salarioNomina.toFixed(0); // Puedes ajustar la precisión según tus necesidades

    console.log('Sueldo Neto: ' + salarioNomina);
}




















</script>

@endsection

