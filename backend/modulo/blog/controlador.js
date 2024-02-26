
$("#gale").sortable({
    placeholder: "ui-state-highlight",
    cursor: 'move'
});

$("#gale").disableSelection();

var $table = $('#tablaBlog').tablesorter({
    widgets: ["filter"],
    widgetOptions: {
        filter_external: '.searchBlog',
        filter_defaultFilter: { 1: '~{query}' },
        filter_columnFilters: true,
        filter_placeholder: { search: 'Search...' },
        filter_saveFilters: false,
        filter_reset: '.reset'
    }
});

$(".btn-duplicar-blog").click(function () {
    var pass = "", arrayDatos = [];

    pass = validarCamposVacios("formulario-informacion-modal-duplicar-blog");
    console.log("validarCamposVacios...pass: " + pass);

    arrayDatos = recopilarDatosFuncion("formulario-informacion-modal-duplicar-blog", "duplicar");
    console.log(arrayDatos);
    if (pass) {
        $.ajax({
            data: arrayDatos,
            url: "modelo.php",
            type: 'post',
            async: true,
            beforeSend: function () {
                console.log("Enviando información...");
            },
            success: function (response) {
                console.log(response);

                if (response > 0) {
                    $('#ajaxBusy').fadeOut(500);
                    restablecerOpciones();
                    listarDatos();
                    novisibleOpciones();
                    $("#formulario-duplicar-blog").modal("hide");
                    mostrarExitoSistema("center", "Bien", 1500, "Se duplicó correctamente");// posicion, titulo, tiempo, html

                } else if (response == "existe") {
                    mostrarErrorSistema("warning", "Duplicó", "Duplicado", "El nombre ya existe");// tipo, funcion, titulo, msj, input, clase
                } else {
                    mostrarErrorSistema("error", "No se puede actualizar", "¡Error!", response);// tipo, funcion, titulo, msj
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                mostrarErrorFunciones("Duplicar", xhr.status, xhr.responseText, textStatus, errorThrown);
                console.log("No se puede ejecutar duplicar de " + $("#valTitle").val());
            }
        });
    }
});

// ABRE EL MODAL
$(".duplicar-elemento").click(function () {
    $("body").addClass("no-scroll");

    var arrayDatos = consultarIdIndividual();
    var id = arrayDatos["id"];
    var nombre = arrayDatos["nombre"];

    $("#idhid_blog").val(id);
    $("#nombre-duplicar").val(nombre);

});

$(".cerrar-duplicar-blog").click(function () {
    $("#formulario-duplicar-blog").modal("hide");
    $(".eleOpc").attr("data-blog", "");
    $('.formulario-informacion-modal-duplicar-blog input, .formulario-informacion-modal-duplicar-blog select, .formulario-informacion-modal-duplicar-blog textarea').each(function () {
        $(this).val("");
        $(this).removeClass("error");
    });

    $("body").removeClass("no-scroll");
    $("body").removeClass("modal-open");
});

$('#tablaBlog').on('click', 'tr td', function () {
    //console.log("click tr td");
    if (!$(this).hasClass('primera-columna')) {
        //console.log("if");
        $(this).parent().find('.seleccion').trigger('click');
    } else {
        //console.log("else");
    }
});

$(".cerrar").click(function () {
    tinyMCE.get('desc_blog').setContent('');
});

// ORDENAMIENTO DE DATOS DE LA TABLA
$('#tablaBlog').tablesorter();
// LISTA LOS DATOS EN LA TABLA PRINCIPAL
listarDatos();

// NUEVOS DATOS
$('.guardar-datos, .editar-datos').on('click', function () { // guardar-datos: REGISTRAR, editar-datos: GUARDAR
    $('#ajaxBusy').fadeIn();

    var accion = $(this).data('accion');
    var accionTxt = ((accion == "editar") ? "actualizo" : "registro");
    var pass = "", arrayDatos = [];

    var desc_blog = tinyMCE.get('desc_blog').getContent();
    $("#desc_blog").val(desc_blog);

    pass = validarCamposVacios("recopilar-datos");
    console.log("validarCamposVacios...pass: " + pass);

    console.log(arrayDatos);

    //Verifica que paso las pruebas de lectura y envia en caso contario no envia 
    if (pass) {

        var cadenaFotos = "", contadorGal = 0;
        $("#gale li a").each(function () {

            if ($(this).attr("rel") != undefined) {
                cadenaFotos = cadenaFotos + "**" + $(this).attr("rel");
                console.log("rel: " + $(this).attr("rel"));
                console.log("cadenaFotos: " + cadenaFotos);
                contadorGal++;
            }

        });

        arrayDatos = recopilarDatosFuncion("recopilar-datos", accion);
        arrayDatos['galeria_blog'] = cadenaFotos;

        console.log(arrayDatos);

        $.ajax({
            data: arrayDatos,
            url: "modelo.php",
            type: 'post',
            async: true,
            beforeSend: function () {
                console.log("Enviando información...");
            },
            success: function (response) {
                console.log(response);
                $('#ajaxBusy').fadeOut();

                if (response > 0) {
                    $('.titulo').text($("#valTitle").val() + " " + $("#valActivo").val());
                    $('.editar-datos').data('accion', 'guardar').addClass('guardar-datos').removeClass('editar-datos'); // guardar-datos: REGISTRAR, editar-datos: GUARDAR

                    resetInputs();
                    tinyMCE.get('desc_blog').setContent('');
                    restablecerOpciones();
                    cambiarVista();
                    listarDatos();
                    novisibleOpciones();
                    mostrarExitoSistema("center", "Bien", 1500, "Se " + accionTxt + " correctamente");// posicion, titulo, tiempo, html
                } else if (response == "existe") {
                    mostrarErrorSistema("warning", accionTxt, "Duplicado", "El nombre ya existe");// tipo, funcion, titulo, msj, input, clase
                } else {
                    mostrarErrorSistema("error", "No se puede actualizar", "¡Error!", response);// tipo, funcion, titulo, msj, input, clase
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                mostrarErrorFunciones("Registrar o Guardar", xhr.status, xhr.responseText, textStatus, errorThrown);
                console.log("No se puede ejecutar " + accion + " de " + $("#valTitle").val());
            }
        });

    } else {
        $('#ajaxBusy').fadeOut();
    }
});

// CARGAR PARA EDICION DE DATOS 
$(document).on('click', '.editar-elemento', function () {

    var arrayDatos = consultarIdIndividual();
    var id = arrayDatos["id"];
    //console.log(arrayDatos);

    if (id > 0) {

        $('.titulo').text('Detalle ' + $("#valTitle").val());

        $('input:radio[name=itemOpciones]').each(function () {
            $(this).prop("disabled", true);
        });

        $('.guardar-datos').data('accion', 'editar').addClass('editar-datos').removeClass('guardar-datos'); // guardar-datos: REGISTRAR, editar-datos: GUARDAR

        resetInputs();
        tinyMCE.get('desc_blog').setContent('');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'modelo.php',
            data: ({ accion: 'consultar', id: id }),
            beforeSend: function () {
                $("#ajaxBusy").fadeIn();
            },
            success: function (data) {
                console.log(data);
                $("#idEdit").val(id);

                $('#nom_blog').val(data[0].nom_blog);
                $('#texto1_blog').val(data[0].texto1_blog);

                if (data[0].desc_blog !== "" && data[0].desc_blog !== null) {
                    tinyMCE.get('desc_blog').setContent(data[0].desc_blog);
                }
                $("#respuestafoto1").css({ "z-index": 3 });
                $("#foto1").val(data[0].foto_blog);
                $("#respuestafoto1").html("\
                        <a title='Eliminar imagen' class='eliminarImagen' data-inp='foto1' data-img='1'>\
                                                <i class='fa fa-remove' aria-hidden='true'></i>\
                                            </a><a class='linkimg' href='"+ data[0].urlfoto_blog + "' target='_blank'>\
                                                <img src='"+ data[0].urlfoto_blog + "' class='foto-foto'>\
                                            </a>");
                // A UN LINK EN ESPECIFICO
                $(".linkimg").magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom', // this class is for CSS animation below
                    gallery: {
                        enabled: true // read about this option in next Lazy-loading section
                    }
                });

                $("#gale").html("");
                if (data[0].galeria_blog !== "") {
                    var galeria_blog = data[0].galeria_blog;
                    var fotos = galeria_blog.split('**');

                    if ($.isEmptyObject(fotos)) {
                        console.log("Fotos vacias");
                    } else {
                        for (var i = 0; i < fotos.length; i++) {
                            if (fotos[i] !== "") {
                                $('#gale').append('\
                                        <li id="imagen-'+ data[0].id + '" class="ui-sortable-handle">\
                                            <a href="../../../uploads/blog/thumb/'+ fotos[i] + '" class="galeria">\
                                                <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>\
                                                <div class="view view-first">\
                                                    <img src="../../../uploads/blog/thumb/'+ fotos[i] + '" alt="imagenes">\
                                                    <div class="mask">\
                                                        <a href="#" class="eliminar" rel="'+ fotos[i] + '" title="imagenes">Eliminar</a>\
                                                    </div>\
                                                </div>\
                                            </a>\
                                        </li>');

                            }
                        }

                    }
                }

                cambiarVista();
                $("#ajaxBusy").fadeOut(500);
            }
        });
    } else {
        console.error("No tiene ID(" + id + ") para editar");
    }
});

