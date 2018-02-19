<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ProyectoXat') }}</title>

    <!-- Estilos y links -->
    <script src="https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCPUVilNfe8SQEh7J1hD7ucqi5oOaV2Y6c"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hover.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript">
        $(function(){
            $(document).ready(ocultar);
                $('a[name=btnLogin]').hover((function() {
                    aparecer("a[name=btnLogin]");
                }));

                $('a[name=btnRegistro]').hover((function() {
                    aparecer("a[name=btnRegistro]");
                }));

                $('form[name=formRegistro]').hover((function() {
                    mostrarDeslizando("button[name=btnEnvio]");
                }));
                /*$('button[name=btnRegistro]').click(aparecer);
                $('button[name=btnDesvanecer]').click(desvanecer);
                $('button[name=btnDeslizarMostrar]').click(mostrarDeslizando);
                $('button[name=btnDeslizarOcultar]').click(ocultarDeslizando);*/
        });
        function mostrar(elemento){
            $(elemento).show();
        }

        function ocultar(){
            $("button[name=btnEnvio]").hide();
        }

        function aparecer(elemento){
            $(elemento).fadeToggle(1500);
        }
        function mostrarDeslizando(elemento){
            $(elemento).slideDown(1000);
        }

        function ocultarDeslizando(){
            $("p").slideUp(1000);
        }
        function mapaGoogle() {
            var latitud = latitud();
            var longitud = longitud();
            alert("latitud "+latitud);
            alert("longitud "+longitud);
            var mapOptions = {
                center: new google.maps.LatLng(latitud, longitud),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.HYBRID
            }
            var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
        }
        function latitud(){
            var lat = "";
            if (navigator.geolocation) {
                lat = navigator.geolocation.getCurrentPosition(devolverLatitud());
            }
            return lat;
        }
        function devolverLatitud(position){
            return position.coords.latitude;
        }
        function longitud(){
            var lon = "";
            if (navigator.geolocation) {
                lon = navigator.geolocation.getCurrentPosition(devolverLongitud());
            }
            return lon;
        }
        function devolverLongitud(position){
            return position.coords.longitude;
        }
    </script>
</head>
<body  onload="mapaGoogle()" style="background-color: #cefffd;">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest
                        <a class="navbar-brand hvr-pulse-grow" href="{{ url('/') }}">
                            {{ config('app.name', 'ProyectoXat') }}
                        </a>
                    @else
                        <a class="navbar-brand hvr-pulse-shrink" href="{{ url('/home') }}">
                            {{ config('app.name', 'ProyectoXat') }}
                        </a>
                    @endguest
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a name="btnLogin" href="{{ route('login') }}">Login</a></li>
                            <li><a name="btnRegistro" href="{{ route('register') }}">Registro</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle hvr-hang" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="hvr-buzz-out">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
