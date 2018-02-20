var salaNow;
var userId;
var checkSala;


function abrirSala(sala, idUser) {
    userId = parseInt(idUser);
    clearInterval(checkSala);
    salaNow=sala;
    checkSala = setInterval(function(){
        $.ajax({
            url: "http://127.0.0.1:8000/servicios/xat/"+sala,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('#boxMensajes').empty();
                for (var key in data) {
                    $('#boxMensajes').append(
                        $('<div class="col-md-12"></div>').append(
                            $('<div class="col-md-12"></div>').append(
                                $('<div style="text-align: right;margin-bottom: 10px;padding: 2px 25px; background-color: darkgrey; opacity: 0.5; border-radius: 10px; color: white"></div>').append(
                                    $('<h4></h4>').text(data[key]["name"]),$('<p></p>').text(data[key]["descripcion"])))));

                    console.log("key " + key + " has value " + data[key]["name"]);
                }
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
