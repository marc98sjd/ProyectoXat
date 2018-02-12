<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ProyectoXat</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #cefffd;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

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
              $('a[name=btnLogin]').hover(desvanecer);
              /*$('button[name=btnRegistro]').click(aparecer);
              $('button[name=btnDesvanecer]').click(desvanecer);
              $('button[name=btnDeslizarMostrar]').click(mostrarDeslizando);
              $('button[name=btnDeslizarOcultar]').click(ocultarDeslizando);*/
            });

              function mostrar(){
                $("a[name=btnLogin]").show();
              }

              function ocultar(){
                $("p").hide();
              }

              function aparecer(){
                $("a[name=btnLogin]").fadeIn(1500,desvanecer);
                $("a[name=btnLogin]").mouseleave()
              }

              function desvanecer(){
                $("a[name=btnLogin]").fadeOut(1500,aparecer);
                //para llamar a funcion en uno de los efectos:
                // $("p").fadeOut(1500,nombreFuncion);
              }

              function mostrarDeslizando(){
                $("p").slideDown(1000);
              }

              function ocultarDeslizando(){
                $("p").slideUp(1000);
              }
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('/home') }}">Inicio</a>
                    @else
                        <a name="btnLogin" href="{{ route('login') }}">Login</a>
                        <a name="btnRegistro" href="{{ route('register') }}">Registro</a>
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    ProyectoXat
                </div>

                <div class="links">
                    <a href="{{url('/servicios/xat')}}">Xat</a>
                    <a href="{{url('/servicios/denuncias')}}">Denuncias</a>
                    <a href="{{url('/servicios/debates')}}">Debates</a>
                    <a href="{{url('/servicios/noticias')}}">Noticias</a>
                </div>
            </div>
        </div>
    </body>
</html>
