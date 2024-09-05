@extends('layouts.app')

@section('content')

<h1>VACACIONES</h1>

<div class="container">
  <div class="card mx-auto">
    <div class="card-header">
      <h2 class="card-title">Vacaciones recientes</h2>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      {{-- Button to open the modal --}}
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalCrearVacaciones">
        Crear Vacaciones
      </button>

      {{-- Modal --}}
      <div class="modal fade" id="ModalCrearVacaciones" tabindex="-1" aria-labelledby="ModalCrearVacacionesLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="ModalCrearVacacionesLabel">Crear Vacaciones</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{url('/vacaciones')}}" method="POST">
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
                    <input type="text" class="form-control" id="dias_vacaciones" name="dias_vacaciones" required>
                  </div>



                  <div class="col mb-3">
                    <label for="dias_descanso" class="form-label">Días descanso</label>
                    <input type="text" class="form-control"  id="dias_descanso" name="dias_descanso" required>
                  </div>
                </div>

                <div class="col mb-3">
                  <label for="pago_vacaciones" class="form-label">Monto a pagar</label>
                  <input type="text" class="form-control" id="pago_vacaciones" name="pago_vacaciones" required readonly>
                </div>


                  <label for="Observacion">Observacion</label>
                  <textarea class="form-control" placeholder="Realiza una observacion..." name="Observacion" id="Observacion"></textarea>
                  
                


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-success">Crear</button>
                </div>


              </form>
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
            <th scope="col">Fecha de vacaciones</th>
            <th scope="col">Días de Vacaciones</th>
            <th scope="col">Días Pagados</th>
            <th scope="col">Monto Pagado</th>
            <th scope="col">Observacion</th>
            <th scope="col">Acciones</th>
          </tr>
          
        </thead>
        <tbody>
          @foreach ($vacaciones as $vacacion)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $vacacion->empleado->nombreEmpleadoNom }}</td>
            <td>{{ $vacacion->fecha_salida }}</td>
            <td>{{ $vacacion->dias_vacaciones }}</td>
            <td>{{ $vacacion->dias_descanso }}</td>
            <td>{{ number_format($vacacion->pago_vacaciones, 0, ',', '.') }}</td>
            <td>{{$vacacion->Observacion}}</td>
            <td class="d-flex">


              {{--  Modal de editar  --}}
              <div class="me-2"> 
                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#ModalEditarVacaciones{{$vacacion->idVacacionesEmpleados}}">  
                    <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                </button>
            
                {{-- Modal editar --}}
                <div class="modal fade" id="ModalEditarVacaciones{{$vacacion->idVacacionesEmpleados}}" tabindex="-1" aria-labelledby="ModalEditarVacaciones{{$vacacion->idVacacionesEmpleados}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalEditarVacaciones{{$vacacion->idVacacionesEmpleados}}Label">
                                    Editar Vacaciones de {{$vacacion->empleado->nombreEmpleadoNom}}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                {{-- Formulario editar --}}
                                <form action="{{ url('/vacaciones/' . $vacacion->idVacacionesEmpleados) }}" method="POST">
                                    @csrf
                                    @method('PUT') 
                                    <input type="hidden" name="idVacacionesEmpleados" value="{{ $vacacion->idVacacionesEmpleados }}">
            
                                    <div class="row">
                                        {{-- Select empleado --}}
                                        <div class="col mb-3">
                                          <label for="id_EmpleadoNomina" class="form-label">Empleado</label>
                                          <select class="form-select" name="id_EmpleadoNomina" id="id_EmpleadoNomina" disabled>
                                              <option value="{{ $vacacion->id_EmpleadoNomina }}" selected>{{ $vacacion->empleado->nombreEmpleadoNom }}</option>
                                              @foreach ($empleados as $empleado)
                                              <option value="{{ $empleado->id_EmpleadoNomina }}">{{ $empleado->nombreEmpleadoNom }}</option>
                                              @endforeach
                                          </select>
                                          <input type="hidden" name="id_EmpleadoNomina" value="{{ $vacacion->id_EmpleadoNomina }}">
                                      </div>
                                      
            
                                        {{-- Fecha inicio --}}
                                        <div class="col mb-3">
                                            <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $vacacion->fecha_inicio }}" required>
                                        </div>
            
                                        {{-- Fecha final --}}
                                        <div class="col mb-3">
                                            <label for="fecha_salida" class="form-label">Fecha de vacaciones</label>
                                            <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" value="{{ $vacacion->fecha_salida }}" required>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="dias_trabajados" class="form-label">Días trabajados</label>
                                            <input type="text" class="form-control" id="dias_trabajados" name="dias_trabajados" value="{{ $vacacion->dias_trabajados }}" required readonly>
                                        </div>
            
                                        <div class="col mb-3">
                                            <label for="dias_vacaciones" class="form-label">Días vacaciones</label>
                                            <input type="text" class="form-control" id="dias_vacaciones" name="dias_vacaciones" value="{{ $vacacion->dias_vacaciones }}" required>
                                        </div>
            
                                        <div class="col mb-3">
                                            <label for="dias_descanso" class="form-label">Días descanso</label>
                                            <input type="text" class="form-control" id="dias_descanso" name="dias_descanso" value="{{ $vacacion->dias_descanso }}" required>
                                        </div>
                                    </div>
            
                                    <div class="col mb-3">
                                        <label for="pago_vacaciones" class="form-label">Monto a pagar</label>
                                        <input type="text" class="form-control" id="pago_vacaciones" name="pago_vacaciones" value="{{ $vacacion->pago_vacaciones }}" required readonly>
                                    </div>
            
                                    <label for="Observacion">Observación</label>
                                    <textarea class="form-control" placeholder="Realiza una observación..." name="Observacion" id="Observacion">{{ $vacacion->Observacion }}</textarea>
            
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Final editar --}}
             </div>
            




              <div>
                  <button class="btn btn-link">
                      <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                  </button>
              </div>
              <div>
                <button class="btn btn-link">
                  <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                </button>
            </div>
          </td>
          
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    </div>
    {{--  end body  --}}
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
              <p id="salarioEmpleado" data-salary="${data.SalarioEmpleadoNom}"><strong>Salario:</strong> ${data.SalarioEmpleadoNom}</p>
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
    const fechaInicio = document.getElementById("fecha_inicio").value;
    const fechaSalida = document.getElementById("fecha_salida").value;

    if (fechaInicio && fechaSalida) {
        const inicio = new Date(fechaInicio);
        const salida = new Date(fechaSalida);
        const diferenciaMs = salida - inicio;
        const diferenciaDias = Math.ceil(diferenciaMs / (1000 * 60 * 60 * 24));
        document.getElementById("dias_trabajados").value = diferenciaDias;
        document.getElementById("dias_vacaciones").value=30;

    } else {
        console.log("Por favor, complete ambas fechas.");
        document.getElementById("dias_trabajados").value = '';
    }
  }

  document.getElementById("dias_descanso").addEventListener("change", MontoPagar);

  function MontoPagar() {
    const diasDescanso = document.getElementById('dias_descanso').value;
    const salarioEmpleado = document.getElementById('salarioEmpleado').getAttribute('data-salary');

    if (diasDescanso && salarioEmpleado) {
        const diasVacaciones = 30 - diasDescanso; // Restar días de descanso a 30
        const pagoVacaciones = (salarioEmpleado / 30) * diasVacaciones;
        document.getElementById('pago_vacaciones').value = pagoVacaciones.toFixed(0);
        
    } else {
        console.log("Faltan datos para calcular el pago.");
        document.getElementById('pago_vacaciones').value = '';
    }
  }

</script>

@endsection
