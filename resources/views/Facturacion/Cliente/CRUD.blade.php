@extends('layouts.app')

@section('content')


<h1>Clientes</h1>

<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h2 class="card-title">Pagadas Recientemente</h2>
        </div>
        <div class="card-body">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#clienteModal">
              Crear cliente
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="clienteModalLabel">Nuevo cliente</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('/clientes') }}" method="POST" id="FrmCliente">
                        @csrf
                    
                        <div class="mb-3">
                            <label for="idAsesorComercial" class="form-label">Asesor Comercial</label>
                            <select class="form-select" name="idAsesorComercial" id="idAsesorComercial" aria-label="Seleccionar asesor comercial" required>
                                <option selected disabled>Seleccionar Asesor</option>
                                @foreach($asesores as $asesor)
                                <option value="{{ $asesor->idAsesorComercial }}">{{ $asesor->nombreAsesor }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                        <div class="mb-3">
                            <label for="tipoDocumento" class="form-label">Tipo de documento</label>
                            <select class="form-select" name="tipoDocumento" id="tipoDocumento" aria-label="Seleccionar tipo de documento" required>
                                <option selected disabled>Seleccionar tipo de documento</option>
                                <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="NIT">Número de Identificación Tributaria</option>
                                <option value="Permiso Especial de Permanencia">Permiso Especial de Permanencia</option>
                            </select>
                        </div>
                    
                        <div class="mb-3">
                            <label for="numeroIdentificacion" class="form-label">Número de identificación</label>
                            <input type="text" class="form-control" id="numeroIdentificacion" name="numeroIdentificacion" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="nombreCompleto" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="direccionCliente" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccionCliente" name="direccionCliente" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="fechaNacimientoCliente" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimientoCliente" name="fechaNacimientoCliente" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    
                    </form>
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-success" onclick="submitForm('FrmCliente')">Guardar cliente</button>
                    </div>
                  </div>
                </div>
              </div>
              <script>
                function submitForm(formId) {
                  document.getElementById(formId).submit();
                }
              </script>
              




              <br>
              <br>

            <div class="table-responsive">
                <table class="table-striped table align-middle table-bordered" id="clientes">
                    <thead>
                        <th>Nombre del cliente</th>
                        <th>Email del cliente</th>
                        <th>Telefono del cliente</th>
                        <th>Hora y fecha de creacion</th>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{$cliente->nombreCompleto}}</td>
                                <td>{{$cliente->direccionCliente}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->email}}</td>
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


    $(document).ready(function() {
        $('#clientes').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Cliente no encontrado, lo sentimos",
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