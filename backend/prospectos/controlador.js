
$("#slcFechai").datepicker({
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  changeYear: true,
  yearRange: "-2:+0",
  onSelect: function (selectedDate) {
    $("#slcFechaf").datepicker("option", "minDate", selectedDate);
    listarDatos();
  }
});/*   Para el rango puede ser yearRange: "-100:+0" ó yearRange: '1950:2013'   */
$("#slcFechaf").datepicker({
  dateFormat: 'yy-mm-dd',
  changeMonth: true,
  changeYear: true,
  yearRange: "-2:+2",
  //maxDate: new Date(),
  onSelect: function () {
    listarDatos();
  }
});/*   Para el rango puede ser yearRange: "-100:+0" ó yearRange: '1950:2013'   */

$("#slcCampanas").change(function () {
  listarDatos();
});

var $table = $('#tablaPros').tablesorter({
  widgets: ["filter"],
  widgetOptions: {
    filter_external: '.searchProspectos',
    filter_defaultFilter: { 1: '~{query}' },
    filter_columnFilters: true,
    filter_placeholder: { search: 'Search...' },
    filter_saveFilters: false,
    filter_reset: '.reset'
  }
});

$('#tablaPros').on('click', 'tr td', function () {
  //console.log("click tr td");
  if (!$(this).hasClass('primera-columna')) {
    //console.log("if");
    $(this).parent().find('.seleccion').trigger('click');
  } else {
    //console.log("else");
  }
});

$(".exportar-datos").click(function () {
  var contador = 0;
  $('#tablaPros tbody tr').each(function () {

    if (!$(this).hasClass('trvacio')) {
      contador++;
      console.log("contador: " + contador);
    }
  });
  if (contador > 0) {
    window.open("exportar-datos-csv.php", '_blank');
  } else {
    mostrarErrorSistema("warning", "Vacío", "Vacío", "No hay registros");// tipo, funcion, titulo, msj, input, clase
  }
});

// ORDENAMIENTO DE DATOS DE LA TABLA
$('#tablaPros').tablesorter();
// LISTA LOS DATOS EN LA TABLA PRINCIPAL
listarDatos();

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

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: 'modelo.php',
      data: ({ accion: 'consultar', id: id }),
      beforeSend: function () {
        $("#ajaxBusy").fadeIn();
      },
      success: function (data) {
        //console.log(data);
        $("#idEdit").val(id);
        $('.nombre').html(data[0].nombre);
        $('.nom_pros').html(data[0].nom_pros);
        $('.correo_pros').html(data[0].correo_pros);
        $('.tel_pros').html(data[0].tel_pros);
        $('.empresa_pros').html(data[0].empresa_pros);
        $('.proyecto_pros').html(data[0].proyecto_pros);
        $('.mensaje_pros').html(data[0].mensaje_pros);
        $('.fechareg_pros').html(data[0].fechareg_pros + " " + data[0].horareg_pros);

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
  $("#ajaxBusy").fadeIn();
  var idland = $("#slcCampanas").val(), fechai = $("#slcFechai").val(), fechaf = $("#slcFechaf").val();

  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'modelo.php',
    data: ({
      accion: 'listar',
      idland: idland,
      fechai: fechai,
      fechaf: fechaf,
    }),
    success: function (response) {
      //console.log(response);
      var html = '', contador = 0;
      if ($.isEmptyObject(response)) {
        console.log("Obj vacio");
      } else {
        $.each(response, function (i, item) {
          html += '<tr>';
          html += '    <td style="width: 5%;" class="primera-columna"><input id="idopc' + item.id_pros + 'turn' + contador + '" type="checkbox" name="itemOpciones" data-nombre="' + item.nom_pros + '" class="seleccion resetItemOpciones" value="' + item.id_pros + '" /><label for="idopc' + item.id_pros + 'turn' + contador + '" class="fw-normal"><span></span></label></td>';
          html += '    <td style="width: 25%;" title="' + item.nom_pros + '">' + item.nomcorto_pros + '</td>';
          html += '    <td style="width: 10%;">' + item.tel_pros + '</td>';
          html += '    <td style="width: 10%;">' + item.correo_pros + '</td>';
          html += '    <td style="width: 30%;" title="' + item.nombre + '">' + item.nomcorto_prod + '</td>';
          html += '    <td style="width: 20%;">' + item.fechareg_pros + ' ' + item.horareg_pros + '</td>';
          html += '</tr>';
          contador++;
        });
      }

      if (html === '') {
        html = '<tr class="trvacio"><td colspan="6" align="center">No se encontraron registros..</td></tr>';
      }
      $('#tablaPros tbody').html(html);

      $('#tablaPros').trigger('update');
      $('#tablaPros').tablesorterPager({ container: $('#pagerPros') });

      $("#ajaxBusy").fadeOut(500);
    }
  });
}





