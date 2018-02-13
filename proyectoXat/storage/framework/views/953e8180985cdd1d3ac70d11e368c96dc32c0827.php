<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'ProyectoXat')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/hover.css')); ?>" rel="stylesheet">
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
        </script>
</head>
<body style="background-color: #cefffd;">
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
                    <?php if(auth()->guard()->guest()): ?>
                        <a class="navbar-brand hvr-pulse-grow" href="<?php echo e(url('/')); ?>">
                            <?php echo e(config('app.name', 'ProyectoXat')); ?>

                        </a>
                    <?php else: ?>
                        <a class="navbar-brand hvr-pulse-shrink" href="<?php echo e(url('/home')); ?>">
                            <?php echo e(config('app.name', 'ProyectoXat')); ?>

                        </a>
                    <?php endif; ?>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a name="btnLogin" href="<?php echo e(route('login')); ?>">Login</a></li>
                            <li><a name="btnRegistro" href="<?php echo e(route('register')); ?>">Registro</a></li>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle hvr-hang" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="hvr-buzz-out">
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
