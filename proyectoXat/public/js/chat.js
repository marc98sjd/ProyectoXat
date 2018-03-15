
var salaNow;//variable que guarda la sala en la que esta el usuario en ese momento, esta cambia al cambiar de sala
var userName;//variable que guarda el nombre de usuario, se utiliza para enviar el mensaje al servidor
var checkSala;//variable de intervalo, comprueba cada segundo si hay mensajes en la sala que aparece en salaNow en ese momento
var lastTimeMessage;//variable que almacena el tiempo del ultimo mensaje recibido del servidor
var firstTime = true;

/*---------------------------------------------*
     * Mostrar mensajes en el chat
           -Funcion para reutilizarla y no repetir codigo, esta crea los mensajes dentro del chat
            esta solamente coge los datos recibidos por ajax desde el servidor para mostrarlos.

     ---------------------------------------------*/


function mostrarMensajes(data,nameSala) {
    var max = data.length;
    var antiguos = $('.foreignMsg').length; 
    for (var key in data) {
        if (userName === (data[key]["name"])) {
            $('#boxMensajes').append(
                $('<div class="col-md-12"></div>').append(
                    $('<div class="col-md-9" style="margin-left: 200px"></div>').append(
                        $('<div style="font-weight: bold;text-align: right;margin-bottom: 10px;padding: 2px 25px; background-color: darkgrey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                            $('<h4></h4>').text("Tu"+" "+data[key]["created_at"]).css('color', data[key]["color"]), $('<p></p>').text(data[key]["descripcion"])))));
        }
        else {
            $('#boxMensajes').append(
                $('<div class="col-md-12 foreignMsg"></div>').append(
                    $('<div class="col-md-9"></div>').append(
                        $('<div style="font-weight: bold;text-align: left;margin-bottom: 10px;padding: 2px 25px; background-color: grey; opacity: 0.7; border-radius: 15px; color: white"></div>').append(
                            $('<h4></h4>').text(data[key]["name"]+" "+data[key]["created_at"]).css('color', data[key]["color"]), $('<p></p>').text(data[key]["descripcion"])))));
        }

        if (key == (max - 1)) {
            lastTimeMessage = data[key]["created_at"];
        }
    }
    if (firstTime) {
        antiguos = $('.foreignMsg').length;
        firstTime = false;
    }
    var nuevos = $('.foreignMsg').length;
    checkMensajeNuevo(nameSala,antiguos,nuevos,data[key]["name"],data[key]["descripcion"]);
}


/*---------------------------------------------*
     * Recibir los mensajes de la sala desde la base de datos
           -Esta funcion establece la conexion con la base de datos, y carga los mensaje correspondientes en cada sala(Segun especificaciones del proyecto)
            y mantiene una conexion constante para comprobar si hay mensajes usando la variable de intervalo checkSala

     ---------------------------------------------*/


function abrirSala(sala, user, nameSala) {
    firstTime = true;
    $('#newMensaje').prop('disabled', false);
    $('#boxMensajes').empty();
    $('#tituloChat').text("Sala "+nameSala);
    userName = user;
    clearInterval(checkSala);
    salaNow=sala;
    $.ajax({
        url: "/servicios/xat/"+sala,
        type: "GET",
        dataType: "json",
        success: function (data) {
            mostrarMensajes(data,nameSala);
        }
    });


    checkSala = setInterval(function(){
        $.ajax({
            url: "/servicios/xat/comprobarMensajes/"+sala+"/"+lastTimeMessage,
            type: "GET",
            dataType: "json",
            success: function (data) {
                mostrarMensajes(data,nameSala);
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
        url: "/servicios/xat/crearMensaje/"+salaNow+"/"+mensaje,
        success: function (data) {
            console.log(data);
        }
    });
}

function checkMensajeNuevo(nameSala,antiguos,nuevos,autor,texto){
    if (antiguos<nuevos) {
        checkPermiso(nameSala,autor,texto);
    }
}
function checkPermiso(nameSala,autor,texto){
    if (!("Notification" in window)) {
        console.log("Tu navegador no soporta notificaciones!");
    }
    else if (Notification.permission === "granted") {
        crearNotification("Mensaje de "+autor" con el texto "+texto+"!","ProyectoXat sala: "+nameSala,"../img/logoChat.png");
    }
    else{
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                crearNotification("Mensaje de "+autor" con el texto "+texto+"!","ProyectoXat sala: "+nameSala,"../img/logoChat.png");
            }
        })
    }
}   

function crearNotification(theBody,theTitle,theIcon) {
  var options = {
      body: theBody,
      icon: theIcon
  }
  var n = new Notification(theTitle,options);
  setTimeout(n.close.bind(n),5000);
}