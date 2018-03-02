@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">{{ Breadcrumbs::render('noticias') }}</div>
	</div>
	<br>
	@if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div name="btnForm" class="row">
    	<div class="col-md-5"></div>
    	<button class="col-md-2 btn btn-info" onclick="crearNoticia()">Crear notícia</button>
    </div>
	@if($arrayNoticias->isEmpty())
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