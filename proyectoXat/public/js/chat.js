function abrirSala(sala) {
    alert(sala);
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
     xmlhttp = new XMLHttpRequest();
    } else {
      // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
           var mensaje = new Array();
           mensaje.push(this.responseText);
          for (var key in this.responseText) {
              $('boxMensajes').append($('<p></p>').text(this.responseText[key]));
              console.log("key " + key + " has value " + this.responseText[key]);
          }
          document.getElementById("boxMensajes").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","http://localhost:8000/servicios/xat/"+sala,true);
    xmlhttp.send();

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