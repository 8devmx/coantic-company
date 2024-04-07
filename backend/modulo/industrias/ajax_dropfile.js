$(function () {

    $('#dropu a').click(function () {
        $(this).parent().find('input').click();
    });
    // Initialize the jQuery File Upload plugin
    $('#formulario').fileupload({
        // This element will accept file drag/drop uploading
        dropZone: $('#dropu'),
        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            console.log(data);
            // Automatically upload the file once it is added to the queue
            var sizeByte = data.files[0].size;
            var tipoArchivo = data.files[0].type;
            console.warn("size: " + convertSize(sizeByte) + ", type: " + tipoArchivo);

            if (tipoArchivo == "image/png" || tipoArchivo == "image/jpeg") {
                console.log(1048576 * 1);
                if (sizeByte > (1048576 * 2)) {// 1MB
                    mostrarErrorSistema("error", "Dropu archivo", "¡Error!", "El tamaño supera el limite permitido 2MB");// tipo, funcion, titulo, msj
                    $(this).val('');
                    return false;
                } else {
                    var jqXHR = data.submit();
                }

            } else {
                mostrarErrorSistema("error", "Dropu archivo", "¡Error!", "no es un archivo valido " + tipoArchivo);// tipo, funcion, titulo, msj
                $(this).val('');
                return false;
            }
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    //Do something with upload progress here
                    var nuevo = percentComplete * 100;
                    var porcentaje = parseFloat(nuevo).toFixed(0);
                    $(".porcentaje").css({ "display": "inline-block" });
                    $(".porcentaje").html("<b>" + porcentaje + " %</b>");
                }
            }, false);
            return xhr;
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

            for (var val in datos) {
                console.log("nom_imagen: " + datos[val].nom_imagen + ", url_imagen: " + datos[val].url_imagen);
                if (datos[val].respuesta == 1) {//Correctamente
                    $("#respuestafoto1").css({ "z-index": 3 });
                    asignarNombreFoto(datos[val].nom_imagen);
                    $("#respuestafoto1").html("<a title='Eliminar imagen' class='eliminarImagen' data-inp='foto1' data-img='1'>\
                                            <i class='fa fa-remove' aria-hidden='true'></i>\
                                        </a><a class='linkimg' href='"+ datos[val].url_imagen + "' target='_blank'>\
                                            <img src='"+ datos[val].url_imagen + "' class='foto-foto'>\
                                        </a>");

                    // A UN LINK EN ESPECIFICO
                    $(".linkimg").magnificPopup({
                        type: 'image',
                        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
                        gallery: {
                            enabled: true // read about this option in next Lazy-loading section
                        }
                    });

                } else if (datos[val].respuesta == 2) {//Invalido
                    console.error("ERROR Archivo invalido: " + datos[val].nom_imagen);
                    mensajeDeCarga("ERROR ARCHIVO NO VALIDO " + datos[val].nom_imagen);

                } else if (datos[val].respuesta == 0) {//Permisos o sin espacio
                    console.error("ERROR NO SE PUEDE CARGAR: " + datos[val].error);
                    mensajeDeCarga("ERROR NO SE PUEDE CARGAR " + datos[val].error);
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
    $(document).on('#dropu dragover', function (e) {
        e.preventDefault();
    });


});// END $(function () {
function asignarNombreFoto (nom_imagen) {
    console.log("asignarNombreFoto...nom: " + nom_imagen);
    $('#foto1').val(nom_imagen);
}
function mensajeDeCarga (mensaje) {
    $("#errorCarga").html(mensaje);
    $("#lblDefault").fadeOut(300).delay(4000).fadeIn(300);
    $("#errorCarga").fadeIn(300).delay(4000).fadeOut(300);
}
function convertSize (size) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (size == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(size) / Math.log(1024)));
    return Math.round(size / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