// ELIMINAR DATOS
$(document).on('click', '.eliminar-elemento', function (event) {
    event.preventDefault();

    var arrayDatos = consultarIdIndividual();
    var id = arrayDatos["id"];
    var nombre = arrayDatos["nombre"];

    if (id > 0) {
        console.log("eliminar-elemento...id: " + id);
        $('#txtEliminar').html(nombre);
        $('#eliminar').val(id);
        $('#alerta').dialog('open');
    } else {
        console.error("No tiene ID(" + id + ") para eliminar");
    }

});

$('#alerta').dialog({
    title: "Confirmar eliminación",
    autoOpen: false,
    draggable: false,
    modal: true,
    width: 280,
    height: "auto",
    resizable: false,
    open: function (event, ui) {
        $("body").css({ "overflow": "hidden" });
    },
    close: function (event, ui) {
        $("body").css({ "overflow": "auto" });
    },
    show: {
        effect: "fade",
        duration: 300
    },
    hide: {
        effect: "fade",
        duration: 300
    },
    buttons: [
        {
            text: 'Cancelar',
            class: 'dialog-btn-cancelar',
            click: function () {
                $(this).dialog('close');
            }
        }, {
            text: 'Confirmar',
            class: 'dialog-btn-confirmar',
            click: function () {
                var obj = {
                    'accion': 'eliminar',
                    'id_blog': $('#eliminar').val()
                };

                $.post('modelo.php', obj, function (data) {
                    if (data == 1) {
                        $("#alerta").dialog('close');
                        restablecerOpciones();
                        listarDatos();
                        novisibleOpciones();
                        $('#ajaxBusy').fadeOut(500);
                    } else {
                        console.error("No se puede eliminar " + $("#valTitle").val());
                    }

                });


            }
        }
    ]
});

