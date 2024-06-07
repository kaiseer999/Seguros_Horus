@extends('layouts.app')

@section('content')

<h1>EMPLEADO NOMINA</h1>

<div class="row">
    <!-- Tabla de Cargos -->
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Lista de Cargos</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover" id="cargos">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#crearcargosModal">
                        Crear cargo
                    </button>
                    
                    <div class="modal fade" id="crearcargosModal" tabindex="-1" aria-labelledby="crearcargosModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="crearcargosModalLabel">Crear nuevo cargo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí puedes colocar los campos para crear un nuevo cargo -->
                                    <form action="{{url('/cargos')}}" id="FrmCargos" method="POST" >
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombreCargo" class="form-label">Nombre del cargo</label>
                                            <input type="text" class="form-control" id="nombreCargo" name="nombreCargo" placeholder="Ingrese el nombre del cargo" required>
                                        </div>
                                        <!-- Agrega más campos según sea necesario -->
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="button" class="btn btn-success" onclick="submitForm('FrmCargos')">Guardar cambios</button>
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
                            <th>#</th>
                            <th>Nombre del Cargo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cargos as $cargo)
                        <tr>
                            <td>{{ $cargo->idCargoNomina }}</td>
                            <td>{{ $cargo->nombreCargo }}</td>
                            <td>

                                <div class="d-inline-flex">

                                    <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#editarCargoModal{{$cargo->idCargoNomina}}">
                                        <i class="fa-solid fa-pen-to-square fa-lg" title="Editar"></i>
                                    </button>
                                
                                    <!-- Modal -->
                                    <div class="modal fade" id="editarCargoModal{{$cargo->idCargoNomina}}" tabindex="-1" aria-labelledby="editarCargoModalLabel{{$cargo->idCargoNomina}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editarCargoModalLabel{{$cargo->idCargoNomina}}">Editar {{$cargo->nombreCargo}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('cargos.update', $cargo->idCargoNomina) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="nombreCargo" class="form-label">Nombre de cargo</label>
                                                            <input type="text" class="form-control" id="nombreCargo" name="nombreCargo" value="{{$cargo->nombreCargo}}" required>
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
                                


                                   <form id="deleteForm{{ $cargo->idCargoNomina }}" action="{{ url('/cargos/'.$cargo->idCargoNomina) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="button" class="btn btn-link" title="Borrar" onclick="confirmDelete({{ $cargo->idCargoNomina }})">
                                            <i class="fa-solid fa-trash fa-lg" title="Borrar {{ $cargo->nombreCargo }}"></i>
                                        </button>
                                    </form>


                                </div>




                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h3>Empleados Horus</h3>
            </div>
            <div class="card-body">
                <!-- Contenido del otro módulo aquí -->
                <table class="table">
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
                                    <label for="cargoSelect" class="form-label">Selecciona el estado</label>
                                    <select class="form-select" id="cargoSelect" name="idCargoNomina" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        @foreach($cargos as $cargo)
                                        <option value="{{$cargo->idCargoNomina}}">{{$cargo->nombreCargo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="section-title">
                                <h5>Información personal</h5>
                            </div>

                            <div class="mb-3 row">

                                <div class="col">
                                    <label for="emailInput" class="form-label">Numero de identificacion</label>
                                    <input type="text" class="form-control" id="emailInput">
                                </div>

                                <div class="col">
                                    <label for="emailInput" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" id="emailInput">
                                </div>
                                
                            </div>

                            <div class="mb-3 row">

                                <div class="col">
                                    <label for="emailInput" class="form-label">Direccion</label>
                                    <input type="text" class="form-control" id="emailInput">
                                </div>

                                <div class="col">
                                    <label for="sexoSelect" class="form-label">Sexo</label>
                                    <select class="form-select" id="sexoSelect" name="sexo" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="O">Otro</option>
                                    </select>
                                </div>   
                                
                                <div class="col">
                                    <label for="EstadoCivilSelect" class="form-label">Estado civil</label>
                                    <select class="form-select" id="EstadoCivilSelect" name="sexo" aria-label="Default select example">
                                        <option selected>Selecciona...</option>
                                        @foreach($estadociviles as $estadocivil)
                                        <option value="{{$estadocivil->idEstadoCivilNomina}}">{{$estadocivil->nombreEstadoCivil}}</option>
                                        @endforeach
                                    </select>
                                </div>  

                                <div class="col">
                                    <label for="emailInput" class="form-label">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="emailInput">
                                </div>

                            </div>
                            
                            <div class="mb-3 row">
                                <div class="col">
                                    <label for="emailInput" class="form-label">Correo electronico</label>
                                    <input type="email" class="form-control" id="emailInput">
                                </div>

                                <div class="col">
                                    <label for="emailInput" class="form-label">Numero de telefono</label>
                                    <input type="text" class="form-control" id="emailInput">
                                </div>

                            </div>

                            
                            



                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <thead>
                        <tr>
                            <th>test</th>
                            <th>test</th>
                            <th>tests</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>xd</td>
                            <td>xd</td>
                            <td>xd</td>
                        </tr>
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
        $('#').DataTable({
            responsive: true,
            autoWidth: true,

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