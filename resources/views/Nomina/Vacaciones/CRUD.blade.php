@extends('layouts.app')

@section('content')


<h1>VACACIONES</h1>

<div class="container">
    <div class="card mx-auto">
        <div class="card-header">
            <h2 class="card-title">Vacaciones recientes</h2>
        </div>
        <div class="card-body">


            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Crear Vacaciones
            </button>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
    
</script>

@endsection