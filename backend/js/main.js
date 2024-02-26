
$(document).ready(function () {

    $(".toptip").tooltip({
        placement: "top",
        html: true,
        trigger: "focus",
        animation: true,
    });
    $(".righttip").tooltip({
        placement: "right",
        html: true,
        trigger: "focus",
        animation: true,
    });
    $(".bottomtip").tooltip({
        placement: "bottom",
        html: true,
        trigger: "focus",
        animation: true,
    });
    $(".lefttip").tooltip({
        placement: "left",
        html: true,
        trigger: "focus",
        animation: true,
    });


    $(".hovertoptip").tooltip({
        placement: "top",
        html: true,
        trigger: "hover",
        animation: true,
    });
    $(".hoverrighttip").tooltip({
        placement: "right",
        html: true,
        trigger: "hover",
        animation: true,
    });
    $(".hoverbottomtip").tooltip({
        placement: "bottom",
        html: true,
        trigger: "hover",
        animation: true,
    });
    $(".hoverlefttip").tooltip({
        placement: "left",
        html: true,
        trigger: "hover",
        animation: true,
    });

    $(".toptip, .righttip, .bottomtip, .lefttip").on("show.bs.tooltip", function () {
        //console.log("Evento focus show...");
        $(".chovertooltip").tooltip("hide");

    });
    $(".hovertoptip, .hoverrighttip, .hoverbottomtip, .hoverlefttip").on("show.bs.tooltip", function () {
        //console.log("Evento hover show...");
        $(".cfocustooltip").tooltip("hide");
        focusInput();
    });

    var ventanaAncho = $(window).width();
    if (ventanaAncho < 768) {
    } else if (ventanaAncho >= 768 && ventanaAncho <= 1024) {// Tablets
    } else {
    }

    $(document).on('change', 'input[name=itemOpciones]', function (e) {

        if ($(this).is(':checked')) {
            $(this).prop("checked", true);
            seleccionadosChkSess++;
        } else {
            $(this).prop("checked", false);
            seleccionadosChkSess--;
        }

        if (seleccionadosChkSess > 0) {
            visibleOpciones();

            $("#lblTotal").html(seleccionadosChkSess + " de " + totalOpcionesSess);

            if (seleccionadosChkSess == 1) {
                $(".eleOpcSelecciono").css({ "display": "none" });
                $("#cantidadEliminar").html(0);
                $(".eleOpc").fadeIn(100);
            } else {
                $(".eleOpc").css({ "display": "none" });
                $(".eleOpcSelecciono").fadeIn(100);
                $("#cantidadEliminar").html(seleccionadosChkSess);
                $(".eleOpcSelecciono").data("total", seleccionadosChkSess);
            }
        } else {
            novisibleOpciones();
            $(".eleOpc").css({ "display": "none" });
            $("#lblTotal").html("Seleccione una o más opciones");
        }

        //console.log("seleccionadosChkSess: "+seleccionadosChkSess);
    });

    $(document).on('click', '.eliminar-elemento-seleccion', function (event) {
        event.preventDefault();
        var total = $(this).data("total");
        $("#idEliminarSeleccion").html(total)
        $('#alerta-seleccion').dialog('open');
        //var rem = $(this).attr('rel');
        //var rem = $(this).attr('data-id');
        $('#eliminar-seleccion').val("");
    });

    $('#alerta-seleccion').dialog({
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

                    var seleccionados = obtenerSeleccionados();

                    var obj = {
                        'accion': 'eliminarSeleccion',
                        'tabla': $("#tablaSeleccion").val(),
                        'termino': $("#terminoSeleccion").val(),
                        'arregloID': seleccionados,
                    };
                    //console.log(obj);
                    $.post($url + 'includes/_funciones.php', obj, function (data) {
                        //console.log(data);
                        if (data > 0) {
                            $("#alerta-seleccion").dialog('close');
                            restablecerOpciones();
                            novisibleOpciones();
                            listarDatos();
                            $('#ajaxBusy').fadeOut(500);
                        } else {
                            console.error("No se puede eliminar " + $("#valTitle").val());
                        }

                    });

                }
            }
        ]
    });

    /* * * * * ** * * * * - - BEGIN resize DIALOG - - * * * * * ** * * * */
    $(window).resize(function () {
        //console.log('window resize');
        fluidDialog();
    });

    $(document).on("dialogopen", ".ui-dialog", function (event, ui) {
        //console.log('dialogopen -> ui-dialog');
        fluidDialog();
    });
    /* * * * * ** * * * * - - END resize DIALOG - - * * * * * ** * * * */

    $(".fecha").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-0:+2",
        minDate: new Date()
    });/*   Para el rango puede ser yearRange: "-100:+0" ó yearRange: '1950:2013'   */

    var $body = $('body'),
        $left = $('.left-col'),
        $right = $('.right-col'),
        $header = $('#main-header'),
        $footer = $('#main-footer');

    $(document).on('click', '.ayuda-elemento', function () {
        var titulo = $(this).data("titulo"), mensaje = $(this).data("mensaje");
        $("#titMsj").html(titulo);
        $("#infoMsj").html(mensaje);
        $("#vtnInfo").dialog('open');
    });

    $(document).on('click', '.eliminarImagen', function () {
        var idimg = $(this).data("img"), input = $(this).data("inp"), tipo = $(this).data("tipo"); //    tipo: 1= archivos pdf

        if (idimg == undefined) {
            idimg = "";
        }
        console.log("idimg: " + idimg);

        if (tipo == 1) {// Archivo PDF
            $("#respuestapdf" + idimg).css({ "z-index": -1 });
            $('#' + input).val("");
            $("#respuestapdf" + idimg).html("");
        } else {
            $("#respuestafoto" + idimg).css({ "z-index": -1 });
            $('#' + input).val("");
            $("#respuestafoto" + idimg).html("");
        }
        if (idimg == 2) {
            $("#respuestapdf").css({ "z-index": -1 });
            $('#' + input).val("");
            $("#respuestapdf").html("");
        }

    });

    $(document).on('click', '.agregarNuevo', function () {
        var iddiv = $(this).data("iddiv");
        $('#' + iddiv).dialog('open');
    });

    $('.ventana').dialog({
        title: "Agregar",
        autoOpen: false,
        draggable: false,
        modal: true,
        width: 280,
        height: "auto",
        resizable: false,
        fluid: true, //new option
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
                text: 'Registrar',
                class: 'dialog-btn-confirmar',
                click: function () {
                    var funcion = $(this).data("funcion"), url = $(this).data("url"), recibe = $(this).data("recibe");
                    //console.log("funcion..."+funcion+", url: "+url);
                    $('#ajaxBusy').fadeIn(500);
                    var pass = '1';
                    var obj = {
                        'accion': funcion
                    };

                    //LEE LOS DATOS UNO POR UNO
                    $('.recopilar-datos-agregar input, .recopilar-datos-agregar textarea, .recopilar-datos-agregar select').each(function () {
                        obj[$(this).attr('name')] = $(this).val(); //Almacena en OBJ para envio
                        $(this).removeClass('error'); //Remueve clase error
                        // Verifica si esta vacio el campo o si tiene la clase required
                        if (($(this).val() === '') && (!$(this).hasClass('norequired'))) {
                            $(this).addClass('error');
                            pass = '0'; // Si se cumplen se rompe el ciclo 
                            return false;
                        }
                    });

                    if (pass !== '0') {
                        $.post(url, obj, function (data) {
                            //console.log(data);
                            if (data > 0) {
                                //console.log("Recibe funcion: "+recibe);
                                setTimeout(recibe, 2000);
                                $(".recopilar-datos-agregar").dialog('close');
                                $('#ajaxBusy').fadeOut(500);
                            } else {
                                console.error("No se puede " + funcion + " ");
                            }

                        });
                    } else {
                        $('#ajaxBusy').fadeOut(500);
                    }
                }
            }
        ]
    });

    $('#vtnInfo').dialog({
        title: "Información",
        autoOpen: false,
        draggable: false,
        modal: true,
        width: 300,
        height: "auto",
        resizable: false,
        fluid: true, //new option
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
                text: 'Aceptar',
                class: 'dialog-btn-aceptar',
                click: function () {
                    $(this).dialog('close');
                }
            }
        ]
    });



    // REMOVER CLASES DE ERROR //
    $('input, textarea').keyup(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
            return false;
        }
    });

    $('select').change(function () {
        if ($(this).val() !== '') {
            $(this).removeClass('error');
        }
    });

    // LOADING //
    $('body').append('<div id="ajaxBusy"><div class="box"><div class="content"><img src="' + $url + 'img/wait.gif"><br><p class="porcentaje" style="display:none;">0</p><br>Cargando...<br>espere un momento por favor</div></div></div>');

    $('#ajaxBusy').css({ height: $(window).height() });

    $(".menu").click(function () {
        $body.toggleClass("nav-sm");
        ajustarContenido()
    });

    // TODO: This is some kind of easy fix, maybe we can improve this
    function ajustarContenido () {
        var altura = $left.height() > $body.outerHeight() ? $left.height() : $(window).height();
        altura -= ($header.height() + $footer.height());
        $right.css('min-height', altura);

        if ($(document).height() > $left.height()) {
            $left.css('min-height', $(document).height());
        }

        $('#ajaxBusy').css({ height: $(window).height() });

    };

    // recompute content when resizing
    $(window).resize(function () {
        ajustarContenido();
    });
    ajustarContenido();

    // HACE EL TOGGLE DE LOS DATOS QUE SE SOLICITEN SHOW / HIDE
    $(".agregar-datos").click(function () {
        $(".editar-datos").data('accion', 'guardar').addClass("guardar-datos").removeClass("editar-datos");
        resetInputs();
        restablecerOpciones();
        cambiarVista();
    });

    $(".cerrar").click(function () {
        $('.titulo').text($("#valTitle").val() + " " + $("#valActivo").val());
        $(".editar-datos").data('accion', 'guardar').addClass("guardar-datos").removeClass("editar-datos");
        resetInputs();
        restablecerOpciones();
        cambiarVista();
        novisibleOpciones();

    });

    $("input[type=autocomplete]").autocomplete({
        source: function (request, response) {

            var id = $(this.element).attr("id"),
                accion = $(this.element).data("accion"),
                modulo = $(this.element).data("modulo"),
                guardaID = $(this.element).data("recibe");

            //console.log("ID: "+id+", Accion: "+accion);

            $.ajax({
                url: $url + "modulo/" + modulo + "/modelo.php",
                dataType: "json",
                type: "POST",
                data: {
                    accion: accion,
                    palabra: request.term
                },
                beforeSend: function () {
                    //console.log("autocomplete en ID..."+id);
                    $('#ajaxBusy').fadeIn();
                },
                success: function (data) {
                    arregloResultados = [];
                    if (data.length > 0) {
                        $('#ajaxBusy').fadeOut();
                        for (var val in data) {
                            thisArr = [];
                            thisArr.value = data[val].nombre;
                            thisArr.id = data[val].id;
                            thisArr.nombre = data[val].nombre;
                            thisArr.guardaID = guardaID;

                            arregloResultados.push(thisArr);
                            response(arregloResultados);
                        }
                    } else {
                        $('#ajaxBusy').fadeOut();
                        response(arregloResultados);
                        //console.log("No se encontraron resultados");
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error("Modulo: " + modulo + ", Funcion: " + accion + " autocomplete= xhr.status: " + xhr.status + ", xhr.responseText: " + xhr.responseText + ", textStatus: " + textStatus + ", errorThrown: " + errorThrown);
                }
            });
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.nombre);
            $("#" + ui.item.guardaID).val(ui.item.id);
        }
    });



});

