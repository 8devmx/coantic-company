
$("#gale").sortable({
  placeholder: "ui-state-highlight",
  cursor: 'move'
});

$("#gale").disableSelection();

$(document).on('change', 'input:checkbox[name=visibilidad-pro]', function (e) {
  $('#ajaxBusy').fadeIn();
  let id = $(this).data("id"), valor = $(this).data("valor");

  let obj = {
    'accion': 'eventoActivo',
    'id': id,
    'valor': valor,
  };
  //console.log(obj);
  $.post('modelo.php', obj, function (data) {
    $('#ajaxBusy').fadeOut(500);
    if (data == 1) {
      listarDatos();
    } else {
      console.error("No se puede actualizar ");
    }

  });
});

let $table = $('#tablaProductos').tablesorter({
  widgets: ["filter"],
  widgetOptions: {
    filter_external: '.searchProductos',
    filter_defaultFilter: { 1: '~{query}' },
    filter_columnFilters: true,
    filter_placeholder: { search: 'Search...' },
    filter_saveFilters: false,
    filter_reset: '.reset'
  }
});

// ELIMINAR IMAGEN
$("#gale").on("click", ".eliminar", function (event) {
  event.preventDefault();
  console.log("Eliminar galeria");
  let elim = $("#imagen-eliminar").val();
  elim = elim + "**" + $(this).attr("rel");

  let cont = $(this).parent().parent().parent();

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

$(".btn-duplicar-producto").click(function () {
  let pass = "", arrayDatos = [];

  pass = validarCamposVacios("formulario-informacion-modal-duplicar-producto");
  console.log("validarCamposVacios...pass: " + pass);

  arrayDatos = recopilarDatosFuncion("formulario-informacion-modal-duplicar-producto", "duplicar");
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
          $("#formulario-duplicar-producto").modal("hide");
          mostrarExitoSistema("center", "Bien", 1500, "Se duplicó correctamente");// posicion, titulo, tiempo, html

        } else if (response == "existe") {
          mostrarErrorSistema("warning", "Duplicó", "Duplicado", "El titulo ya existe");// tipo, funcion, titulo, msj, input, clase
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

  let arrayDatos = consultarIdIndividual();
  let id = arrayDatos["id"];
  let titulo = arrayDatos["titulo"];

  $("#idhid").val(id);
  $("#titulo-duplicar").val(titulo);

});

$(".cerrar-duplicar-producto").click(function () {
  $("#formulario-duplicar-producto").modal("hide");
  $(".eleOpc").attr("data-producto", "");
  $('.formulario-informacion-modal-duplicar-producto input, .formulario-informacion-modal-duplicar-producto select, .formulario-informacion-modal-duplicar-producto textarea').each(function () {
    $(this).val("");
    $(this).removeClass("error");
  });

  $("body").removeClass("no-scroll");
  $("body").removeClass("modal-open");
});

$('#tablaProductos').on('click', 'tr td', function () {
  if (!$(this).hasClass('primera-columna') && !$(this).hasClass('no_select')) {
    console.log("if");
    $(this).parent().find('.seleccion').trigger('click');
  }
});

$(".cerrar").click(function () {
  tinyMCE.get('aplicaciones').setContent('');
  tinyMCE.get('beneficios').setContent('');
  $("#downloadsLists, #benefitsLists").html("")
});

// ORDENAMIENTO DE DATOS DE LA TABLA
$('#tablaProductos').tablesorter();
// LISTA LOS DATOS EN LA TABLA PRINCIPAL
listarDatos();

// NUEVOS DATOS
$('.guardar-datos, .editar-datos').on('click', function () { // guardar-datos: REGISTRAR, editar-datos: GUARDAR
  $('#ajaxBusy').fadeIn();

  let accion = $(this).data('accion');
  let accionTxt = ((accion == "editar") ? "actualizo" : "registro");
  let pass = "", arrayDatos = [];

  const textareas = ['aplicaciones', 'beneficios']
  for (let index = 0; index < textareas.length; index++) {
    const field = textareas[index];
    let fieldData = tinyMCE.get(field).getContent();
    $(`#${field}`).val(fieldData);
  }

  pass = validarCamposVacios("recopilar-datos");
  console.log("validarCamposVacios...pass: " + pass);

  console.log(arrayDatos);

  //Verifica que paso las pruebas de lectura y envia en caso contario no envia 
  if (pass) {

    let cadenaFotos = "", contadorGal = 0;
    $("#gale li a").each(function () {

      if ($(this).attr("rel") != undefined) {
        cadenaFotos = cadenaFotos + "**" + $(this).attr("rel");
        console.log("rel: " + $(this).attr("rel"));
        console.log("cadenaFotos: " + cadenaFotos);
        contadorGal++;
      }

    });

    arrayDatos = recopilarDatosFuncion("recopilar-datos", accion);
    arrayDatos['galeria_prod'] = cadenaFotos;
    let downloads = [], benefits = []

    if ($("#downloadsLists li").length > 0) {
      $("#downloadsLists li").map(function (index, file) {
        const download = {
          title: $(this).data('title'),
          url: $(this).data('url'),
          name: $(this).data('name')
        }
        downloads.push(download)
      })
    }
    if ($("#benefitsLists li").length > 0) {
      $("#benefitsLists li").map(function (index, file) {
        const benefit = $(this).data('element')
        benefits.push(benefit)
      })
    }
    arrayDatos['downloads'] = JSON.stringify(downloads)
    arrayDatos['benefits'] = JSON.stringify(benefits)
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
          console.log("cadena_bullets");
          tinyMCE.get('aplicaciones').setContent('');
          tinyMCE.get('beneficios').setContent('');
          $("#downloadsLists, #benefitsLists").html("")

          restablecerOpciones();
          cambiarVista();
          listarDatos();
          novisibleOpciones();
          mostrarExitoSistema("center", "Bien", 1500, "Se " + accionTxt + " correctamente");// posicion, titulo, tiempo, html
        } else if (response == "existe") {
          mostrarErrorSistema("warning", accionTxt, "Duplicado", "El titulo ya existe");// tipo, funcion, titulo, msj, input, clase
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

  let arrayDatos = consultarIdIndividual();
  let id = arrayDatos["id"];

  if (id > 0) {

    $('.titulo').text('Detalle ' + $("#valTitle").val());

    $('input:radio[name=itemOpciones]').each(function () {
      $(this).prop("disabled", true);
    });

    $('.guardar-datos').data('accion', 'editar').addClass('editar-datos').removeClass('guardar-datos'); // guardar-datos: REGISTRAR, editar-datos: GUARDAR

    resetInputs();
    tinyMCE.get('aplicaciones').setContent('');
    tinyMCE.get('beneficios').setContent('');

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

        $('#titulo').val(data[0].titulo);
        $('#subtitulo').val(data[0].subtitulo);


        if (data[0].aplicaciones !== "" && data[0].aplicaciones !== null) {
          tinyMCE.get('aplicaciones').setContent(data[0].aplicaciones);
        }

        if (data[0].beneficios !== "" && data[0].beneficios !== null) {
          tinyMCE.get('beneficios').setContent(data[0].beneficios);
        }

        $("#respuestafoto1").css({ "z-index": 3 });
        $("#foto1").val(data[0].aplicaciones_imagen);
        $("#respuestafoto1").html(`
          <a title='Eliminar imagen' class='eliminarImagen' data-inp='foto1' data-img='1'>
            <i class='fa fa-remove' aria-hidden='true'></i>
          </a>
          <a class='linkimg' href='${data[0].aplicaciones_imagen_url}' target='_blank'>
            <img src='${data[0].aplicaciones_imagen_url}' class='foto-foto'>
          </a>`);
        $(".linkimg").magnificPopup({
          type: 'image',
          mainClass: 'mfp-with-zoom', // this class is for CSS animation below
          gallery: {
            enabled: true // read about this option in next Lazy-loading section
          }
        });

        if (data[0].descargas !== "") {
          const downloads = JSON.parse(data[0].descargas)
          let template = ``
          downloads.forEach((download) => {
            template += `
              <li data-title="${download.title}" data-url="${download.url}" data-name="${download.name}">
              <a href="${download.url}" target="_BLANK">${download.title} | ${download.name} </a>
              <span class="btnDelete">Eliminar</span>
              </li>
            `
          })
          $("#downloadsLists").html(template)
        }
        if (data[0].beneficios_elementos !== "") {
          const benefits = JSON.parse(data[0].beneficios_elementos)
          let template = ``
          benefits.forEach((benefit) => {
            template += `
              <li data-element='${JSON.stringify(benefit)}'>
              <strong>
              <img src='${$urlsitio + "img/" + benefit.icono}' class='icon_preview' />
              <span>${benefit.titulo}</span>
              </strong>
              <span class="btnDelete">Eliminar</span>
              </li>
            `
          })
          $("#benefitsLists").html(template)
        }


        $("#gale").html("");
        if (data[0].galeria !== "") {
          let galeria_prod = data[0].galeria;
          let fotos = galeria_prod.split('**');

          if ($.isEmptyObject(fotos)) {
            console.log("Fotos vacias");
          } else {
            for (let i = 0; i < fotos.length; i++) {
              if (fotos[i] !== "") {
                $('#gale').append(`
                  <li id="imagen-${data[0].id}" class="ui-sortable-handle">
                    <a href="../../../uploads/industrias/thumb/${fotos[i]}" class="galeria">
                      <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                      <div class="view view-first">
                        <img src="../../../uploads/industrias/thumb/${fotos[i]}" alt="imagenes">
                        <div class="mask">
                          <a href="#" class="eliminar" rel="${fotos[i]}" title="imagenes">Eliminar</a>
                        </div>
                      </div>
                    </a>
                  </li>`);
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

  let arrayDatos = consultarIdIndividual();
  let id = arrayDatos["id"];
  let titulo = arrayDatos["nombre"];
  console.log(arrayDatos)
  if (id > 0) {
    console.log("eliminar-elemento...id: " + id);
    $('#txtEliminar').html(titulo);
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
        let obj = {
          'accion': 'eventoActivo',
          'id': $('#eliminar').val(),
          'valor': 0,
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
      let html = '', contador = 0;
      if ($.isEmptyObject(response)) {
        console.log("Obj vacio");
      } else {
        $.each(response, function (i, item) {
          html += '<tr>';
          html += '   <td style="width: 5%;" class="primera-columna"><input id="idopc' + item.id + 'turn' + contador + '" type="checkbox" name="itemOpciones" data-nombre="' + item.titulo + '" class="seleccion resetItemOpciones" value="' + item.id + '" /><label for="idopc' + item.id + 'turn' + contador + '" class="fw-normal"><span></span></label></td>';
          html += '   <td style="width: 55%;"><a href="' + $urlsitio + 'industrias/' + item.url + '" target="_blank">' + item.titulo + '</a></td>';
          html += '   <td style="width: 30%;">' + item.fechaact + ' ' + item.horaact + '</td>';
          html += '   <td style="width: 10%;" class="no_select">\
                                        <div class="switch">\
                                            <span class="falso">No</span>';
          if (item.activo == 1) {
            seleccionado = "checked";
            valorSeleccionado = 2;
          } else {
            seleccionado = "";
            valorSeleccionado = 1;
          }
          html += '   <input type="checkbox" name="visibilidad-pro" id="visibilidad-pro' + item.id + '" data-id="' + item.id + '" data-valor="' + valorSeleccionado + '" ' + seleccionado + '>';
          html += '   <span for="visibilidad-pro' + item.id + '" class="slider-radio round"></span>\
                                            <span class="verdad">Si</span>\
                                        </div>\
                                    </td>';
          html += '</tr>';
          contador++;
        });
      }

      if (html === '') {
        html = '<tr><td colspan="4" align="center">No se encontraron registros..</td></tr>';
      }
      $('#tablaProductos tbody').html(html);

      $('#tablaProductos').trigger('update');
      $('#tablaProductos').tablesorterPager({ container: $('#pagerProductos') });
    }
  });
}





$("#formDownload").on("change", function (e) {
  console.log("hola")
  e.preventDefault()
  $.ajax({
    url: "cmd_downloads.php",
    type: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      $("#btnDownloads").fadeOut();
    },
    success: function (data) {
      $("#btnDownloads").fadeIn()
      const response = JSON.parse(data)
      if (response[0].nom_imagen != undefined) {
        $("#btnDownloads").data('nombre', response[0].nom_imagen).data('url', response[0].url_imagen);
      }
    },
    error: function (e) {
      $("#btnDownloads").text(e).fadeIn();
    }
  });

})

$("#btnDownloads").on("click", function (e) {
  e.preventDefault()
  if ($("#downloads_title").val() == "") {
    alert("Debes ingresar un título...")
    $("#downloads_title").focus()
    return false
  }
  if (typeof $("#btnDownloads").data("nombre") == "undefined") {
    alert("Debes cargar un documento...")
    return false
  }

  const titulo = $("#downloads_title").val()
  const nombre = $("#btnDownloads").data("nombre")
  const url = $("#btnDownloads").data("url")
  const template = `
    <li data-title='${titulo}' data-url='${url}' data-name='${nombre}'>
    <a href='${url}' target='_BLANK'>${titulo} | ${nombre} </a>
    <span class='btnDelete'>Eliminar</span>
    </li>
  `
  $("#downloadsLists").append(template)
  $("#downloads_title").val("")
  $("#formDownload")[0].reset()
})

$("#btnBenefits").on("click", function (e) {
  e.preventDefault()
  if ($("#benefits_title").val() == "" || $("#benefits_icon").val() == "") {
    alert("Debes completar los campos...")
    $("#benefits_icon").focus()
    return false
  }

  const benefitsElement = {
    "titulo": $("#benefits_title").val(),
    "icono": $("#benefits_icon").val(),
    "descripcion": $("#benefits_description").val()
  }

  const template = `
    <li data-element='${JSON.stringify(benefitsElement)}'>
    <strong>
    <img src='${$urlsitio + "img/" + benefitsElement.icono}' class='icon_preview' />
    <span>${benefitsElement.titulo}</span>
    </strong>
    <span class="btnDelete">Eliminar</span>
    </li>
  `
  $("#benefitsLists").append(template)
  $("#benefits_title").val("")
  $("#benefits_icon").val("")
  $("#benefits_description").val("")
})
$("#benefits_icon").on("change", function () {
  $("#benefits_title").val("")
  if ($(this).val() !== "") {
    $("#benefits_title").val($("#benefits_icon option:selected").text())
  }
})
$(document).on("click", ".btnDelete", function (e) {
  e.preventDefault()
  $(this).parent().remove()
})