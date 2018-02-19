@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('denuncias') }}
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <form method="POST" action="{{ url('servicios/denuncias/createDenuncia') }}" enctype="multipart/form-data"  class="form-group">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 40px;">
                    <h2 class="text-center title">Crear Denuncia</h2>
                </div>
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input class="form-control" type="text" name="titulo">
                        <br>
                        <label>Descripción</label>
                        <textarea class="form-control" maxlength="250" name="descripcion" style="height: 180px"></textarea>
                        <br><br>
                        <div class="col-md-8">
                            <label>Imagen para validar la denuncia</label>
                            <input class="form-control" type="file" name="imagen">
                        </div>
                        <div class="col-md-4">
                            <label >Fecha del incidente</label>
                            <input type="date" class="form-control" name="fecha">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <label>Dirección</label>
                    <input id="geocomplete" placeholder="Escribe la dirección" class="form-control" name="inputDireccion" type="text">
                    <br>
                    <div class="form-control" id="mapa" style="height:350px;background:yellow"></div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-6">
                        <br>
                        <button type="submit" class="btn btn-primary col-md-12">
                            Enviar denuncia
                        </button>
                    </div>

            </div>
        </form>
        @if($arrayDenuncias->isEmpty())
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Todavía no hay denuncias</h4>
                </div>
            </div>

        @else
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h2 class="text-center title">Denuncias</h2>
                </div>
            </div>  
            @foreach( $arrayDenuncias as $denuncia )
            <div class="row" style="padding: 50px">
                <div class="col-md-8">
                    <h4>Titulo:
                        <?php
                        echo "<ul>$denuncia->titulo</ul>";
                        ?>
                    </h4>
                    <label>Descripción
                        <?php
                        echo "<ul><p>$denuncia->descripcion</p></ul>";
                        ?>
                    </label>
                    <form method="POST" action="{{ url('servicios/denuncias/addComment') }}">
                        {{ csrf_field() }}
                        <input type="text" name="id" value="<?php echo "$denuncia->id";?>" style="display: none;">
                        <input type="text" name="ultimoComentario" value="<?php echo "$denuncia->comentario";?>" style="display: none;">
                        <label>Comentarios:<br><?php
                            $comentario = explode("/", $denuncia->comentario);
                            foreach($comentario as $coment){
                                if($coment==''){

                                }
                                else{
                                    echo "<ul>-".$coment."</ul>";
                                }

                            }
                            ?></label>
                        <br>
                        <label>Nuevo comentario</label>
                        <textarea name="comentario" style="width: 100%; height: 150px"></textarea>
                        <button type="submit" class="btn btn-primary col-md-12">
                            Añadir comentario
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <img src='{{ URL::asset("$denuncia->imagen") }}' alt='Imagen no disponible!' style='height:250px'>
                </div>

            </div>
            @endforeach
        @endif
    </div>
@endsection