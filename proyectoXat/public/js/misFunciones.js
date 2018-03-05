/*

    Nombre fichero: misFunciones.js
    Creador: Marc Guerra
    Fecha creación: 05/03/2018
    Funcionalidad: Controlar todas las funcionalidades hechas en JS. 
                   Efectos, geolocalización, creación de formulario y ajax

*/
/*
 - Descripcion: con ésta función llamo a otras para los efectos
 - Parametros: null
 - Return: null
 */
$(function(){
    $(document).ready(function(){
        ocultar();
    });

    $('a[name=btnLogin]').hover((function() {
        aparecer("a[name=btnLogin]");
    }));

    $('a[name=btnRegistro]').hover((function() {
        aparecer("a[name=btnRegistro]");
    }));

    $('form[name=formRegistro]').hover((function() {
        mostrarDeslizando("button[name=btnEnvio]");
    }));

    $("#geocomplete").geocomplete({
        map: "#mapa"
    });
});

/*
 - Descripcion: efecto de mostrar
 - Parametros: elemento, evento, no opcional
 - Return: null
 */
function mostrar(elemento){
    $(elemento).show();
}

/*
 - Descripcion: efecto de ocultar
 - Parametros: null
 - Return: null
 */
function ocultar(){
    $("button[name=btnEnvio]").hide();
}

/*
 - Descripcion: efecto de aparecer
 - Parametros: elemento, evento, no opcional
 - Return: null
 */
function aparecer(elemento){
    $(elemento).fadeToggle(1500);
}

/*
 - Descripcion: efecto de mostrar deslizando
 - Parametros: elemento, evento, no opcional
 - Return: null
 */
function mostrarDeslizando(elemento){
    $(elemento).slideDown(1000);
}

/*
 - Descripcion: efecto de ocultar deslizando
 - Parametros: null
 - Return: null
 */
function ocultarDeslizando(){
    $("p").slideUp(1000);
}

/*
 - Descripcion: mapa google (not working)
 - Parametros: null
 - Return: null
 */
function mapaGoogle() {
    var latitud = latitud();
    var longitud = longitud();
    alert("latitud "+latitud);
    alert("longitud "+longitud);
    var mapOptions = {
        center: new google.maps.LatLng(latitud, longitud),
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.HYBRID
    }
    var map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
}

/*
 - Descripcion: cogo la latitud del usuario si el navegador lo permite
 - Parametros: null
 - Return: lat
 */
function latitud(){
    var lat = "";
    if (navigator.geolocation) {
        lat = navigator.geolocation.getCurrentPosition(devolverLatitud());
    }
    return lat;
}

/*
 - Descripcion: devuelvo la latitud del usuario
 - Parametros: posicion
 - Return: latitud
 */
function devolverLatitud(position){
    return position.coords.latitude;
}

/*
 - Descripcion: cogo la longitud
 - Parametros: null
 - Return: longitud
 */
function longitud(){
    var lon = "";
    if (navigator.geolocation) {
        lon = navigator.geolocation.getCurrentPosition(devolverLongitud());
    }
    return lon;
}

/*
 - Descripcion: devuelvo la longitud
 - Parametros: posicion
 - Return: longitud
 */
function devolverLongitud(position){
    return position.coords.longitude;
}

/*
 - Descripcion: creo el formulario de crear noticia a través de jquery
 - Parametros: null
 - Return: null
 */
