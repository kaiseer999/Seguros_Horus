@extends('layouts.app')

@section('content')


<h1>Asesores</h1>

<div class="container">
    <div class="card mx-auto w-100">
        <div class="card-header">
            <h2 class="card-title">Asesores activos</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-striped table align-middle table-bordered" id="asesores">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#asesorCrearModal">
                      Crear asesor
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="asesorCrearModal" tabindex="-1" aria-labelledby="asesorCrearModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="asesorCrearModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">

                            <form action="{{url('/asesores')}}" id="FrmAsesor" method="POST">
                              @csrf

                              <label for="nombreAsesor">Nombres</label>
                              <input class="form-control" type="text" id="nombreAsesor" name="nombreAsesor">
                              
                              <label for="apellidoAsesor">Apellido</label>
                              <input class="form-control" type="text" id="apellidoAsesor" name="apellidoAsesor">
                              
                              <label for="telefonoAsesor">Telefono</label>
                              <input class="form-control" type="text" id="telefonoAsesor" name="telefonoAsesor">
                              
                              <label for="emailAsesor">Email</label>
                              <input class="form-control" type="text" id="emailAsesor" name="emailAsesor">

                              <label for="estadoAsesor">Estado </label>
                              <select class="form-select" name="estadoAsesor" id="estadoAsesor" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                              </select>
                              
                            </form>



                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="submitForm('FrmAsesor')">Save changes</button>
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

                    <thead>
                        <th>prueba</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>xd</td>
                        </tr>
                    </tbody>

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
        $('#asesores').DataTable({
            responsive: true,
            autoWidth: false,

            "language": {
                "lengthMenu": "Mostar registros por pagina _MENU_ ",
                "zeroRecords": "Asesor no encontrado, lo sentimos",
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