function resetInputs () {
    //console.log("resetInputs...exe ");
    $(".resetItemOpciones").prop("checked", false);
    seleccionadosChkSess = 0;
    $("#lblTotal").html("Seleccione una o más opciones");

    $("#idEdit").val('');
    // Elimina datos de la imagen cargada
    $("#simple-name, #portada").val('');
    $("#simple-img").html('');

    //IMAGENES
    $("#icono").val('');
    $("#icono2").val('');
    $("#icono3").val('');
    $(".imagenesResp").html('');
    $(".imagenesResp2").html('');
    $(".imagenesResp3").html('');
    $("#respuestafoto").css({ "z-index": -1 });
    $("#respuestafoto2").css({ "z-index": -1 });
    $("#respuestafoto3").css({ "z-index": -1 });

    $(".listaTels").html('');
    $("#seccLbl").val('');
    $("#eliminarLbl").val('');
    $("#sucLbl").val(0);
    $("#contadorTel").val(0);

    $(".galeria").html("");

    // Limpia Inputs
    $('.recopilar-datos input[type="text"], \
        .recopilar-datos input[type="autocomplete"], \
        .recopilar-datos input[type="email"], \
        .recopilar-datos input[type="password"], \
        .recopilar-datos input[type="number"], \
        .recopilar-datos input[type="tel"], \
        .recopilar-datos select, \
        .recopilar-datos textarea').each(function () {

        if (!$(this).hasClass('sys')) {
            $(this).val("");
            $(this).removeClass("error");
        }
    });

    $(".recopilar-datos select option:first").attr('selected', 'selected');
    $('.recopilar-datos input[type="checkbox"]').prop('checked', false).prop('disabled', false);
    $(".modulo").removeClass("disabled");
}

