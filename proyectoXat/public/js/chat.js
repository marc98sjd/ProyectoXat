
var salaNow;//variable que guarda la sala en la que esta el usuario en ese momento, esta cambia al cambiar de sala
var userName;//variable que guarda el nombre de usuario, se utiliza para enviar el mensaje al servidor
var checkSala;//variable de intervalo, comprueba cada segundo si hay mensajes en la sala que aparece en salaNow en ese momento
var lastTimeMessage;//variable que almacena el tiempo del ultimo mensaje recibido del servidor


/*---------------------------------------------*
     * Mostrar mensajes en el chat
           -Funcion para reutilizarla y no repetir codigo, esta crea los mensajes dentro del chat
            esta solamente coge los datos recibidos por ajax desde el servidor para mostrarlos.

     ---------------------------------------------*/


function mostrarMensajes(data) {
    var max = data.length;
    for (var key in data) {
        if (userName === (data[key]["name"])) {
            $('#boxMensajes').append(
                $('<div class="col-md-12"></div>').append(
                    $('<div class="col-md-9" style="margin-left: 200px"></div>').append(
                        $('<div style="font-weight: bold;text-align: right;margin-bottom: 10px;padding: 2px 25px; background-color: darkgrey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                            $('<h4></h4>').text("Tu").css('color', data[key]["color"]), $('<p></p>').text(data[key]["descripcion"])))));
        }
        else {
            $('#boxMensajes').append(
                $('<div class="col-md-12"></div>').append(
                    $('<div class="col-md-9"></div>').append(
                        $('<div style="font-weight: bold;text-align: left;margin-bottom: 10px;padding: 2px 25px; background-color: grey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                            $('<h4></h4>').text(data[key]["name"]).css('color', data[key]["color"]), $('<p></p>').text(data[key]["descripcion"])))));
        }

        if (key == (max - 1)) {
            lastTimeMessage = data[key]["created_at"];
        }

        console.log("key " + key + " has value " + data[key]["name"]);
    }
}


/*---------------------------------------------*
     * Recibir los mensajes de la sala desde la base de datos
           -Esta funcion establece la conexion con la base de datos, y carga los mensaje correspondientes en cada sala(Segun especificaciones del proyecto)
            y mantiene una conexion constante para comprobar si hay mensajes usando la variable de intervalo checkSala

     ---------------------------------------------*/


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
            mostrarMensajes(data);
        }
    });


    checkSala = setInterval(function(){
        $.ajax({
            url: "http://127.0.0.1:8000/servicios/xat/comprobarMensajes/"+sala+"/"+lastTimeMessage,
            type: "GET",
            dataType: "json",
            success: function (data) {
                mostrarMensajes(data);
            }
        });
    }, 1000);

}

/*---------------------------------------------*
     * Enviar mensajes por ajax a la base de datos
           -Esta funcion establece la conexion con la base de datos, y envia los datos necesarios para poder crear el mensaje.
            La sala en la que esta escribiendo el usuario y el mensaje.

     ---------------------------------------------*/

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
