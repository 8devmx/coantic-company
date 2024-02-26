/*new Vue({
  el: "#app",
  data: {
    items: [],
    componentView: 1,
  },
  mounted: function () {
    this.listar()
  },
  methods: {
    listar: function () {
      let form = new FormData()
      form.append("accion", "listar")
      fetch("modelo.php", {
        method: "POST",
        body: form,
      })
        .then((response) => response.json())
        .then((response) => {
          console.log(response)
          this.items = response
        })
    },
  },
})*/
var $table = $("#tablaUsuarios").tablesorter({
  widgets: ["filter"],
  widgetOptions: {
    filter_external: ".searchUsuarios",
    filter_defaultFilter: { 1: "~{query}" },
    filter_columnFilters: true,
    filter_placeholder: { search: "Search..." },
    filter_saveFilters: false,
    filter_reset: ".reset",
  },
})

// ORDENAMIENTO DE DATOS DE LA TABLA
$("#tablaUsuarios").tablesorter()
// LISTA LOS DATOS EN LA TABLA PRINCIPAL
listarDatos()

$("#tablaUsuarios").on("click", "tr td", function () {
  //console.log("click tr td");
  if (!$(this).hasClass("primera-columna")) {
    //console.log("if");
    $(this).parent().find(".seleccion").trigger("click")
  } else {
    //console.log("else");
  }
})

// NUEVOS DATOS
$(".guardar-datos, .editar-datos").on("click", function () {
  // guardar-datos: REGISTRAR, editar-datos: GUARDAR
  $("#ajaxBusy").fadeIn()

  var accion = $(this).data("accion")
  var accionTxt = accion == "editar" ? "actualizo" : "registro"
  var pass = "",
    pasar = 1,
    arrayDatos = []

  pass = validarCamposVacios("recopilar-datos")
  console.log("validarCamposVacios...pass: " + pass)

  //Verifica que paso las pruebas de lectura y envia en caso contario no envia
  if (pass) {
    // Lee los modulos que podra administrar
    var modulos = "dashboard"
    var fields = $("input[name=modulo]").serializeArray()
    //console.error(fields)

    if (fields.length == 0) {
      pasar = 0
    } else if ($("#todos-cb").is(":checked")) {
      modulos = $("#todos-cb").val()
      console.warn("else if... todos-cb: " + modulos)
    } else {
      $("input[name=modulo]:checked").each(function () {
        modulos += "**" + $(this).val()
      })
      console.warn("else... input[name=modulo]:checked: " + modulos)
    }

    if (pasar) {
      // Lee los permisos que tendra
      var permisos
      $("input[name=permiso]:checked").each(function () {
        permisos = $(this).val()
      })

      arrayDatos = recopilarDatosFuncion("recopilar-datos", accion)
      // Guarda los modulos que podra administrar
      arrayDatos["modulos"] = modulos
      // Guarda los permisos que tendra
      arrayDatos["permisos"] = permisos

      console.log(arrayDatos["permisos"])

      $.ajax({
        data: arrayDatos,
        url: "modelo.php",
        type: "post",
        async: true,
        beforeSend: function () {
          console.log("Enviando información...")
        },
        success: function (response) {
          console.log(response)
          $("#ajaxBusy").fadeOut()

          if (response > 0) {
            $(".titulo").text($("#valTitle").val() + " " + $("#valActivo").val())
            $(".editar-datos")
              .data("accion", "guardar")
              .addClass("guardar-datos")
              .removeClass("editar-datos") // guardar-datos: REGISTRAR, editar-datos: GUARDAR

            resetInputs()

            restablecerOpciones()
            cambiarVista()
            listarDatos()
            novisibleOpciones()
            mostrarExitoSistema("center", "Bien", 1500, "Se " + accionTxt + " correctamente") // posicion, titulo, tiempo, html
          } else if (response == "existe") {
            mostrarErrorSistema("warning", accionTxt, "Duplicado", "El usuario ya existe") // tipo, funcion, titulo, msj, input, clase
          } else {
            mostrarErrorSistema("error", "No se puede actualizar", "¡Error!", response) // tipo, funcion, titulo, msj, input, clase
          }
        },
        error: function (xhr, textStatus, errorThrown) {
          mostrarErrorFunciones(
            "Registrar o Guardar",
            xhr.status,
            xhr.responseText,
            textStatus,
            errorThrown
          )
          console.log("No se puede ejecutar " + accion + " de " + $("#valTitle").val())
        },
      })
    } else {
      // if(pasar)
      mostrarErrorSistema("warning", accion, "Campo Vacío", "Seleccione uno o más módulos") // tipo, funcion, titulo, msj, input, clase
      console.error("No tiene modulos")
    }
  } else {
    $("#ajaxBusy").fadeOut(500)
  }
})

