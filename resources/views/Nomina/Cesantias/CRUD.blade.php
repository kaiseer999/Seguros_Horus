@extends('layouts.app')

@section('content')

<h1>Cesantias</h1>

<div class="container">
    <div class="card mx-auto">
        <div class="card-header">
            <h2 class="card-title">Cesantias recientes</h2>
        </div>
        <div class="card-body">

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalCrearCesantia">
                Crear cesantias
                </button>

                <div class="modal fade" id="ModalCrearCesantia" tabindex="-1" aria-labelledby="ModalCrearCesantiaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalCrearCesantiaLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <form id="formCesantias" method="POST" action="{{url('cesantias')}}">
                                @csrf
                                <label for="AnioPago" class="form-label">Año de pago</label>
                                <input type="text" class="form-control" id="AnioPago" name="AnioPago">
                            
                                <label for="id_EmpleadoNomina" class="form-label">Seleccionar</label>
                                <select class="form-select" id="id_EmpleadoNomina" name="id_EmpleadoNomina">
                                    <option selected>Selecciona el empleado</option>
                                    @foreach($empleados as $empleado)
                                    <option value="{{ $empleado->id_EmpleadoNomina }}">{{ $empleado->nombreEmpleadoNom }}</option>
                                    @endforeach
                                </select>
                            
                                <label for="DiasLaborados" class="form-label">Días laborados hasta el momento</label>
                                <input type="text" class="form-control" id="DiasLaborados" name="DiasLaborados" readonly>
                            
                                <label for="SalarioEmpleado" class="form-label">Salario mensual del empleado</label>
                                <input type="text" class="form-control" id="SalarioEmpleado" name="SalarioEmpleado" readonly>

                                <label for="AuxTransporte" class="form-label">Auxilio de Transporte mensual del empleado</label>
                                <input type="text" class="form-control" id="AuxTransporte" name="AuxTransporte" >

                                <label for="CesantiasEmpleado" class="form-label">Cesantias del empleado</label>
                                <input type="text" class="form-control" id="CesantiasEmpleado" name="CesantiasEmpleado" readonly>

                                <label for="InteresesCesantiasEmpleado" class="form-label">Intereses de cesantías</label>
                                <input type="text" class="form-control" id="InteresesCesantiasEmpleado" name="InteresesCesantiasEmpleado" readonly>
                                
                                <label for="Observaciones">Observaciones</label>
                                <textarea  class="form-control" placeholder="Realiza una observacion" name="Observaciones" id="Observaciones"></textarea>
                            
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            

                          
                       
                        </div>
                    </div>
                </div>

        </div>


        <div class="table-responsive">

        <table class="table table-striped" id="Cesantias">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Empleado</th>
                <th scope="col">Salario Empleado</th>
                <th scope="col">Dias Trabajados</th>
                <th scope="col">Cesantias Pagadas</th>
                <th scope="col">Intereses Cesantias</th>
                <th scope="col">Observaciones</th>
                <th scope="col">Acciones</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($cesantias as $cesantia)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td scope="row">{{ $cesantia->empleado->nombreEmpleadoNom ?? 'No disponible' }}</td>
                    <td scope="row">{{number_format($cesantia->salarioEmpleado, 0, ',', '.')}}</td>
                    <td scope="row">{{$cesantia->diasLaborados}}</td>
                    <td scope="row">{{number_format($cesantia->totalCesantias, 0, ',', '.')}}</td>
                    <td>{{ number_format($cesantia->interes->valorInteresesCesantias ?? 0, 0, ',', '.') }}</td>
                    <td scope="row">{{$cesantia->Observaciones}}</td>
                    <td >
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn btn-link me-2" data-bs-toggle="modal" data-bs-target="#ModalEditarCensatia{{$cesantia->IdCesantiasEmpleado}}">
                                <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                            </button>
            
                            <!-- Modal para cada registro de cesantías -->
                            <div class="modal fade" id="ModalEditarCensatia{{$cesantia->IdCesantiasEmpleado}}" tabindex="-1" aria-labelledby="ModalEditarCensatiaLabel{{$cesantia->IdCesantiasEmpleado }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ModalEditarCensatiaLabel{{$cesantia->IdCesantiasEmpleado}}">
                                                Editar cesantías de {{ $cesantia->empleado->nombreEmpleadoNom ?? 'No disponible' }} 
                                                (ID: {{ $cesantia->IdCesantiasEmpleado }})
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="formCesantias{{$cesantia->IdCesantiasEmpleado}}" method="POST" action="{{ url('cesantias', $cesantia->IdCesantiasEmpleado) }}">
                                                @csrf
                                                @method('PUT')
            
                                                <!-- Año de pago -->
                                                <label for="AnioPago" class="form-label">Año de pago</label>
                                                <input type="text" class="form-control" id="AnioPago{{$cesantia->IdCesantiasEmpleado}}" name="AnioPago" value="{{ $cesantia->AnioPago ?? '' }}">
            
                                                <!-- Selección de empleado -->
                                                <label for="id_EmpleadoNomina" class="form-label">Seleccionar empleado</label>
                                                <select class="form-select" id="id_EmpleadoNomina{{$cesantia->IdCesantiasEmpleado}}" name="id_EmpleadoNomina">
                                                    <option selected>Selecciona el empleado</option>
                                                    @foreach($empleados as $empleado)
                                                        <option value="{{ $empleado->id_EmpleadoNomina }}" {{ $cesantia->id_EmpleadoNomina == $empleado->id_EmpleadoNomina ? 'selected' : '' }}>
                                                            {{ $empleado->nombreEmpleadoNom }}
                                                        </option>
                                                    @endforeach
                                                </select>
            
                                                <!-- Días laborados (campo de solo lectura) -->
                                                <label for="DiasLaborados" class="form-label">Días laborados</label>
                                                <input type="text" class="form-control" id="DiasLaborados{{$cesantia->IdCesantiasEmpleado}}" name="DiasLaborados" value="{{ $cesantia->diasLaborados }}" readonly>
            
                                                <!-- Salario del empleado (campo de solo lectura) -->
                                                <label for="SalarioEmpleado" class="form-label">Salario mensual</label>
                                                <input type="text" class="form-control" id="SalarioEmpleado{{$cesantia->IdCesantiasEmpleado}}" name="SalarioEmpleado" value="{{ $cesantia->salarioEmpleado }}" readonly>
            
                                                <!-- Auxilio de transporte -->
                                                <label for="AuxTransporte" class="form-label">Auxilio de transporte</label>
                                                <input type="text" class="form-control" id="AuxTransporte{{$cesantia->IdCesantiasEmpleado}}" name="AuxTransporte" value="{{ old('AuxTransporte', $cesantia->auxTransporte ?? '') }}">
            
                                                <!-- Cesantías (campo de solo lectura) -->
                                                <label for="CesantiasEmpleado" class="form-label">Cesantías</label>
                                                <input type="text" class="form-control" id="CesantiasEmpleado{{$cesantia->IdCesantiasEmpleado}}" name="CesantiasEmpleado" value="{{ $cesantia->totalCesantias }}" readonly>
            
                                                <!-- Intereses sobre cesantías (campo de solo lectura) -->
                                                <label for="InteresesCesantiasEmpleado" class="form-label">Intereses de cesantías</label>
                                                <input type="text" class="form-control" id="InteresesCesantiasEmpleado{{$cesantia->IdCesantiasEmpleado}}" name="InteresesCesantiasEmpleado" value="{{ $cesantia->interes->valorInteresesCesantias  }}" readonly>
            
                                                <!-- Observaciones -->
                                                <label for="Observaciones" class="form-label">Observaciones</label>
                                                <textarea class="form-control" placeholder="Realiza una observación" name="Observaciones" id="Observaciones{{$cesantia->IdCesantiasEmpleado}}">{{ old('Observaciones', $cesantia->Observaciones ?? '') }}</textarea>
            
                                                <!-- Footer del modal con los botones -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       


                    
                            <form id="deleteForm{{$cesantia->IdCesantiasEmpleado}}" action="{{ url('/cesantias/'.$cesantia->IdCesantiasEmpleado) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-link" title="Borrar" onclick="confirmDelete({{ $cesantia->IdCesantiasEmpleado }})">
                                    <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                </button>
                            </form>
                     



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
</div>


