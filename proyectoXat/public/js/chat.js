var salaNow;
var userName;
var checkSala;
var lastTimeMessage;


function abrirSala(sala, user, nameSala) {
    $('#newMensaje').prop('disabled', false);
    $('#boxMensajes').empty();
    $('#tituloChat').text("Sala "+nameSala);
    userName = user;
    clearInterval(checkSala);
    salaNow=sala;
    $.ajax({
        url: "http://127.0.0.1:8000/servicios/xat/"+sala,
        type: "GET",
        dataType: "json",
        success: function (data) {
            data=data.reverse();
            var max = data.length;
            for (var key in data) {
                if(userName===(data[key]["name"])){
                    $('#boxMensajes').append(
                        $('<div class="col-md-12"></div>').append(
                            $('<div class="col-md-9" style="margin-left: 200px"></div>').append(
                                $('<div style="font-weight: bold;text-align: right;margin-bottom: 10px;padding: 2px 25px; background-color: darkgrey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                                    $('<h4></h4>').text("Tu"),$('<p></p>').text(data[key]["descripcion"])))));
                }
                else {
                    $('#boxMensajes').append(
                        $('<div class="col-md-12"></div>').append(
                            $('<div class="col-md-9"></div>').append(
                                $('<div style="font-weight: bold;text-align: left;margin-bottom: 10px;padding: 2px 25px; background-color: grey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                                    $('<h4></h4>').text(data[key]["name"]), $('<p></p>').text(data[key]["descripcion"])))));
                }

                if(key==(max-1)){
                    lastTimeMessage = data[key]["created_at"];
                }

                console.log("key " + key + " has value " + data[key]["name"]);
            }
            //data = data.slice(0).reverse();

            console.log(data);
        }
    });


    checkSala = setInterval(function(){
        $.ajax({
            url: "http://127.0.0.1:8000/servicios/xat/comprobarMensajes/"+sala+"/"+lastTimeMessage,
            type: "GET",
            dataType: "json",
            success: function (data) {
                var max = data.length;
                for (var key in data) {
                    if(userName===(data[key]["name"])){
                        $('#boxMensajes').append(
                            $('<div class="col-md-12"></div>').append(
                                $('<div class="col-md-9" style="margin-left: 200px"></div>').append(
                                    $('<div style="font-weight: bold;text-align: right;margin-bottom: 10px;padding: 2px 25px; background-color: darkgrey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                                        $('<h4></h4>').text("Tu"),$('<p></p>').text(data[key]["descripcion"])))));
                    }
                    else {
                        $('#boxMensajes').append(
                            $('<div class="col-md-12"></div>').append(
                                $('<div class="col-md-9"></div>').append(
                                    $('<div style="font-weight: bold;text-align: left;margin-bottom: 10px;padding: 2px 25px; background-color: grey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                                        $('<h4></h4>').text(data[key]["name"]), $('<p></p>').text(data[key]["descripcion"])))));
                    }

                    if(key==(max-1)){
                        lastTimeMessage = data[key]["created_at"];
                    }

                    console.log("key " + key + " has value " + data[key]["name"]);
                }
                //data = data.slice(0).reverse();

                console.log(data);
            }
        });
    }, 2000);

}

function crearSala() {

}

function cerrarSala() {

}

function abrirPrivado() {

}
function crearPrivado() {

}
function cerrarPrivado() {

}

function enviarMensajeSala() {
    var mensaje = $('#newMensaje').val();
    $('#newMensaje').val("");

    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/servicios/xat/crearMensaje/"+salaNow+"/"+mensaje,
        success: function (data) {
            console.log(data);
        }
    });
}
