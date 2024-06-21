@extends('layouts.app')

@section('content')

<h1>Empleados Horus</h1>
<br>
<div class="row">
    

    <!-- Tabla de Empleados -->
    <div class="col-lg-12 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Lista de empleados</h3>
            </div>
            <div class="card-body">
                <!-- Contenido del otro módulo aquí -->
                <table class="table table-striped table-hover" id="empleados" >
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#crearEmpleadoNominaModal">
                      Crear empleado
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="crearEmpleadoNominaModal" tabindex="-1" aria-labelledby="crearEmpleadoNominaModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="crearEmpleadoNominaModalLabel">Crear nuevo empleado</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form action="{{url('/empleadosnomina')}}" id="FrmEmpleadoNomina" method="POST" >
                                @csrf
                            <div class="section-title">
                                <h5>Información de Ingreso</h5>
                            </div>
                           
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="fechaIngresoEmpleadoNom" class="form-label">Fecha de ingreso a la empresa</label>
                                    <input type="date" class="form-control" name="fechaIngresoEmpleadoNom" id="fechaIngresoEmpleadoNom">
                                </div>
                            
                                <div class="col">
                                    <label for="cargoSelect" class="form-label">Selecciona el cargo</label>
                                    <select class="form-select" id="cargoSelect" name="idCargoNomina" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        @foreach($cargos as $cargo)
                                        <option value="{{$cargo->idCargoNomina}}">{{$cargo->nombreCargo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                

                                <div class="col">
                                    <label for="estadoESelect" class="form-label">Selecciona el estado</label>
                                    <select class="form-select" id="estadoESelect" name="idEstadoEmpleadoNomina" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        @foreach($estadosempl as $estadoempl)
                                        <option value="{{$estadoempl->idEstadoEmpleadoNomina}}">{{$estadoempl->nombreEstadoEmpleado}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="SalarioEmpleadoNom" class="form-label">Salario mensual</label>
                                <input type="number" class="form-control" name="SalarioEmpleadoNom" id="SalarioEmpleadoNom">
                            </div>


                            <div class="section-title">
                                <h5>Información personal</h5>
                            </div>

                            <div class="mb-3 row">

                                <div class="col">
                                    <label for="cedulaEmpleadoNom" class="form-label">Numero de identificacion</label>
                                    <input type="text" class="form-control" id="cedulaEmpleadoNom" name="cedulaEmpleadoNom">
                                </div>

                                <div class="col">
                                    <label for="nombreEmpleadoNom" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="nombreEmpleadoNom" name="nombreEmpleadoNom">
                                </div>
                                
                            </div>

                            <div class="mb-3 row">

                                <div class="col">
                                    <label for="direccionEmpleadoNom" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="direccionEmpleadoNom" name="direccionEmpleadoNom">
                                </div>

                                <div class="col">
                                    <label for="sexoSelect" class="form-label">Sexo</label>
                                    <select class="form-select" id="sexoSelect" name="sexoEmpleadoNom" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="O">Otro</option>
                                    </select>
                                </div>   
                                
                                <div class="col">
                                    <label for="EstadoCivilSelect" class="form-label">Estado civil</label>
                                    <select class="form-select" id="EstadoCivilSelect" name="idEstadoCivilNomina" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        @foreach($estadociviles as $estadocivil)
                                        <option value="{{$estadocivil->idEstadoCivilNomina}}">{{$estadocivil->nombreEstadoCivil}}</option>
                                        @endforeach
                                    </select>
                                </div>  

                                <div class="col">
                                    <label for="fechaNacEmpleadoNom" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacEmpleadoNom" name="fechaNacEmpleadoNom">
                                </div>

                            </div>
                            
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="emailEmpleadoNom" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control" id="emailEmpleadoNom" name="emailEmpleadoNom">
                                </div>

                                <div class="col">
                                    <label for="telefonoEmpleadoNom" class="form-label">Numero de telefono</label>
                                    <input type="text" class="form-control" id="telefonoEmpleadoNom" name="telefonoEmpleadoNom">
                                </div>

                            </div>

                            </form>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success" onclick="submitForm('FrmEmpleadoNomina')">Guardar empleado</button>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>

                    <script>
                        function submitForm(formId){
                          document.getElementById(formId).submit();
                        }
                
                    </script>
                    <thead>
                        <tr>
                            <th style="text-align: center">{{'#'}}</th>
                            <th style="text-align: center">Empleado</th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($empleados as $empleado)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="text-align: center">{{$empleado->nombreEmpleadoNom}}</td>
                            <td >
                                <div class="d-inline-flex">

                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editarEmpleadoNomModal{{$empleado->id_EmpleadoNomina}}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar {{$empleado->nombreEmpleadoNom}}"></i>
                                    </button>
                                
                                    <!-- Modal -->
                                    <div class="modal fade" id="editarEmpleadoNomModal{{$empleado->id_EmpleadoNomina}}" tabindex="-1" aria-labelledby="editarEmpleadoNomModalLabel{{$empleado->id_EmpleadoNomina}}" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarEmpleadoNomModalLabel{{$empleado->id_EmpleadoNomina}}">Editar {{$empleado->nombreEmpleadoNom}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('empleadosnomina.update', $empleado->id_EmpleadoNomina) }}" id="FrmEditEmpleadoNomina{{$empleado->id_EmpleadoNomina}}" method="POST">
                                                        
                                                        @csrf
                                                        @method('PUT')
                                                    
                                                        <div class="section-title">
                                                            <h5>Información de Ingreso</h5>
                                                        </div>
                                                    
                                                        <input type="hidden" name="idEmpleadoAdmNom" value="{{ $empleado->idEmpleadoAdmNom }}">
                                                    
                                                        <div class="mb-3 row">
                                                            <div class="col">
                                                                <label for="fechaIngresoEmpleadoNom" class="form-label">Fecha de ingreso a la empresa</label>
                                                                <input type="date" class="form-control" name="fechaIngresoEmpleadoNom" id="fechaIngresoEmpleadoNom" value="{{ $empleado->infoEmpleadoAdminNomina->fechaIngresoEmpleadoNom }}">
                                                            </div>
                                                    
                                                            <div class="col">
                                                                <label for="cargoSelect" class="form-label">Selecciona el cargo</label>
                                                                <select class="form-select" id="cargoSelect" name="idCargoNomina" aria-label="Default select example">
                                                                    <option value="">Selecciona...</option>
                                                                    @foreach($cargos as $cargo)
                                                                    <option value="{{ $cargo->idCargoNomina }}" {{ $empleado->infoEmpleadoAdminNomina->idCargoNomina == $cargo->idCargoNomina ? 'selected' : '' }}>{{ $cargo->nombreCargo }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                    
                                                            <div class="col">
                                                                <label for="estadoESelect" class="form-label">Selecciona el estado</label>
                                                                <select class="form-select" id="estadoESelect" name="idEstadoEmpleadoNomina" aria-label="Default select example">
                                                                    <option value="">Selecciona...</option>
                                                                    @foreach($estadosempl as $estadoempl)
                                                                    <option value="{{ $estadoempl->idEstadoEmpleadoNomina }}" {{ $empleado->infoEmpleadoAdminNomina->idEstadoEmpleadoNomina == $estadoempl->idEstadoEmpleadoNomina ? 'selected' : '' }}>{{ $estadoempl->nombreEstadoEmpleado }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="SalarioEmpleadoNom" class="form-label">Salario mensual</label>
                                                            <input type="number" class="form-control" value="{{$empleado->infoEmpleadoAdminNomina->SalarioEmpleadoNom}}" name="SalarioEmpleadoNom" id="SalarioEmpleadoNom">
                                                        </div>
                                                    
                                                        <div class="section-title">
                                                            <h5>Información personal</h5>
                                                        </div>
                                                    
                                                        <div class="mb-3 row">
                                                            <div class="col">
                                                                <label for="cedulaEmpleadoNom" class="form-label">Numero de identificación</label>
                                                                <input type="text" class="form-control" id="cedulaEmpleadoNom" name="cedulaEmpleadoNom" value="{{ $empleado->cedulaEmpleadoNom }}">
                                                            </div>
                                                    
                                                            <div class="col">
                                                                <label for="nombreEmpleadoNom" class="form-label">Nombre completo</label>
                                                                <input type="text" class="form-control" id="nombreEmpleadoNom" name="nombreEmpleadoNom" value="{{ $empleado->nombreEmpleadoNom }}">
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="mb-3 row">
                                                            <div class="col">
                                                                <label for="direccionEmpleadoNom" class="form-label">Dirección</label>
                                                                <input type="text" class="form-control" id="direccionEmpleadoNom" name="direccionEmpleadoNom" value="{{ $empleado->direccionEmpleadoNom }}">
                                                            </div>
                                                    
                                                            <div class="col">
                                                                <label for="sexoSelect" class="form-label">Sexo</label>
                                                                <select class="form-select" id="sexoSelect" name="sexoEmpleadoNom" aria-label="Default select example">
                                                                    <option value="">Selecciona...</option>
                                                                    <option value="M" {{ $empleado->sexoEmpleadoNom == 'M' ? 'selected' : '' }}>Masculino</option>
                                                                    <option value="F" {{ $empleado->sexoEmpleadoNom == 'F' ? 'selected' : '' }}>Femenino</option>
                                                                    <option value="O" {{ $empleado->sexoEmpleadoNom == 'O' ? 'selected' : '' }}>Otro</option>
                                                                </select>
                                                            </div>   
                                                    
                                                            <div class="col">
                                                                <label for="EstadoCivilSelect" class="form-label">Estado civil</label>
                                                                <select class="form-select" id="EstadoCivilSelect" name="idEstadoCivilNomina" aria-label="Default select example">
                                                                    <option value="">Selecciona...</option>
                                                                    @foreach($estadociviles as $estadocivil)
                                                                        <option value="{{ $estadocivil->idEstadoCivilNomina }}" {{ $empleado->idEstadoCivilNomina == $estadocivil->idEstadoCivilNomina ? 'selected' : '' }}>{{ $estadocivil->nombreEstadoCivil }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>  
                                                    
                                                            <div class="col">
                                                                <label for="fechaNacEmpleadoNom" class="form-label">Fecha de nacimiento</label>
                                                                <input type="date" class="form-control" id="fechaNacEmpleadoNom" name="fechaNacEmpleadoNom" value="{{ $empleado->fechaNacEmpleadoNom }}">
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="mb-3 row">
                                                            <div class="col">
                                                                <label for="emailEmpleadoNom" class="form-label">Correo electrónico</label>
                                                                <input type="email" class="form-control" id="emailEmpleadoNom" name="emailEmpleadoNom" value="{{ $empleado->emailEmpleadoNom }}">
                                                            </div>
                                                    
                                                            <div class="col">
                                                                <label for="telefonoEmpleadoNom" class="form-label">Número de teléfono</label>
                                                                <input type="text" class="form-control" id="telefonoEmpleadoNom" name="telefonoEmpleadoNom" value="{{ $empleado->telefonoEmpleadoNom }}">
                                                            </div>
                                                        </div>
                                                    
                                                    </form>
                                                    
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-success" onclick="submitForm('FrmEditEmpleadoNomina{{$empleado->id_EmpleadoNomina}}')">Guardar empleado</button>
                                                    </div>
                                                </div>
                                        
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function submitForm(formId){
                                          document.getElementById(formId).submit();
                                        }
                                
                                    </script>


                                    <form id="deleteForm{{$empleado->id_EmpleadoNomina}}" action="{{ url('/empleadosnomina/'.$empleado->id_EmpleadoNomina) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-link" title="Borrar" onclick="confirmDelete({{ $empleado->id_EmpleadoNomina }})">
                                            <i class="fa-solid fa-trash fa-lg" title="Borrar {{ $empleado->nombreEmpleadoNom }}"></i>
                                        </button>
                                    </form>



                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#detallesEmpleadoNomModal{{$empleado->id_EmpleadoNomina}}" title="Detalles">
                                        <i class="fas fa-info-circle fa-lg" title="Detalles"></i>
                                    </button>
  
                                    <!-- Modal -->
                                    <div class="modal fade" id="detallesEmpleadoNomModal{{$empleado->id_EmpleadoNomina}}" tabindex="-1" aria-labelledby="detallesEmpleadoNomModalLabel{{$empleado->id_EmpleadoNomina}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detallesEmpleadoNomModalLabel{{$empleado->id_EmpleadoNomina}}">Detalles de {{$empleado->nombreEmpleadoNom}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <p>Fecha de ingreso: {{$empleado->infoEmpleadoAdminNomina->fechaIngresoEmpleadoNom}}</p>
                                                <p>Cargo: {{$empleado->infoEmpleadoAdminNomina->CargoNomina->nombreCargo}}</p>
                                                <p>Salario: {{ number_format($empleado->infoEmpleadoAdminNomina->SalarioEmpleadoNom, 0) }}</p>
                                                <p>Estado: {{$empleado->infoEmpleadoAdminNomina->estados_EmpleadoNomina->nombreEstadoEmpleado}}</p>
                                                <p>Numero de identificacion: {{$empleado->cedulaEmpleadoNom}}</p>
                                                <p>Direccion: {{$empleado->direccionEmpleadoNom}}</p>
                                                <p>Estado civil: {{$empleado->EstadoCivilNomina->nombreEstadoCivil}}</p>
                                                <p>Fecha de nacimiento: {{$empleado->fechaNacEmpleadoNom}}</p>
                                                <p>Correo electronico: {{$empleado->emailEmpleadoNom}} </p>
                                                <p>Telefono: {{$empleado->telefonoEmpleadoNom}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                    <!-- Puedes agregar más botones de acción si lo necesitas -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <a href="{{ route('empleadosnomina.show', ['empleadosnomina' => $empleado->id_EmpleadoNomina]) }}">Ver detalles</a>






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


<div class="row">

    <!-- Otro Módulo 1 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Otro Módulo 1</h3>
            </div>
            <div class="card-body">
                <!-- Contenido del otro módulo aquí -->
                
                @foreach($tdeducciones as $tdeduccion)
                
                <p>{{$tdeduccion->nombreTipoDeduccion}}</p>

                @endforeach
            </div>
        </div>
    </div>

    <!-- Otro Módulo 2 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Otro Módulo 2</h3>
            </div>
            <div class="card-body">
                <!-- Contenido del otro módulo aquí -->
                <p>Contenido del otro módulo...</p>
            </div>
        </div>
    </div>

    <!-- Otro Módulo 3 -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Otro Módulo 3</h3>
            </div>
            <div class="card-body">
                <!-- Contenido del otro módulo aquí -->
                <p>Contenido del otro módulo...</p>
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


    $(document).ready(function() {
        $('#empleados').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Incapacidad no encontrada, lo sentimos",
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