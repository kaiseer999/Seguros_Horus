@php
$user = auth()->user();
@endphp


@extends('layouts.app')

@section('content')


    <h1>Cruce</h1>


    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <div class="table-responsive" style="width: 100%; height: 100%;">
                    <table class="table-striped table align-middle table-bordered" id="cruces">

                        @if($user->hasRole('seguros') || $user->hasRole('admin'))

                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalPagar">Pagar incapacidad</button>

                       
                        <div class="modal fade" id="modalPagar" tabindex="-1" aria-labelledby="modalPagarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="modalPagar">Pagar incapacidad</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form enctype="multipart/form-data" id="frmCruce" method="POST">
                                        @csrf
                                   <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Incapacidad a pagar</label>
                                        <select name="idIncapacidades" class="form-select" aria-label="Default select example">
                                            <option selected>Selecciona una opción...</option>
                                            @foreach($incapacidades as $incapacidad)
                                            <option value="{{$incapacidad->idIncapacidades}}">{{$incapacidad->empleado->nombreEmpleado." ".$incapacidad->empleado->apellidoEmpleado."/".$incapacidad->tipoIncapacidad->NombreTipoInc."/".$incapacidad->estado->NombreEstado."/".$incapacidad->EPS_ARL}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorIncapacidad" class="form-label">Valor incapacidad</label>
                                        <input type="text" class="form-control" name="valorIncapacidad" id="valorIncapacidad" aria-describedby="valorIncapacidad">
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorCruce" class="form-label">Valor cruce</label>
                                        <input type="text" class="form-control" name="valorCruce" id="valorCruce" aria-describedby="valorCruce">
                                    </div>
                                    <div class="mb-3">
                                        <label for="saldoCruce" class="form-label">Saldo cruce</label>
                                        <input type="text" class="form-control" name="saldoCruce" id="saldoCruce" aria-describedby="saldoCruce">
                                    </div>
                                    <div class="mb-3">
                                        <label for="PagoEPS" class="form-label">Pago de la EPS</label>
                                        <input type="file" class="form-control" name="PagoEPS" id="PagoEPS" aria-describedby="PagoEPS">
                                    </div>
                                    <div class="mb-3">
                                        <label for="PagoCruce" class="form-label">Pago de la Incapacidad</label>
                                        <input type="file" class="form-control" name="PagoCruce" id="PagoCruce" aria-describedby="PagoCruce">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Observaciones" class="form-label">Observaciones</label>
                                        <textarea class="form-control" name="Observaciones" id="Observaciones" rows="3"></textarea>
                                    </div>
                                    
                                      
                                  
                                  </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                  <button type="button" class="btn btn-primary" onclick="submitForm('frmCruce')">Crear Pago</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        <script>
                            function submitForm(formId) {
                                // Obtener los valores de los campos y formatearlos
                                var valorIncapacidad = $("#valorIncapacidad").val().replace(/\./g, '').replace(/,/g, '.');
                                var valorCruce = $("#valorCruce").val().replace(/\./g, '').replace(/,/g, '.');
                                var saldoCruce = $("#saldoCruce").val().replace(/\D/g, '');

                                // Asignar los valores formateados a los campos
                                $("#valorIncapacidad").val(valorIncapacidad);
                                $("#valorCruce").val(valorCruce);
                                $("#saldoCruce").val(saldoCruce);
                        
                                // Enviar el formulario
                                document.getElementById(formId).submit();
                            }
                        </script>
                        
                        @endif
                        <thead>
                            <th>Nombre del empleado</th>
                            <th>Nombre del empleador</th>
                            <th>Valor de incapacidad</th>
                            <th>Valor de cruce</th>
                            <th>Saldo de cruce</th>
                            <th>Acciones</th>

                            

                        </thead>
                        <tbody>
                            @foreach($cruces as $cruce)
                            <tr>
                                <td>
                                    @if($cruce->incapacidade && $cruce->incapacidade->empleado)
                                        {{ $cruce->incapacidade->empleado->nombreEmpleado . " " . $cruce->incapacidade->empleado->apellidoEmpleado }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($cruce->incapacidade && $cruce->incapacidade->empleadors)
                                        {{ $cruce->incapacidade->empleadors->nombreEmpleador}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ number_format($cruce->valorIncapacidad, 0, '.', ',') }}</td>
                                <td>{{ number_format($cruce->valorCruce, 0, '.', ',') }}</td>
                                <td>{{ number_format(floor($cruce->saldoCruce / 100), 0, '.', ',') }}</td>
                               

                                <td>
                                    
                                    <div class="d-inline-flex">
                                        
                                    @role('admin')

                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal{{$cruce->idCruce}}">
                                          <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                        </button>
                                      
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$cruce->idCruce}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$cruce->idCruce}}" aria-hidden="true">
                                          <div class="modal-dialog modal-lg ">
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel{{$cruce->idCruce}}">Editar Cruce/Pago</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Usted ha elegido la incapacidad de  {{ $cruce->incapacidade->empleado->nombreEmpleado . " " . $cruce->incapacidade->empleado->apellidoEmpleado }}</p>

                                                    <form action="{{ route('cruces.update', $cruce->idCruce) }}" method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        

                                                        <div class="mb-3">
                                                            <label for="valorIncapacidad" class="form-label">Valor incapacidad</label>
                                                            <input type="text" class="form-control" value="{{$cruce->valorIncapacidad}}" name="valorIncapacidad" id="valorIncapacidad" aria-describedby="valorIncapacidad">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="valorCruce" class="form-label">Valor cruce</label>
                                                            <input type="text" class="form-control" value="{{$cruce->valorCruce}}" name="valorCruce" id="valorCruce" aria-describedby="valorCruce">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="saldoCruce" class="form-label">Saldo cruce</label>
                                                            <input type="text" class="form-control" name="saldoCruce" value="{{ $cruce->saldoCruce }}" id="saldoCruce" aria-describedby="saldoCruce">
                                                        </div>
                                                        <label for="idEmpleado" class="form-label"><b>¡Importante!</b> Si deseas modificar o editar algún archivo, ¡adelante! Sube archivos solo si es 
                                                            necesario para la actualización. La previsualización no está disponible en esta vista.</label>
                                                        <div class="mb-3">
                                                            <label for="PagoEPS" class="form-label">Pago de la EPS</label>
                                                            <input type="file" class="form-control" name="PagoEPS" id="PagoEPS" aria-describedby="PagoEPS">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="PagoCruce" class="form-label">Pago de la incapacidad</label>
                                                            <input type="file" class="form-control" name="PagoCruce" id="PagoCruce" aria-describedby="PagoCruce">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Observaciones" class="form-label">Observaciones</label>
                                                            <textarea class="form-control" name="Observaciones" id="Observaciones" rows="3">{{ old('Observaciones', $cruce->Observaciones) }}</textarea>
                                                        </div>




                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                                                        </div>
                                                        

                                                    </form>
                                                      
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      

                                      

                                      <form id="deleteForm{{ $cruce->idCruce }}" action="{{ url('/cruces/'.$cruce->idCruce) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-link" onclick="confirmDelete({{ $cruce->idCruce }})" title="Borrar">
                                            <i class="fa-solid fa-trash fa-lg" title="Borrar"></i>
                                        </button>
                                    </form>
                                      
                                        @endrole
                                          
      
                                        <!-- Botón que abre el modal -->
                                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detallesModal{{$cruce->idCruce}}" title="Detalles">
                                            <i class="fas fa-info-circle fa-lg" title="Detalles"></i>
                                        </button>
      
                                        <!-- Modal -->
                                        <div class="modal fade" id="detallesModal{{$cruce->idCruce}}" tabindex="-1" aria-labelledby="detallesModalLabel{{$cruce->idCruce}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detallesModalLabel{{$cruce->idCruce}}">Detalles</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Nombre del empleado: {{ $cruce->incapacidade->empleado->nombreEmpleado }} {{ $cruce->incapacidade->empleado->apellidoEmpleado }}</p>
                                                        <p>Nombre del empleador: {{ $cruce->incapacidade->empleadors->nombreEmpleador }}</p>
                                                        <p>Valor de la incapacidad: {{ number_format($cruce->valorIncapacidad, 0, '.', ',') }}</p>
                                                        <p>Valor del cruce: {{ number_format($cruce->valorCruce, 0, '.', ',') }}</p>
                                                        <p>Saldo resultante del cruce: {{ number_format(floor($cruce->saldoCruce / 100), 0, '.', ',') }}</p>
                                                        <p>
                                                            Pago EPS:
                                                            @php
                                                                $nompagoeps = trim($cruce->PagoEPS, '"');
                                                            @endphp
                                                            @if ($nompagoeps)
                                                                @php
                                                                    $ruta = 'storage/' . $nompagoeps;
                                                                @endphp
                                                                <a href="{{ asset($ruta) }}" target="_blank">{{ "Pago de la incapacidad en la EPS de " . $cruce->incapacidade->empleado->nombreEmpleado }}</a>
                                                            @else
                                                                <span>No hay pago de EPS disponible</span>
                                                            @endif
                                                        </p>

                                                        <p>
                                                            Pago Cruce:
                                                            @php
                                                                $nompagocruce = trim($cruce->PagoCruce, '"');
                                                            @endphp
                                                            @if ($nompagocruce)
                                                                @php
                                                                    $ruta = 'storage/' . $nompagocruce;
                                                                @endphp
                                                                <a href="{{ asset($ruta) }}" target="_blank">{{ "Pago del cruce de " . $cruce->incapacidade->empleado->nombreEmpleado }}</a>
                                                            @else
                                                                <span>No hay pago de cruce disponible</span>
                                                            @endif
                                                        </p>
                                                        <p>Observacion: {{ $cruce->Observaciones }}</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                        <!-- Puedes agregar más botones de acción si lo necesitas -->
                                                    </div>
                                                </div>
                                            </div>
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

      function confirmDelete(idCruce) {
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
                document.getElementById('deleteForm' + idCruce).submit();
            }
        });
    }
    

        function calcularSaldoCruce() {
            // Obtener los valores de los campos
            var valorIncapacidad = parseFloat($("#valorIncapacidad").val().replace(/\./g, '').replace(/,/g, '.'));
            var valorCruce = parseFloat($("#valorCruce").val().replace(/\./g, '').replace(/,/g, '.'));
        
            // Calcular el saldo de cruce
            var saldoCruce =  valorIncapacidad -valorCruce;
        
            // Formatear el saldo de cruce en pesos
            var saldoCrucePesos = saldoCruce.toLocaleString('es-CO', {style: 'currency', currency: 'COP'});
        
            // Mostrar el saldo de cruce en el campo correspondiente
            $("#saldoCruce").val(saldoCrucePesos);
        }
        
        // Llamar a la función de cálculo cuando cambie el valor de los campos de entrada
        $("#valorIncapacidad, #valorCruce").on("input", function() {
            // Formatear el valor ingresado con puntos de miles
            var valorFormateado = $(this).val().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            $(this).val(valorFormateado);
            calcularSaldoCruce();
        });
        
        // Calcular el saldo de cruce al cargar la página (por si hay valores predeterminados)
        calcularSaldoCruce();





        $(document).ready(function() {
            $('#cruces').DataTable({
                responsive: true,
                autoWidth: false,
    
                "language": {
                    "lengthMenu": "Mostar registros por pagina _MENU_ ",
                    "zeroRecords": "Cruce no encontrado, lo sentimos",
                    "info": "Pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Registro no encontrado",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search": "Buscar", 
                    "paginate":{
                        "next":"Siguiente",
                        "previous":"Anterior"
                    }
                }
    
            });
    
        });

    </script>

@endsection