@endsection


@section('js')
<script>

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




        $('#Cesantias').DataTable({
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


          function confirmDelete(idCesantiaEmpleado) {
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
                    document.getElementById('deleteForm' + idCesantiaEmpleado).submit();
                }
            });
        }






    document.addEventListener('DOMContentLoaded', function() {
        

        document.getElementById('id_EmpleadoNomina').addEventListener('change', ObtenerDatosEmpleado);
        document.getElementById('AnioPago').addEventListener('input', ObtenerDatosEmpleado);
        document.getElementById('AuxTransporte').addEventListener('input', CalcularCesantias);
        document.getElementById('DiasLaborados').addEventListener('input', CalcularInteresesCesantias);
        document.getElementById('CesantiasEmpleado').addEventListener('input', CalcularInteresesCesantias);

        function ObtenerDatosEmpleado() {
            const empleadoId = document.getElementById('id_EmpleadoNomina').value;
            const anio = document.getElementById('AnioPago').value;

            if (empleadoId && anio) {
                $.ajax({
                    url: `/infoEmpleadoCesantias/${empleadoId}/${anio}`,
                    type: 'GET',
                    success: function(response) {
                        document.getElementById('SalarioEmpleado').value = response.salario || '';
                        document.getElementById('DiasLaborados').value = response.diasTrabajados || '';
                        CalcularCesantias(); // Actualiza el cálculo de cesantías al recibir datos
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        }

        function CalcularCesantias() {
            const auxTransMen = parseFloat(document.getElementById('AuxTransporte').value) || 0;
            const salarioEmpleado = parseFloat(document.getElementById('SalarioEmpleado').value) || 0;
            const diasAnio = parseFloat(document.getElementById('DiasLaborados').value) || 0;
            
            const salarioAnio = auxTransMen + salarioEmpleado;
            const cesantias = (salarioAnio * diasAnio) / 360;

            document.getElementById('CesantiasEmpleado').value = cesantias.toFixed(0); // Opcional: limitar a 2 decimales
            CalcularInteresesCesantias(); // Actualiza el cálculo de intereses
        }

        function CalcularInteresesCesantias() {
            const cesantias = parseFloat(document.getElementById('CesantiasEmpleado').value) || 0;
            const diasAnio = parseFloat(document.getElementById('DiasLaborados').value) || 0;

            const intereses = (cesantias * 0.12 * diasAnio) / 360;

            document.getElementById('InteresesCesantiasEmpleado').value = intereses.toFixed(0); // Redondear a 0 decimales
        }
    });

</script>

@endsection