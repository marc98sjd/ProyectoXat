@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">{{ Breadcrumbs::render('noticias') }}</div>
        </div>
        <br>

        @if(session()->has('message'))
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        </div>

        @endif
    </div>
        @if ((Auth::user()->is_admin)==1)
            <form name="formNoticia" method="POST" action="{{ url('servicios/noticias/createNoticia') }}" enctype="multipart/form-data"  class="form-group">
                {{ csrf_field() }}
                <div name="substituir1"></div>
            </form>
            <script type="text/javascript">
                crearNoticia();
            </script>
        @else
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Sólo pueden crear notícias los administradores.</h4>
                </div>
            </div>
        @endif

        @if($arrayNoticias->isEmpty() and $noticiasImportantes -> isEmpty())
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Todavía no hay noticias</h4>
                </div>
            </div>

        @else
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h2 class="text-center title">Noticias</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Importantes</h4>
                </div>
            </div>
            @foreach( $noticiasImportantes as $noticiaImportante )
                <div class="row" style="padding: 50px; border-style: solid; border-color: red; margin: 10px;">
                    <div class="col-md-8">
                        <h4>Titulo:
                            <?php
                            echo "<ul>$noticiaImportante->titulo</ul>";
                            ?>
                        </h4>
                        <label>Descripción
                            <?php
                            echo "<ul><p>$noticiaImportante->descripcion</p></ul>";
                            ?>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <img src='{{ URL::asset("$noticiaImportante->imagen") }}' alt='Imagen no disponible!' style='height:250px'>
                    </div>

                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h4 class="text-center">Otras...</h4>
                </div>
            </div>
            @foreach( $arrayNoticias as $noticia )
                <div class="row" style="padding: 50px; border-style: solid; border-color: blue; margin: 10px;">
                    <div class="col-md-8">
                        <h4>Titulo:
                            <?php
                            echo "<ul>$noticia->titulo</ul>";
                            ?>
                        </h4>
                        <label>Descripción
                            <?php
                            echo "<ul><p>$noticia->descripcion</p></ul>";
                            ?>
                        </label>
                        @if ((Auth::user()->is_admin)==1)
                            @if($noticiasImportantes->isEmpty())
                                <br><br>
                                <form method="POST" action="{{ url('servicios/noticias/updateNoticia') }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Importante</button>
                                    <input type="hidden" name="id" value="<?php echo $noticia->id; ?>">
                                </form>
                            @endif
                        @endif
                    </div>
                    <div class="col-md-4">
                        <img src='{{ URL::asset("$noticia->imagen") }}' alt='Imagen no disponible!' style='height:250px'>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12" style="padding: 40px;">
                    <h2 class="text-center title">Secciones</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                    <select id="noticiasCategorias" class="form-control">
                        @foreach( $arrayNoticias as $noticia )
                            <option value="<?php echo $noticia->categoria;?>"><?php echo $noticia->categoria;?></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-info" onclick="buscarNoticia()">Buscar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div id="categoria" class="col-md-10">
                </div>
            </div>
    @endif
@endsection