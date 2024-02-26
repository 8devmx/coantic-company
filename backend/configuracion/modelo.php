<?php
include("../includes/_funciones.php");
page_protect();
if ($_POST) {
    switch ($_POST['accion']) {
        case 'listar':
            listar();
            break;
        case 'consultar':
            consultar();
            break;
        case 'editar':
            editar();
            break;
    }
}

function listar()
{
    global $db;

    $sql = "SELECT * FROM tbl_configuracion WHERE activo_config = 1 ORDER BY id_config ASC ";
    $res = $db->query($sql)->fetchAll();

    $datos = array();

    foreach ($res as $rows) {

        $datos[] = array(
            'nom_config' => $rows['nom_config'],
            'valor_config' => $rows['valor_config'],
            'valorcorto_config' => custom_echo($rows['valor_config'], 30),
            'fechaact_config' => obtenerDiaSemana($rows['fechaact_config']),
            'horaact_config' => obtenerHoraFecha($rows['fechaact_config']),
            'id_config' => $rows['id_config'],
            'idtxt_config' => "C" . $idfolio
        );
    }

    echo json_encode($datos);
}

function consultar()
{
    global $db;

    $sql = "SELECT * FROM tbl_configuracion WHERE id_config = " . $_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();

    $datos[] = array(

        'nom_config' => $res[0]['nom_config'],
        'valor_config' => $res[0]['valor_config'],
        'tipo_config' => $res[0]['tipo_config'],
        'id_config' => $res[0]['id_config']
    );

    $_SESSION["nomses_config"] = $res[0]['nom_config'];
    $_SESSION["idses_config"] = $res[0]['id_config'];

    // convertimos el array de datos a formato json
    echo json_encode($datos);
}

function editar()
{
    include("enviar_correo.php");
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $resp = $db->update("tbl_configuracion", [
        "valor_config" => quitarComillas($_POST["valor_config"]),
        "fechaact_config" => $fechareg,
    ], ["id_config" => $_SESSION['idses_config']]);

    if (!$resp) {
        $respuesta = "=>" . mysql_error() . ": " . $sql;
    } else {

        $de = $_SESSION['correo'];
        $para = "notificaciones@coatincmx.com";
        $nombrePara = "Notificaciones Coatinc";
        $conCopia = "";

        $asunto = empresa . " - Configuración actualizada";
        $previsualizacion = "Se ha modificado la configuración";
        $mensajeHTML = "Se ha realizado una actualización con los siguientes datos:<br><br>
        URL: <b>" . base_url . "</b><br>
        Configuración: <b>" . $_SESSION["nomses_config"] . "</b><br>
        Valor de: <b>" . (($_POST["valor_config"] == "") ? "vacío" : quitarComillas($_POST["valor_config"])) . "</b><br>
        Usuario: <b>" . $_SESSION['nombre'] . "</b><br>
        Fecha: <b>" . $fechareg . "</b><br><br>";

        $envioCorreo = enviarCorreo($asunto, $previsualizacion, $mensajeHTML, $de, $para, $nombrePara, $conCopia);

        if ($envioCorreo) {
            $respuesta = 1;
        } else {
            $respuesta = 2;
        }
    }

    echo $respuesta;
}
