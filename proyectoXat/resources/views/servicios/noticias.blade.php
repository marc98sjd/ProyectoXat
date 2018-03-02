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