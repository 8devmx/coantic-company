$(function(){
    // Dependiendo si es una imagen o un archivo que se haya subido para especificar el link con imagen o archivo.
    var tipo = $('#tipo').val();
    // Es el tamaño total de las fotos para agregarles el identificador para eliminar
    var tam = $('#tamano').val();
    // El url donde se jalaran los thumbs se tienen que especificar en el modulo 
    var ruta = $('#ruta_imagen').val();
    // Agrega las fotos en la reticula
    var ul = $('#upload .gale');
    // Envia a la lista de cola para subir archivos
    var lista = $('#upload .lista');
    
    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            var tpl = $('<li class="working"><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i><img src="'+$url+'img/loading.GIF" />');

            // Se agrega a la lista de archivos en espera de subida
            data.context = tpl.appendTo(lista);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){
            
            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);
            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();
            if(progress == 100){
                data.context.removeClass('working');
            }
        },
        
        done: function(e, data){
            //console.log(data); // Obtiene el echo del archivo upload.php
            if(data.result != "novalido"){
                // Esto realiza todo el proceso de la impresion de thumbs o la foto de archivo.
                data.context.remove();
                
                var nombre = 'thumb/'+data.result;
                var tpl = $('<li id="imagen-'+tam+'" class="ui-sortable-handle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><div class="view view-first"></div></li>');
                
                // Append the file name and file size  // ALT= "data.files[0].name" CONTEMPLAR
                tpl.find('div').append('<img src="'+ruta+nombre+'" alt="'+tipo+'" />').append('<div class="mask"><a href="#" class="eliminar" rel="'+data.result+'" title="'+tipo+'">Eliminar</a></div>');
                // Add the HTML to the UL element
                tpl.appendTo(ul);
                $('#tamano').val(parseInt(tam)+1);
            }else{
                console.warn("Formato no valido");
                data.context.remove();
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});