function crearNoticia(){
    var form = $('form[name=formNoticia]');

    var divRowFormContent = $("<div></div>").addClass("row");

    var divTitulo = $("<div></div>").addClass("col-md-12");
    divTitulo.css("padding-bottom", "40px");

    var h2 = $("<h2></h2>").addClass("text-center title").text("Crear Noticia");
    divTitulo.append(h2);

    var divMargen = $("<div></div>").addClass("col-md-3");

    var divFormOuter = $("<div></div>").addClass("col-md-6 text-center");
    var divFormInner = $("<div></div>").addClass("form-group");

    var labelTitulo = $("<label></label>").text("Título");
    var inputTitulo = $("<input></input>").addClass("form-control");
    inputTitulo.attr({type:"text", name:"titulo"});

    var espaciamiento = $("<br></br>");

    var labelDesc = $("<label></label>").text("Descripción");
    var textAreaDesc = $("<textarea></textarea>").addClass("form-control").css("height","180px");
    textAreaDesc.attr({maxlength:"250",name:"descripcion"});

    var divImagen = $("<div></div>").addClass("col-md-4");
    var labelImagen = $("<label></label>").text("Imagen para añadir a la notícia:");
    var inputImagen = $("<input></input>").addClass("form-control");
    inputImagen.attr({type:"file",name:"imagen"});

    var divFecha = $("<div></div>").addClass("col-md-4");
    var labelFecha = $("<label></label>").text("Fecha de la notícia:");
    var inputFecha = $("<input></input>").addClass("form-control");
    inputFecha.attr({type:"date",name:"fecha"});

    var divCategoria = $("<div></div>").addClass("col-md-4");
    var labelCategoria = $("<label></label>").text("Categorías:");
    var inputCategoria = $("<select name='categoria'></select>").addClass("form-control").append(
                                $("<option value='Deportes'></option>").text("Deportes"),
                                $("<option value='Informatica'></option>").text("Informatica"),
                                $("<option value='Cultura'></option>").text("Cultura"),
                                $("<option value='Arte y literatura'></option>").text("Arte y literatura"),
                                $("<option value='Otros'></option>").text("Otros"),
                                                            );

    divImagen.append(labelImagen,inputImagen);
    divFecha.append(labelFecha,inputFecha);
    divCategoria.append(labelCategoria,inputCategoria);

    divFormInner.append(labelTitulo,inputTitulo,espaciamiento,labelDesc,textAreaDesc,espaciamiento,espaciamiento,divImagen,divFecha,divCategoria);
    divFormOuter.append(divFormInner);
    divRowFormContent.append(divTitulo, divMargen, divFormOuter);

    var divRowFormSubmit = $("<div></div>").addClass("row");
    var divMargen2 = $("<div></div>").addClass("col-md-4");
    var divCentrado = $("<div></div>").addClass("col-md-4");
    var botonSubmit = $("<button></button>").addClass("btn btn-primary col-md-12");
    botonSubmit.attr("type","submit").text("Crear noticia");

    divCentrado.append(espaciamiento,botonSubmit);
    divRowFormSubmit.append(divMargen2,divCentrado);

    $('div[name=substituir1]').replaceWith(divRowFormContent);
    form.append(divRowFormSubmit);
}

/*
 - Descripcion: a través de ajax hago una petición a la bd para recibir las noticias de la categoria seleccionada
 - Parametros: null
 - Return: null
 */
function buscarNoticia() {
    $('#categoria').empty();
    var categoria = $('#noticiasCategorias option:selected').text();
    $.ajax({
        type: "GET",
        url: "http://127.0.0.1:8000/servicios/noticias/"+categoria,
        dataType: "json",
        success: function (data) {
            for (var key in data) {
                $('#categoria').append(
                    $('<div class="col-md-2"></div>'),
                    $('<div class="col-md-8" style="margin-top: 50px; background-color: lightgrey; border-radius: 15px; padding: 20px;"></div>').append(
                        $('<div class="col-md-8"></div>').append(
                            $('<h3></h3>').text(data[key]["titulo"]),
                            $('<p></p>').text(data[key]["descripcion"])
                        ),
                        $('<div class="col-md-2"></div>').append(
                                $('<img src="http://127.0.0.1:8000/'+data[key]["imagen"]+'" alt="Imagen no disponible!" style="height:200px; width: 280px;">')

                    )));
            }
            console.log(data);
        }
    });
}