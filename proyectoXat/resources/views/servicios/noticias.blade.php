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
        @foreach( $arrayNoticias as $noticia )
        @endforeach
    @endif
@endsection