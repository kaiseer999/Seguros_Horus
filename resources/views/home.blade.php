@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center h-100">
        <div class="col-md-12 my-auto">
            <div class="alert alert-info" role="alert">
                <h4 class="font-weight-bold">{{ __('Bienvenido') }} {{ Auth::user()->name }}</h4> 
                <br>
                <div class="card-group">
                    <div class="card">
                      <a href="https://www.google.com.co/search?sca_esv=dbfc0a3352e492de&sxsrf=ACQVn0-dFzUu_8WyZrp5udhOr9ROsuUdHQ:1712683296460&q=incapacidad&uds=AMwkrPsKdw6NKXr7dpE0DWrb0bVbKhhXN82TFq9pPO4QM-GzAv7216puhVNpPcS5GKTt_5ssrixQkTC_it8TxUTP9WGULYVqyX8i2YQwgI1w0WiJjiDt6NpTVRyPjBaCt2A7y2DuEyxWl7DvUEyFyj5WO1-8vYpTSinaJxPTlrhuWlQe1A3RepyM29bwAZF-2kD4GJkONiZKVm9IidIbR6pPshHZ0mvildLTooBk7tphY_MHJoWGyHQY94baJZCoED_cvZWeIG7DFIc7AUXG6FTqG0tQUIuPmr-OwCzpIWc9gk1wapXfPos&udm=2&prmd=insvbmtz&sa=X&ved=2ahUKEwiD6f270rWFAxVLQjABHcezBnEQtKgLegQIDBAB#vhid=zi137DlXcLLxJM&vssid=mosaic"><img src="https://www.gerencie.com/wp-content/uploads/incapacidad-laboral-medico-particular.png"   class="card-img-top" alt="..."></a>
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold">Incapacidades</h5>
                        <p class="card-text">Registra tus incapacidades en este modulo.</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                      </div>
                    </div>
                    
                    <div class="card">
                      <img src="https://www.gerencie.com/wp-content/uploads/liquidacion-vacaciones.png" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cruce</h5>
                        <p class="card-text">Aqui podras hacer cruces de incapacidades.</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                      </div>
                    </div>

                   
                  </div>
                  <br>
            </div>
        </div>
    </div>

    


</div>
@endsection
