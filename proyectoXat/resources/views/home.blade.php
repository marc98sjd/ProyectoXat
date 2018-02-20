@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('main') }}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenido
                        @if ((Auth::user()->is_admin)==1)
                            administrador
                        @endif
                        {{ Auth::user()->name }}</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        Has iniciado sesión!
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="title m-b-md">
            ProyectoXat
        </div>
        <div class="links">
            <a class="hvr-rectangle-out hvr-wobble-bottom" href="{{url('/servicios/xat')}}">Xat</a>
            <a class="hvr-rectangle-out hvr-wobble-bottom" href="{{url('/servicios/denuncias')}}">Denuncias</a>
            <a class="hvr-rectangle-out hvr-wobble-bottom" href="{{url('/servicios/debates')}}">Debates</a>
            <a class="hvr-rectangle-out hvr-wobble-bottom" href="{{url('/servicios/noticias')}}">Noticias</a>
        </div>
    </div>
    <br><br><br><br>
    <div class="row container-fluid" style="height: 150px;">
        <div class="col-md-2"></div>
        <div class="col-md-8 h-100 d-inline-block" style="background-color: grey; height: 100%;"></div>
    </div>
@endsection