// HACE EL TOGGLE DE LOS DATOS QUE SE SOLICITEN SHOW / HIDE
function cambiarVista () {
    var verificar = $('.vista-principal').is(':visible') ? 'si' : 'no';

    if (verificar === 'si') {
        $(".vista-principal").removeClass("pt-page-scaleDownUp pt-page-scaleUpDown").addClass("pt-page-scaleDownUp").fadeOut(500);
        $(".vista-edicion").removeClass("pt-page-scaleDownUp pt-page-scaleUpDown").delay(500).addClass("pt-page-scaleUpDown").fadeIn(500);

    } else {
        $(".vista-edicion .titulo").text($("#titulo-default").val());
        $(".vista-edicion").removeClass("pt-page-scaleDownUp pt-page-scaleUpDown").addClass("pt-page-scaleDownUp").fadeOut(500);
        $(".vista-principal").removeClass("pt-page-scaleDownUp pt-page-scaleUpDown").delay(500).addClass("pt-page-scaleUpDown").fadeIn(500);
        $('#data1').prop("disabled", false);
    }
}

function restablecerOpciones () {
    //$(".eleOpc").attr("data-id", 0);
    $(".eleOpc").fadeOut();
    $(".eleOpcSelecciono").fadeOut();
    seleccionadosChkSess = 0;
    $("#lblTotal").html("Seleccione una o más opciones");

    $('input:radio[name=itemOpciones]').each(function () {
        $(this).prop("disabled", false);
        $(this).prop("checked", false);
    });
}

