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

/*$('button[name=btnRegistro]').click(aparecer);
$('button[name=btnDesvanecer]').click(desvanecer);
$('button[name=btnDeslizarMostrar]').click(mostrarDeslizando);
$('button[name=btnDeslizarOcultar]').click(ocultarDeslizando);*/

function mostrar(elemento){
    $(elemento).show();
}

function ocultar(){
    $("button[name=btnEnvio]").hide();
}

function aparecer(elemento){
    $(elemento).fadeToggle(1500);
}

function mostrarDeslizando(elemento){
    $(elemento).slideDown(1000);
}

function ocultarDeslizando(){
    $("p").slideUp(1000);
}

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

function latitud(){
    var lat = "";
    if (navigator.geolocation) {
        lat = navigator.geolocation.getCurrentPosition(devolverLatitud());
    }
    return lat;
}

function devolverLatitud(position){
    return position.coords.latitude;
}

function longitud(){
    var lon = "";
    if (navigator.geolocation) {
        lon = navigator.geolocation.getCurrentPosition(devolverLongitud());
    }
    return lon;
}

function devolverLongitud(position){
    return position.coords.longitude;
}

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

function buscarNoticia() {
    $('#categoria').empty();
    var categoria = $('#noticiasCategorias option:selected').text();
    $.ajax({
        type: "GET",
        url: "/servicios/noticias/"+categoria,
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
                                $('<img src="/'+data[key]["imagen"]+'" alt="Imagen no disponible!" style="height:200px; width: 280px;">')

                    )));
            }
            console.log(data);
        }
    });
}