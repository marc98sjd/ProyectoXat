@extends('layouts.app')

@section('content')
    <?php $text ='hola mundo'?>
    <script type="text/javascript" src="http://localhost:8000/js/chat.js"></script>
    <div class="container">
        {{ Breadcrumbs::render('xat') }}
        <div class="col-md-12" style="padding-bottom: 40px;">
            <h2 class="text-center title">Chat Cornella</h2>
        </div>
        <div class="row">
            <div class="col-md-12" style="border-style: solid;border-color: greenyellow; height: 70px; border-radius: 15px; margin-bottom: 10px;">

            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="border-style: solid;border-color: greenyellow; height: 500px;border-radius: 15px; margin-right: 10px">
                <div class="row">
                    <div class="col-md-12" style="height: 220px;overflow: auto;">
                        <div class="text-center">
                            <h4>Salas de chat</h4>
                            <hr style="border-width: 4px; border-color: greenyellow; margin-top: 0;">
                        </div>
                        <div class="text-center">
                            @foreach($salas as $sala)
                                <p onclick="abrirSala(<?php echo $sala->id?>)" style="width: 100%; height: 100%; background-color: black;padding: 5px; font-size: 15px; color: white; opacity: 0.4; border-radius: 5px; cursor:pointer;"><?php echo $sala->titulo?></p>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12" style="overflow: auto;">
                        <div class="text-center">
                            <h4>Chats privados</h4>
                            <hr style="border-width: 4px; border-color: greenyellow; margin-top: 0;">
                        </div>
                    </div>
                </div>

            </div>
            <div id="boxMensajes" class="col-md-8" style="border-style: solid;border-color: greenyellow; height: 500px;border-radius: 15px; width: 865px; overflow: auto;">
                <div class="text-center" style="margin-top: 25%;">
                    <h3>Accede a una sala para empezar a chatear!</h3>
                </div>
            </div>

        </div>
    </div>

@endsection