<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AsfaliaTech') }}</title>
    <link rel="shortcut icon" href=" {{asset('assets/faviconhorus2.png')}}">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Alexandria:600" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <!--SweetAlert2-->
    <script  src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--DataTables-->
    <script  src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script  src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script  src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    
    <!--FontAwesomeIcons-->
    <script defer src="https://kit.fontawesome.com/ac519f3a37.js" crossorigin="anonymous"></script>

    <!--Select2 CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    
    <!--Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg bg-warning">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/home')}}">
                    <img src="{{asset('assets/faviconhorus2.png')}}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    AsfaliaApp
                  </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Elementos a la izquierda -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                       
                        @guest
                        @else
                        <li class="nav-item dropdown">
                            <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Incapacidades
                            </button>
                            <ul class="dropdown-menu dropdown-menu-warning">
                              <li><a class="dropdown-item" href="{{url('/empleados')}}">Ver Empleados</a></li>
                              <li><a class="dropdown-item" href="{{url('/empleadores')}}">Ver Empleadores</a></li>
                              <li><a class="dropdown-item" href="{{url('/incapacidades')}}">Ver Incapacidades</a></li>
                              <li><a class="dropdown-item" href="{{url('/cruces')}}">Ver Cruces</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <button class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              Nomina
                            </button>
                            <ul class="dropdown-menu dropdown-menu-warning">
                              <li><a class="dropdown-item" href="#">Ver Empleados</a></li>
                              <li><a class="dropdown-item" href="#">Ver Empleadores</a></li>
                              <li><a class="dropdown-item" href="#">Ver Incapacidades</a></li>
                              <li><a class="dropdown-item" href="#">Ver Cruces</a></li>
                            </ul>
                        </li>
                  
                    </ul>
                    @endguest

                    <!-- Elementos a la derecha -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <!-- Elementos que ya tienes para autenticación -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </li>        
                        @endguest
                    </ul>
                </div>
                
                
                
                
            </div>
        </nav>
        




        
        
          
         
        <main class="py-4">
            @yield('content')
        </main>

    </div>
    @yield('js')

    <script>
        setInterval(function() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;
            
            document.getElementById('current-time').innerHTML = hours + ":" + minutes + ":" + seconds;
        }, 1000);
    </script>
    
</body>

</html>
