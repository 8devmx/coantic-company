function validateEmail (valor) {
  let resp = 0
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) {
    resp = 1
  } else {
    resp = 0
  }
  return resp
}

$(".telefono").on('blur', function () {
  const valor = $(this).val()
  const longitud = valor.length
  $("#frm_button").css({ display: "block" })
  $(this).removeClass("error")

  if (valor == "" || longitud !== 10) {
    $("#frm_button").css({ display: "none" })
    $(this).addClass("error")
    return false
  }

})


$(`.formulario-informacion-contact input, .formulario-informacion-contact textarea`).keyup(function () {
  if ($(this).val() !== "") {
    $(this).removeClass("error")
    return false
  }
})
$(".correo").on("blur", function () {
  let valor = $(this).val()
  if (valor !== "") {
    let respuesta = validateEmail(valor)
    $("#frm_button").css('display', 'block')
    $("#frm_button").removeClass('error')
    if (!respuesta) {
      $("#frm_button").css('display', 'none')
      $("#frm_button").addClass('error')
      return false
    }
  }
})

$("#frm_button").click(function () {
  $("#ajaxBusy").fadeIn()
  const source = $(this).data("source"),
    funcion = "contact"

  let pass = 1
  const obj = {
    accion: funcion
  }

  $(`.formulario-informacion-${source} input, .formulario-informacion-${source} textarea, .formulario-informacion-${source} select`).each(function () {
    let id = $(this).attr("id"),
      name = $(this).attr("name"),
      valor = $(this).val()

    valor = $(this).val()

    if (valor !== "") {
      obj[name] = valor
    }

    $(this).removeClass("error")

    if ((valor === "" && !$(this).hasClass("norequired")) || valor == undefined) {
      $(this).addClass("error")
      pass = 0
      return false
    }
  })

  if (pass != 0) {
    const data = {
      name: obj.nombre + " " + obj.apellido,
      company: obj.empresa,
      phone: obj.telefono,
      email: obj.email,
      subject: "Interés: " + obj.interes,
      message: obj.mensaje
    }
    fetch("https://formspree.io/f/mgejbyan", {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        'Accept': 'application/json'
      }
    }).then(response => {
      if (response.ok) {
        gtag_report_conversion($url + "gracias")
      } else {
        $("#ajaxBusy").fadeOut(300)
      }
    }).catch(error => {
      $("#ajaxBusy").fadeOut(300)
    })
  } else {
    $("#ajaxBusy").fadeOut(300)
  }
})

$("body").append(
  '<div id="ajaxBusy"><div class="ui-widget-overlay"></div><img src="' +
  $url +
  'img/load.gif">      </div>'
)

$("#ajaxBusy").css({
  display: "none",
  position: "fixed",
  top: "0px",
  left: "0px",
  height: $(window).height(),
  width: "100%",
  backgroundColor: "#fff",
  textAlign: "center",
  zIndex: "999",
})

$("#ajaxBusy img").css({
  paddingTop: "17%",
})