function fluidDialog () {
    //console.log('fluidDialog...exe');
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
        // if fluid option == true
        if (dialog.options.fluid) {
            var wWidth = $(window).width();
            // check window width against dialog width
            if (wWidth < (parseInt(dialog.options.maxWidth) + 50)) {
                // keep dialog from filling entire screen
                $this.css("max-width", "90%");
            } else {
                // fix maxWidth bug
                $this.css("max-width", dialog.options.maxWidth + "px");
            }
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }
    });

}

function obtenerSeleccionados () {
    // Lee los porductos que tendra
    var arrItemDatos = [], contador = 0;

    $('input:checkbox[name=itemOpciones]:checked').each(function () {
        arrItemDatos.push($(this).val());
    });

    return arrItemDatos;
}

function validarCamposVacios (clase) {
    //console.log("validarCamposVacios..."+clase);
    var pasar = 1;

    $('.' + clase + ' input, .' + clase + ' textarea, .' + clase + ' select').each(function () {
        var name_input = $(this).attr('name'), valor = $(this).val(), nombreCampo = ($(this).data('tcampo') != "") ? $(this).data('tcampo') : $(this).attr('id');

        if (
            (valor === '' || valor == 0) &&
            (!$(this).hasClass('norequired')) &&
            (!$(this).hasClass('sys')) &&
            (!$(this).hasClass('tablesorter-filter'))
        ) {
            mostrarErrorSistema("warning", "Campo vacío", "Completar", nombreCampo);// tipo, funcion, titulo, msj

            $(this).addClass('error');

            pasar = 0;
            return false;

        }
    });// END each

    return pasar;
}

