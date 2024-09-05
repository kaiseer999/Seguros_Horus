@extends('layouts.app')

@section('content')
<h1>Prima</h1>
<div class="container">
    <div class="card mx-auto">
        <div class="card-header">
            <h2 class="card-title">Primas recientes</h2>
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#crearPrimaModal">
                Crear prima
            </button>
            {{--  Modal crear  --}}
            <div class="modal fade" id="crearPrimaModal" tabindex="-1" aria-labelledby="crearPrimaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearPrimaModalLabel">Crear prima</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{url('/prima')}}" method="POST">
                                @csrf
                                <label for="AnioPago" class="form-label">Año de pago</label>
                                <input type="text" class="form-control" id="AnioPago" name="AnioPago">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="id_EmpleadoNomina" class="form-label">Seleccionar</label>
                                        <select class="form-select" id="id_EmpleadoNomina" name="id_EmpleadoNomina">
                                            <option selected>Selecciona el empleado</option>
                                            @foreach($empleados as $empleado)
                                            <option value="{{ $empleado->id_EmpleadoNomina }}">{{ $empleado->nombreEmpleadoNom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="PeriodoPago" class="form-label">Período de pago</label>
                                        <select class="form-select" id="PeriodoPago" name="PeriodoPago">
                                            <option value="primer_semestre">Enero - Junio</option>
                                            <option value="segundo_semestre">Julio - Diciembre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="SalarioEmpleado" class="form-label">Salario mensual del empleado</label>
                                        <input type="text" class="form-control" id="SalarioEmpleado" name="SalarioEmpleado" readonly>
                                    </div>

                                    <div class="row">
                                      
                                        <div class="col-md-4 mb-3">
                                          <label for="DiasLaborados" class="form-label">Días laborados hasta el momento</label>
                                          <input type="text" class="form-control" id="DiasLaborados" name="DiasLaborados" readonly> 
                                      </div>

                                      <div class="col-md-4 mb-3">
                                        <label for="AuxTransEmp" class="form-label">Auxilio de transporte actual</label>
                                        <input type="text" class="form-control" id="AuxTransEmp" name="AuxTransEmp" >
                                      </div>

                                      <div class="col-md-4 mb-3">
                                        <label for="Prima" class="form-label">Prima a pagar</label>
                                        <input type="text" class="form-control" id="Prima" name="Prima" readonly>
                                      </div>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

            <table class="table table-hover" id="primas">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">Semestre de pago</th>
                    <th scope="col">Dias Laborados</th>
                    <th scope="col">Auxilio de Transporte</th>
                    <th scope="col">Total Pago</th>
                    <th scope="col">Acciones</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach($primas as $prima)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{ $prima->empleado->nombreEmpleadoNom }}</td> <!-- Ejemplo de acceso a un campo relacionado -->
                    <td>
                       
                        @if($prima->periodoPago == "primer_semestre")
                            Prima primer semestre de
                        @else
                            Prima segundo semestre de
                        @endif
                        {{ $prima->AnoPago }}  
                    </td>
                    
                    <td>{{$prima->diasLaborados}}</td>
                    <td>{{ number_format($prima->AuxTransporte, 0, ',', '.') }}</td>
                    <td>{{ number_format($prima->TotalPagoPrima, 0, ',', '.') }}</td>

                    <td>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#ModalEditarVacaciones">  
                                <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                            </button>
                            
                            <div class="me-2">
                                <button class="btn btn-link">
                                    <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                </button>
                            </div>
                            
                            <div>
                                <button class="btn btn-link">
                                    <i class="fa-solid fa-circle-info fa-lg" title="Detalles"></i>
                                </button>
                            </div>
                        </div>                                
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


    $('#primas').DataTable({
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



  document.addEventListener('DOMContentLoaded', function() {
    const id_EmpleadoNomina = document.getElementById('id_EmpleadoNomina');
    const anioInput = document.getElementById('AnioPago');
    const periodoInput = document.getElementById('PeriodoPago');
    const auxTransInput = document.getElementById('AuxTransEmp');
    const primaInput = document.getElementById('Prima');

    id_EmpleadoNomina.addEventListener('change', actualizarDatos);
    anioInput.addEventListener('input', actualizarDatos);
    periodoInput.addEventListener('change', actualizarDatos);
    auxTransInput.addEventListener('input', calcularPrima);

    function actualizarDatos() {
        const empleadoId = id_EmpleadoNomina.value;
        const anio = anioInput.value;
        const periodo = periodoInput.value;

        if (empleadoId && anio && periodo) {
            // Realizar una solicitud AJAX para obtener los datos del empleado
            $.ajax({
                url: `/datosPrima/${empleadoId}/${anio}/${periodo}`,
                type: 'GET',
                success: function(response) {
                    document.getElementById('SalarioEmpleado').value = response.salario || '';
                    document.getElementById('DiasLaborados').value = response.diasTrabajados || '';
                    calcularPrima(); // Llamar a la función para calcular la prima
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // Manejar errores si es necesario
                }
            });
        }
    }

    function calcularPrima() {
        const auxTrans = parseFloat(auxTransInput.value) || 0;
        const salario = parseFloat(document.getElementById('SalarioEmpleado').value) || 0;
        const diasLaborados = parseFloat(document.getElementById('DiasLaborados').value) || 0;

        const base = auxTrans + salario;

        // Realizar el cálculo de la prima (ejemplo: simplemente suma auxilio de transporte y salario)
        const primaCalculada = (base*diasLaborados)/360;





        // Mostrar el resultado en el campo de Prima a pagar
        primaInput.value = primaCalculada.toFixed(0); // Ajustar el resultado según sea necesario
    }
});

</script>
@endsection
