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
                    <h2 class="text-center title">Crear Denuncias</h2>
                </div>
                <div class="col-md-6 text-center">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input class="form-control" type="text" name="titulo">
                        <br>
                        <label>Descripción</label>
                        <textarea class="form-control" maxlength="250" name="descripcion" style="height: 180px"></textarea>
                        <br>
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
                    <label>Marca la ubicación</label>
                    <div class="form-control" id="map" style="height:350px;background:yellow"></div>

                    <script>
                        function myMap() {
                            var mapOptions = {
                                center: new google.maps.LatLng(41.3 , 2.1),
                                zoom: 11,
                                mapTypeId: google.maps.MapTypeId.HYBRID
                            }
                            var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                        }
                    </script>

                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
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
        <div class="row">
            <div class="col-md-12" style="padding: 40px;">
                <h2 class="text-center title">Mostrar Denuncias</h2>
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
    </div>
@endsection