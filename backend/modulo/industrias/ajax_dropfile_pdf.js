$(function () {

    $('#dropu_pdf a').click(function () {
        $(this).parent().find('input').click();
    });
    // Initialize the jQuery File Upload plugin
    $('#formulario_pdf').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#dropu_pdf'),
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },
        progress: function (e, data) {
            $('#ajaxBusy').fadeIn(500);
        },
        formData: function (form) {
            return form.serializeArray();
        },
        done: function (e, data) {
            e.preventDefault();
            $('#ajaxBusy').fadeOut(500);
            /* - - - - - CONVIERTO EL STRING A UN OBJETO JSON - - - - - */
            var datos = $.parseJSON(data.result);
            console.log(datos);
            for (var val in datos) {
                console.log("nom_imagen: " + datos[val].nom_imagen + ", url_imagen: " + datos[val].url_imagen);
                if (datos[val].respuesta == 1) {//Correctamente
                    $("#respuestapdf").css({ "z-index": 3 });
                    asignarNombreFoto2(datos[val].nom_imagen);
                    $("#respuestapdf").html("<a title='Eliminar imagen' class='eliminarImagen' data-inp='foto1' data-img='1'>\
                                            <i class='fa fa-remove' aria-hidden='true'></i>\
                                        </a><a class='linkimg' href='"+ datos[val].url_imagen + "' target='_blank'>\
                                            <img src='"+ datos[val].url_imagen + "' class='foto-foto'>\
                                        </a>");// "+datos[val].url_imagen+"

                } else if (datos[val].respuesta == 2) {//Invalido
                    console.error("ERROR Archivo invalido: " + datos[val].nom_imagen);
                    mensajeDeCarga2("ERROR ARCHIVO NO VALIDO " + datos[val].nom_imagen);

                } else if (datos[val].respuesta == 0) {//Permisos o sin espacio
                    console.error("ERROR NO SE PUEDE CARGAR: " + datos[val].error);
                    mensajeDeCarga2("ERROR NO SE PUEDE CARGAR " + datos[val].error);
                }
            }
        },
        fail: function (e, data) {
            console.error("fail: " + data.context);
        }
    }).bind('fileuploadfail', function (e, data) {
        console.error(e.type + ' - Error en subida de archivos: ' + data);
    });
    // Prevent the default action when a file is dropped on the window
    $(document).on('#dropu_pdf dragover', function (e) {
        e.preventDefault();
    });


});// END $(function () {
function asignarNombreFoto2 (nom_imagen) {
    console.log("asignarNombreFoto2...nom: " + nom_imagen);
    $('#nombrepdf').val(nom_imagen);
}
function mensajeDeCarga2 (mensaje) {
    $("#errorCarga2").html(mensaje);
    $("#lblDefault2").fadeOut(300).delay(4000).fadeIn(300);
    $("#errorCarga2").fadeIn(300).delay(4000).fadeOut(300);
}