@extends('layouts.app')

@section('content')



<div class="container-fluid">
    <div class="row justify-content-center h-100">
        <div class="col-md-12 my-auto">
            <div class="alert alert-light" role="alert">
              @role('admin')
              <p>eres admin</p>
              @endrole
              
              @php
              $user = auth()->user();
             @endphp
          
              @if($user->hasRole('seguros') || $user->hasRole('afiliaciones'))
                  <p>Bienvenidos Seguros y Afiliaciones.</p>
              @endif
          
                <h4 class="font-weight-bold">{{ __('Bienvenido') }} {{ Auth::user()->name }}</h4> 
                <br>
                <div class="card-group">
                    <div class="card">
                      <a href="{{ url('incapacidades') }}">
                        <img src="https://www.gerencie.com/wp-content/uploads/incapacidad-laboral-medico-particular.png" class="card-img-top" alt="...">
                      </a>
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold">Incapacidades</h5>
                        <p class="card-text">Registra tus incapacidades de forma sencilla y rápida aqui. 😊</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-body-secondary">📋 Recuerda tener a mano la historia médica y la incapacidad del empleado.👷‍♂️</small>
                      </div>
                    </div>
                    
                    <div class="card">
                      <a href="{{ url('cruces') }}">
                        <img src="https://www.gerencie.com/wp-content/uploads/liquidacion-vacaciones.png" class="card-img-top" alt="...">
                      </a>
                      <div class="card-body">
                        <h5 class="card-title font-weight-bold">Cruce</h5>
                        <p class="card-text">Aquí podrás gestionar los cruces/pagos de incapacidades de manera fácil y rápida. 💼</p>
                      </div>
                      <div class="card-footer">
                        <small class="text-body-secondary">¡No olvides 📎 adjuntar los soportes de pago de la EPS! 😊</small>
                      </div>
                    </div>

                   
                  </div>
                  <br>
            </div>
        </div>
    </div>

    


</div>
@endsection