// ELIMINAR IMAGEN
$("#gale").on("click", ".eliminar", function (event) {
    event.preventDefault();
    console.log("Eliminar galeria");
    var elim = $("#imagen-eliminar").val();
    elim = elim + "**" + $(this).attr("rel");

    var cont = $(this).parent().parent().parent();

    $("#alerta2").dialog({
        autoOpen: true,
        draggable: false,
        modal: true, width: "auto",
        show: {
            effect: "fade",
            duration: 300
        },
        hide: {
            effect: "fade",
            duration: 100
        },
        buttons: [
            {
                text: "Cancelar",
                click: function () {
                    $(this).dialog("close");
                }
            },
            {
                text: "Eliminar",
                click: function () {
                    cont.remove();
                    $("#imagen-eliminar").val(elim);
                    $(this).dialog("close");
                }
            }
        ]
    });
});

// FILTRAR DATOS LISTADO DE LA TABLA PRINCIPAL
function listarDatos () {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'modelo.php',
        data: ({
            accion: 'listar'
        }),
        success: function (response) {
            //console.log(response);
            var html = '', contador = 0;
            if ($.isEmptyObject(response)) {
                console.log("Obj vacio");
            } else {
                $.each(response, function (i, item) {
                    html += '<tr>';
                    html += '    <td style="width: 5%;" class="primera-columna"><input id="idopc' + item.id_blog + 'turn' + contador + '" type="checkbox" name="itemOpciones" data-nombre="' + item.nom_blog + '" class="seleccion resetItemOpciones" value="' + item.id_blog + '" /><label for="idopc' + item.id_blog + 'turn' + contador + '" class="fw-normal"><span></span></label></td>';
                    //html += '    <td style="width: 15%;">'+item.idtxt_blog+'</td>';
                    html += '    <td style="width: 65%;"><a href="' + $urlsitio + 'blog/' + item.url_blog + '" target="_blank">' + item.nom_blog + '</a></td>';
                    html += '    <td style="width: 30%;">' + item.fechaact_blog + ' ' + item.horaact_blog + '</td>';
                    html += '</tr>';
                    contador++;
                });
            }

            if (html === '') {
                html = '<tr><td colspan="3" align="center">No se encontraron registros..</td></tr>';
            }
            $('#tablaBlog tbody').html(html);

            $('#tablaBlog').trigger('update');
            $('#tablaBlog').tablesorterPager({ container: $('#pagerBlog') });
        }
    });
}





