

    $('#tablaConfig').on('click', 'tr td', function(){
        //console.log("click tr td");
        if(!$(this).hasClass('primera-columna')){
            //console.log("if");
            $(this).parent().find('.seleccion').trigger('click'); 
        }else{
            //console.log("else");
        }
    });

    $(".cerrar").click(function () {
        
    });
    
    // ORDENAMIENTO DE DATOS DE LA TABLA
    $('#tablaConfig').tablesorter(); 
    // LISTA LOS DATOS EN LA TABLA PRINCIPAL
    listarDatos();

    // NUEVOS DATOS
    //$('.editar-datos').on('click', function () { // guardar-datos: REGISTRAR, editar-datos: GUARDAR
    $(document).on('click', '.editar-datos', function () {
        $('#ajaxBusy').fadeIn();
        
        var accion = $(this).data('accion');
        var accionTxt = ((accion == "editar") ? "actualizo" : "registro");
        var pass = "", arrayDatos = [];

        pass = validarCamposVacios("recopilar-datos");
        console.log("validarCamposVacios...pass: "+pass);

        //Verifica que paso las pruebas de lectura y envia en caso contario no envia 
        if (pass) {
            arrayDatos = recopilarDatosFuncion("recopilar-datos",accion);
            console.log(arrayDatos);

            $.ajax({
                data:  arrayDatos,
                url:  "modelo.php",
                type: 'post',
                async: true,
                beforeSend: function () {
                    console.log("Enviando información...");
                },
                success: function (response) {
                    console.log(response);
                    $('#ajaxBusy').fadeOut();

                    if(response > 0){
                        $('.titulo').text($("#valTitle").val()+" "+$("#valActivo").val());
                        $('.editar-datos').data('accion', 'guardar').addClass('guardar-datos').removeClass('editar-datos'); // guardar-datos: REGISTRAR, editar-datos: GUARDAR
                        
                        resetInputs();

                        restablecerOpciones();
                        cambiarVista();
                        listarDatos();
                        novisibleOpciones();
                        mostrarExitoSistema("center", "Bien", 1500, "Se "+accionTxt+" correctamente");// posicion, titulo, tiempo, html
                    }else if(response == 2){
                        mostrarErrorSistema("warning", accionTxt, "Envío de correo fallido", "No fue posible envíar el correo");// tipo, funcion, titulo, msj, input, clase
                    }else{
                        mostrarErrorSistema("error", "No se puede actualizar", "¡Error!", response);// tipo, funcion, titulo, msj, input, clase
                    }
                },
                error: function(xhr, textStatus, errorThrown){
                    mostrarErrorFunciones("Guardar",xhr.status,xhr.responseText,textStatus,errorThrown);
                    console.log("No se puede ejecutar "+accion+" de "+$("#valTitle").val());
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

        if(id > 0){

            $('.titulo').text('Detalle '+$("#valTitle").val());

            $('input:radio[name=itemOpciones]').each(function () {
                $(this).prop("disabled",true);
            });

            $('.guardar-datos').data('accion', 'editar').addClass('editar-datos').removeClass('guardar-datos'); // guardar-datos: REGISTRAR, editar-datos: GUARDAR
            
            resetInputs();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'modelo.php',
                data: ({accion: 'consultar', id: id}),
                beforeSend: function () {
                    $("#ajaxBusy").fadeIn();
                },
                success: function (data) {
    console.log(data);
                    $("#idEdit").val(id);
                    $('.nom_config').html(data[0].nom_config);
                    $('#valor_config').val(data[0].valor_config);

                    if(data[0].tipo_config == 1){
                    }else{
                    }

                    cambiarVista();
                    $("#ajaxBusy").fadeOut(500);
                }
            });
        }else{
            console.error("No tiene ID("+id+") para editar");
        }
    });

    // FILTRAR DATOS LISTADO DE LA TABLA PRINCIPAL
    function listarDatos() {
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
                if($.isEmptyObject(response)){
                    console.log("Obj vacio");
                }else{
                    $.each(response, function (i, item) {
                        html += '<tr>';
                        html += '    <td style="width: 5%;" class="primera-columna"><input id="idopc'+item.id_config+'turn'+contador+'" type="checkbox" name="itemOpciones" data-nombre="'+item.nom_config+'" class="seleccion resetItemOpciones" value="'+item.id_config+'" /><label for="idopc'+item.id_config+'turn'+contador+'" class="fw-normal"><span></span></label></td>';
                        //html += '    <td style="width: 15%;">'+item.idtxt_config+'</td>';
                        html += '    <td style="width: 40%;">'+item.nom_config+'</td>';
                        html += '    <td style="width: 25%;" title="'+item.valor_config+'">'+item.valorcorto_config+'</td>';
                        html += '    <td style="width: 30%;">'+item.fechaact_config+' '+item.horaact_config+'</td>';
                        html += '</tr>';
                        contador++;
                    });
                }

                if (html === ''){
                    html = '<tr><td colspan="4" align="center">No se encontraron registros..</td></tr>';
                }
                $('#tablaConfig tbody').html(html);

                $('#tablaConfig').trigger('update');
                $('#tablaConfig').tablesorterPager({container: $('#pagerConfig')});
            }
        });
    }


    

    