function recopilarDatosFuncion (clase, accion) {
    //console.log("recopilarDatosFuncion...clase: "+clase+", accion: "+accion);

    var obj = {
        'accion': accion
    };

    //LEE LOS DATOS UNO POR UNO
    $('.' + clase + ' input, .' + clase + ' textarea, .' + clase + ' select').each(function () {
        var name_input = $(this).attr('name'), valor = $(this).val();

        obj[name_input] = valor; //Almacena en OBJ para envio

    });

    return obj;
}

function visibleOpciones () {
    //console.log("visibleOpciones...");
    $(".col-tabla-registros").removeClass("col-sm-12").addClass("col-sm-10");
    $(".col-tabla-opciones").removeClass("invisible-col").addClass("visible-col");
}

function novisibleOpciones () {
    //console.log("novisibleOpciones...");
    $(".col-tabla-opciones").removeClass("visible-col").addClass("invisible-col");
    $(".col-tabla-registros").removeClass("col-sm-10").addClass("col-sm-12");
}

function mostrarErrorFunciones (funcion, xhrstatus, response, txtstatus, error) {
    var errorHtml = funcion + " = xhr.status: " + xhrstatus + ", xhr.responseText: " + response + ", textStatus: " + txtstatus + ", errorThrown: " + error;
    //console.error(errorHtml);
    mostrarErrorSistema("error", "Error 500", funcion, errorHtml);// tipo, funcion, titulo, msj
}

function mostrarErrorSistema (tipo, funcion, titulo, msj, input, clase = "btn-gral") {
    //console.log("mostrarErrorSistema...funcion: "+funcion+", clase: "+clase);

    Swal.fire({
        type: tipo,
        title: titulo,
        //text: "Mensaje de sistema",
        html: msj,
        //footer: 'Función: '+funcion,
        confirmButtonText: 'Aceptar',
        customClass: clase,
    }).then((result) => {
        //console.log("dio click");
        switch (result.value) {
            default:
                $('#ajaxBusy').fadeOut();

        }// end switch
        // if (result.value) {
        // }
    });
}

function mostrarExitoSistema (posicion, titulo, tiempo, texto = "") {
    $(".porcentaje").html("<b>0 %</b>");
    $(".porcentaje").css({ "display": "none" });

    Swal.fire({
        position: posicion,
        type: 'success',
        title: titulo,
        html: texto,
        showConfirmButton: false,
        timer: tiempo
    });
}

function consultarIdIndividual () {

    var arrayDatos = {}, contador = 0, id = 0, nombre = "";
    $('input[name=itemOpciones]').each(function () {
        if ($(this).is(':checked')) {
            contador++;
        }
    });
    //console.log("checked: "+contador);
    if (contador == 1) {
        id = $("input[name=itemOpciones]:checked").val();
        nombre = $("input[name=itemOpciones]:checked").data("nombre");

        arrayDatos["id"] = id;
        arrayDatos["nombre"] = nombre;

        //console.warn("arrayDatos... id a editar: "+id+", nombre: "+nombre);
    }
    //console.warn(arrayDatos);
    return arrayDatos;

}

function focusInput () {
    //console.log("focusInput...");
    $(".btn-gral.cerrar").focus();
    //return false;
}

