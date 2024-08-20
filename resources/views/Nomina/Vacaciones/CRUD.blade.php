@extends('layouts.app')

@section('content')

<h1>VACACIONES</h1>

<div class="container">
  <div class="card mx-auto">
    <div class="card-header">
      <h2 class="card-title">Vacaciones recientes</h2>
    </div>
    <div class="card-body">

      {{-- Button to open the modal --}}
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Crear Vacaciones
      </button>

      {{-- Modal --}}
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Vacaciones</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST">
                @csrf
                <div class="row">

                  {{-- Select empleado --}}
                  <div class="col mb-3">
                    <label for="id_EmpleadoNomina" class="form-label">Empleado</label>
                    <select class="form-select" name="id_EmpleadoNomina" id="id_EmpleadoNomina">
                      <option selected>Seleccionar Empleado</option>
                      @foreach ($empleados as $empleado)
                      <option value="{{ $empleado->id_EmpleadoNomina }}">{{ $empleado->nombreEmpleadoNom }}</option>
                      @endforeach
                    </select>
                  </div>

                  {{-- Display area for employee info --}}
                  <div id="displayArea" class="mb-3"></div>

                  {{-- Fecha inicio --}}
                  <div class="col mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                  </div>

                  {{-- Fecha final --}}
                  <div class="col mb-3">
                    <label for="fecha_salida" class="form-label">Fecha de vacaciones</label>
                    <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required>
                  </div>

                </div>

                <div class="row">
                  <div class="col mb-3">
                    <label for="dias_trabajados" class="form-label">Días trabajados</label>
                    <input type="text" class="form-control" id="dias_trabajados" name="dias_trabajados" required readonly>
                  </div>


                  <div class="col mb-3">
                    <label for="dias_vacaciones" class="form-label">Días vacaciones</label>
                    <input type="text" class="form-control" id="dias_vacaciones" name="dias_vacaciones" required readonly>
                  </div>

                  <div class="col mb-3">
                    <label for="pago_vacaciones" class="form-label">Monto a pagar</label>
                    <input type="text" class="form-control" id="pago_vacaciones" name="pago_vacaciones" required readonly>
                  </div>
                </div>

                
              

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      {{-- Tabla --}}
      <table class="table table-hover" id="vacaciones">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre Empleado</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Fin</th>
            <th scope="col">Días de Vacaciones</th>
            <th scope="col">Días Pagados</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($vacaciones as $vacacion)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $vacacion->empleado->nombreEmpleadoNom }}</td>
            <td>{{ $vacacion->fecha_inicio }}</td>
            <td>{{ $vacacion->fecha_fin }}</td>
            <td>{{ $vacacion->dias_vacaciones }}</td>
            <td>{{ $vacacion->dias_pagados }}</td>
            <td>
              <button class="btn btn-info">Editar</button>
              <button class="btn btn-danger">Eliminar</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      

    </div>
  </div>
</div>

@endsection

@section('js')

<script>


  $(document).ready(function() {

    {{--    DATATABLE  --}}
    $('#vacaciones').DataTable({
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

    {{--  AJAX PARA OBTENER INFO EMPLEADO  --}}
    $('#id_EmpleadoNomina').on('change', function() {
      const idEmpleado = $(this).val();
      const displayArea = $('#displayArea');

      if(idEmpleado) {
        $.ajax({
          url: '/datosempleado/' + idEmpleado,
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            const contentToShow = `
              <h4>Información del Empleado</h4>
              <p><strong>Nombre:</strong> ${data.nombreEmpleadoNom}</p>
              <p><strong>Fecha de Ingreso:</strong> ${data.fechaingreso}</p>
              <p id="salarioEmpleado"><strong>Salario:</strong> ${data.SalarioEmpleadoNom}</p>

            `;

            document.getElementById("fecha_inicio").value = data.fechaingreso;
            

            displayArea.html(contentToShow);
          },
          error: function() {
            displayArea.html('<p>Error al obtener la información del empleado.</p>');
          }
        });
      } else {
        displayArea.html('');
      }
    });
  });

  document.getElementById("fecha_salida").addEventListener("change", calcularDias);
  document.getElementById("fecha_inicio").addEventListener("change", calcularDias);

function calcularDias() {
    // Obtener las fechas de los campos de entrada
    const fechaInicio = document.getElementById("fecha_inicio").value;
    const fechaSalida = document.getElementById("fecha_salida").value;

    // Verificar que ambos campos tienen valores
    if (fechaInicio && fechaSalida) {
        // Convertir las fechas a objetos Date
        const inicio = new Date(fechaInicio);
        const salida = new Date(fechaSalida);

        // Calcular la diferencia en milisegundos
        const diferenciaMs = salida - inicio;

        // Convertir la diferencia de milisegundos a días
        const diferenciaDias = Math.ceil(diferenciaMs / (1000 * 60 * 60 * 24));

        // Mostrar la diferencia en días en el campo de entrada
        document.getElementById("dias_trabajados").value = diferenciaDias;
    } else {
        console.log("Por favor, complete ambas fechas.");
        document.getElementById("dias_trabajados").value = '';
    }
}

var prueba = document.getElementById("salarioEmpleado").value;

console.log("hii")
console.log(prueba);


  {{--  document.getElementById("dias_vacaciones").addEventListener("change", MontoPagar);


function MontoPagar(){

  const

}  --}}




  






</script>

@endsection


