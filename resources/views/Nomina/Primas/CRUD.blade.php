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
            <div class="modal fade" id="crearPrimaModal" tabindex="-1" aria-labelledby="crearPrimaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearPrimaModalLabel">Crear prima</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label for="AnioPago" class="form-label">Año de pago</label>
                                <input type="text" class="form-control" id="AnioPago" name="AnioPago">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="selectEmpleado" class="form-label">Seleccionar</label>
                                        <select class="form-select" id="selectEmpleado" name="selectEmpleado">
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
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const selectEmpleado = document.getElementById('selectEmpleado');
    const anioInput = document.getElementById('AnioPago');
    const periodoInput = document.getElementById('PeriodoPago');
    const auxTransInput = document.getElementById('AuxTransEmp');
    const primaInput = document.getElementById('Prima');

    selectEmpleado.addEventListener('change', actualizarDatos);
    anioInput.addEventListener('input', actualizarDatos);
    periodoInput.addEventListener('change', actualizarDatos);
    auxTransInput.addEventListener('input', calcularPrima);

    function actualizarDatos() {
        const empleadoId = selectEmpleado.value;
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
        const primaCalculada = (base*180)/360;





        // Mostrar el resultado en el campo de Prima a pagar
        primaInput.value = primaCalculada.toFixed(0); // Ajustar el resultado según sea necesario
    }
});

</script>
@endsection
