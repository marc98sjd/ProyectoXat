/**
 * Api para el chat
 * @module chat
 */

 /** 
 * @type Integer
 */
var salaNow;

/**
 * @type String
 */
var userName;

/**
 * @type Function
 */
var checkSala;

/**
 * @type String
 */
var lastTimeMessage;

/**
 * @type Boolean
 */
var firstTime = true;


/**
 * Mostrar mensajes en el chat, cogiendo los datos del ajax y pintandolos.
 * @module chat
 * @submodule mostrarMensajes()
 * @param {object} data Información de cada mensaje
 * @param {string} nameSala El título de la sala actual
 */
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

/**
 * Recibir los mensajes de la sala a la que se ha entrado y comprobar cada segundo si hay mensajes nuevos
 * @module chat
 * @submodule abrirSala()
 * @param {integer} sala El id de la sala a la que se ha entrado
 * @param {integer} user El id del usuario que está entrando
 * @param {string} nameSala El nombre de la sala que se está accediendo
 */
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

/**
 * Introduce el mensaje nuevo en la base de datos a través de ajax
 * @module chat
 * @submodule enviarMensajeSala()
 */
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

/**
 * Compruebo si ha llegado un mensaje nuevo a la sala en la que se encuentra el usuario,
 * y si ha llegado un mensaje nuevo llamo a la función checkPermiso()
 * @module chat
 * @submodule checkMensajeNuevo()
 * @param {string} nameSala El nombre de la sala que se está accediendo
 * @param {integer} antiguos El número de mensajes que hay en la sala antes de comprobar si hay mensajes nuevos
 * @param {integer} nuevos El número de mensajes que hay en la sala después de comprobar si hay mensajes nuevos
 * @param {string} autor El nombre del usuario que ha enviado el último mensaje
 * @param {string} texto El contenido del mensaje
 */
function checkMensajeNuevo(nameSala,antiguos,nuevos,autor,texto){
    if (antiguos<nuevos) {
        checkPermiso(nameSala,autor,texto);
    }
}

/**
 * Compruebo si tengo permiso para enviar notificaciones, si no se ha especificado aun, lo pido,
 * y si obtengo permiso llamo a la función crearNotificacion()
 * @module chat
 * @submodule checkPermiso()
 * @param {string} nameSala El nombre de la sala que se está accediendo
 * @param {string} autor El nombre del usuario que ha enviado el último mensaje
 * @param {string} texto El contenido del mensaje
 */
function checkPermiso(nameSala,autor,texto){
    if (!("Notification" in window)) {
        alert("Tu navegador no soporta notificaciones!");
    }
    else if (Notification.permission === "granted") {
        crearNotification(autor+" escribió: "+texto+"","ProyectoXat sala: "+nameSala,"../img/logoChat.png");
    }
    else{
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                crearNotification(autor+" escribió: "+texto+"","ProyectoXat sala: "+nameSala,"../img/logoChat.png");
            }
        })
    }
}   

/**
 * Creo una notificación con los parámetros de entrada y un evento que cierra la notificación
 * @module chat
 * @submodule crearNotificacion()
 * @param {string} theBody El cuerpo de la notifiación
 * @param {string} theTitle El titulo de la notificación
 * @param {string} theIcon URL al icono de la notificación
 */
function crearNotification(theBody,theTitle,theIcon) {
    var options = {
        body: theBody,
        icon: theIcon
    }
    var n = new Notification(theTitle,options);
    /**
         * Cierra la notificación 8 segundos después de aparecer
         *
         * @event cerrar
         * @param {Object} n Objeto a cerrar tras 8 segundos
    */
    setTimeout(n.close.bind(n),8000);
}