<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
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
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('/home')); ?>">Inicio</a>
                    <?php else: ?>
                        <a name="btnLogin" href="<?php echo e(route('login')); ?>">Login</a>
                        <a name="btnRegistro" href="<?php echo e(route('register')); ?>">Registro</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="content">
                <div class="title m-b-md">
                    ProyectoXat
                </div>

                <div class="links">
                    <a href="#">Xat</a>
                    <a href="#">Denuncias</a>
                    <a href="#">Debates</a>
                    <a href="<?php echo e(url('/servicios/noticias')); ?>">Noticias</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="banner" style="background-color: red;"></div>
            </div>
        </div>
        
    </body>
</html>