// CARGAR PARA EDICION DE DATOS
//$('.datos').on('click', '.editar', function () {
$(document).on("click", ".editar-elemento", function () {
  var arrayDatos = consultarIdIndividual()
  var id = arrayDatos["id"]

  if (id > 0) {
    $(".titulo").text("Detalle " + $("#valTitle").val())

    $("input:radio[name=itemOpciones]").each(function () {
      $(this).prop("disabled", true)
    })

    $(".guardar-datos")
      .data("accion", "editar")
      .addClass("editar-datos")
      .removeClass("guardar-datos")
    resetInputs()

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "modelo.php",
      data: { accion: "consultar", id: id },
      beforeSend: function () {
        $("#ajaxBusy").fadeIn()
      },
      success: function (data) {
        //console.log(data);

        $("#nombre").val(data[0].nombre)
        $("#usuario").val(data[0].usuario)
        $("#clave").val(data[0].clave)
        $("#correo").val(data[0].correo)
        $("#permisos").val(data[0].permisos)
        if (data[0].permisos === "1") {
          $(".modulos").prop("checked", true)
        } else {
        }

        $("input[name=permiso]").each(function () {
          if ($(this).val() === data[0].permisos) {
            $(this).prop("checked", true)
          } else {
            $(this).prop("checked", false)
          }
        })

        var modulos = data[0].modulos

        // OPCIONES POR NIVEL DE USUARIO
        $(".modulos").on("click", "#todos-cb", function () {
          if ($(this).is(":checked")) {
            $(".modulo").addClass("disabled")
            $(".modulos-ind input[type=checkbox]").prop("checked", false).prop("disabled", true)
          } else {
            $(".modulos-ind input[type=checkbox]").prop("checked", false).prop("disabled", false)
            $(".modulo").removeClass("disabled").prop("disabled", false)
          }
        })

        if (modulos === "todos") {
          $("#todos-cb").prop("checked", true)
          $(".modulo").addClass("disabled")
          $(".modulos-ind input[type=checkbox]").prop("checked", false).prop("disabled", true)
        } else {
          var arr = modulos.split("**")
          $.each(arr, function (i, val) {
            $("input[name=modulo]").each(function () {
              if ($(this).val() === val) {
                $(this).prop("checked", true)
              }
            })
          })
        }

        cambiarVista()
        $("#ajaxBusy").fadeOut(500)
      },
    })
  } else {
    console.error("No tiene ID(" + id + ") para editar")
  }
})
// ELIMINAR DATOS
$(document).on("click", ".eliminar-elemento", function (event) {
  event.preventDefault()

  var arrayDatos = consultarIdIndividual()
  var id = arrayDatos["id"]
  var nombre = arrayDatos["nombre"]

  if (id > 0) {
    console.log("eliminar-elemento...id: " + id)
    $("#txtEliminar").html(nombre)
    $("#eliminar").val(id)
    $("#alerta-eliminar").dialog("open")
  } else {
    console.error("No tiene ID(" + id + ") para eliminar")
  }
})

$("#alerta-eliminar").dialog({
  title: "Confirmar eliminación",
  autoOpen: false,
  draggable: false,
  modal: true,
  width: 280,
  height: "auto",
  resizable: false,
  open: function (event, ui) {
    $("body").css({ overflow: "hidden" })
  },
  close: function (event, ui) {
    $("body").css({ overflow: "auto" })
  },
  show: {
    effect: "fade",
    duration: 300,
  },
  hide: {
    effect: "fade",
    duration: 300,
  },
  buttons: [
    {
      text: "Cancelar",
      class: "dialog-btn-cancelar",
      click: function () {
        $(this).dialog("close")
      },
    },
    {
      text: "Confirmar",
      class: "dialog-btn-confirmar",
      click: function () {
        console.log("id_eliminar: " + $("#eliminar").val())
        var obj = {
          accion: "eliminar",
          id_usr: $("#eliminar").val(),
        }

        $.post("modelo.php", obj, function (data) {
          if (data == 1) {
            $("#alerta-eliminar").dialog("close")
            restablecerOpciones()
            listarDatos()
            novisibleOpciones()
            $("#ajaxBusy").fadeOut(500)
          } else {
            console.error("No se puede eliminar " + $("#valTitle").val())
          }
        })
      },
    },
  ],
})

$("#alerta2, #alerta3").dialog({ autoOpen: false })

// ACTIVAR / INACTIVAR
$(".datos").on("click", ".inactivar, .activar", function () {
  var id = $(this).attr("rel")
  var status = $(this).data("status")
  var obj = {
    accion: "status",
    id: id,
    activo: status,
  }

  $.post("modelo.php", obj, function (data) {
    listarDatos()
  })
})

// FILTRAR DATOS LISTADO DE LA TABLA PRINCIPAL
function listarDatos() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "modelo.php",
    data: {
      accion: "listar",
    },
    success: function (data) {
      var html = ""
      if (data.length > 0) {
        var z = "0"
        $.each(data, function (i, item) {
          html += "<tr>"
          html +=
            '    <td style="width: 5%;" class="primera-columna"><input id="idchk' +
            item.id +
            "turn" +
            z +
            '" type="checkbox" name="itemOpciones" data-nombre="' +
            item.nombre +
            '" class="seleccion resetItemOpciones" value="' +
            item.id +
            '" /><label for="idchk' +
            item.id +
            "turn" +
            z +
            '" class="fw-normal"><span></span></label></td>'
          html += "    <td>" + item.nombre + "</td>"
          html += "    <td>" + item.usuario + "</td>"
          html += "    <td>" + item.tipo + "</td>"
          html += "    <td>" + item.permisos + "</td>"
          html += "</tr>"
          z++
        })
      }

      if (html === "")
        html = '<tr><td colspan="5" align="center">No se encontraron registros..</td></tr>'
      $("#tablaUsuarios tbody").html(html)

      $("#tablaUsuarios").trigger("update")
      $("#tablaUsuarios").tablesorterPager({ container: $("#pagerUsuarios") })
    },
  })
}

// OPCIONES POR NIVEL DE USUARIO
$(".modulos").on("click", "#todos-cb", function () {
  if ($(this).is(":checked")) {
    $(".modulo").addClass("disabled")
    $(".modulos-ind input[type=checkbox]").prop("checked", false).prop("disabled", true)
  } else {
    $(".modulos-ind input[type=checkbox]").prop("checked", false).prop("disabled", false)
    $(".modulo").removeClass("disabled").prop("disabled", false)
  }
})
