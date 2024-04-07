<?php
include("../../includes/_funciones.php");
page_protect();
if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar':
            guardar();
            break;
        case 'listar':
            listar();
            break;
        case 'consultar':
            consultar();
            break;
        case 'editar':
            editar();
            break;
        case 'eliminar':
            eliminar();
            break;
        case 'duplicar':
            duplicar();
            break;
    }
}

function guardar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_vac = replaceUrl($_POST['nom_vac']);
    $galeria_vac = "";

    $countGaleria = strlen($_POST["galeria_vac"]);
    if ($countGaleria > 1) {
        $galeria_vac = $_POST["galeria_vac"];
    } else {
        $galeria_vac = "**";
    }

    $sqlValida = "SELECT COUNT(id_vac) AS existe FROM vacantes WHERE activo_vac = 1 AND url_vac = '" . trim($url_vac) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $db->insert("vacantes", [
            "url_vac" => $url_vac,
            "nom_vac" => $_POST["nom_vac"],
            "texto1_vac" => $_POST["texto1_vac"],
            "desc_vac" => $_POST["desc_vac"],
            "fechaact_vac" => $fechareg
        ]);
        $idInsert = $db->id();
        if ($idInsert > 0) {
            $resp = $idInsert;
        } else {
            $resp = "No se registro";
        }
    } else {
        $resp = "existe";
    }

    echo $resp;
}

function listar()
{
    global $db;

    $sql = "SELECT * FROM vacantes WHERE activo_vac = 1 ORDER BY nom_vac ASC";
    $res = $db->query($sql)->fetchAll();

    $datos = array();

    foreach ($res as $rows) {

        $idfolio = str_pad($rows['id_vac'], 6, 0, STR_PAD_LEFT);

        $datos[] = array(
            'nom_vac' => $rows['nom_vac'],
            'url_vac' => $rows['url_vac'],
            'fechaact_vac' => obtenerDiaSemana($rows['fechaact_vac']),
            'horaact_vac' => obtenerHoraFecha($rows['fechaact_vac']),
            'id_vac' => $rows['id_vac'],
            'idtxt_vac' => "N" . $idfolio
        );
    }

    echo json_encode($datos);
}

function consultar()
{
    global $db;

    $sql = "SELECT * FROM vacantes WHERE id_vac = " . $_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();

    $datos[] = array(
        'url_vac' => $res[0]['url_vac'],
        'nom_vac' => $res[0]['nom_vac'],
        'texto1_vac' => $res[0]['texto1_vac'],
        'desc_vac' => $res[0]['desc_vac'],
        'foto_vac' => $res[0]['foto_vac'],
        'urlfoto_vac' => "../../../uploads/vacantes/" . $res[0]['foto_vac'],
        'galeria_vac' => (($res[0]['galeria_vac'] == null || $res[0]['galeria_vac'] == "") ? "**" : $res[0]['galeria_vac']),
        'id_vac' => $res[0]['id_vac']
    );

    $_SESSION["idses_vac"] = $res[0]['id_vac'];
    echo json_encode($datos);
}

function editar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_vac = replaceUrl($_POST['nom_vac']);

    $galeria_vac = "";

    $countGaleria = strlen($_POST["galeria_vac"]);
    if ($countGaleria > 1) {
        $galeria_vac = $_POST["galeria_vac"];
    } else {
        $galeria_vac = "**";
    }

    $sqlValida = "SELECT COUNT(id_vac) AS existe FROM vacantes WHERE activo_vac = 1 AND id_vac != " . $_SESSION['idses_vac'] . " AND url_vac = '" . trim($url_vac) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $resp = $db->update("vacantes", [
            "url_vac" => $url_vac,
            "nom_vac" => $_POST["nom_vac"],
            "texto1_vac" => $_POST["texto1_vac"],
            "desc_vac" => $_POST["desc_vac"],
            "foto_vac" => $_POST["foto_vac"],
            "galeria_vac" => $galeria_vac,
            "fechaact_vac" => $fechareg,
        ], ["id_vac" => $_SESSION['idses_vac']]);

        if ($resp->rowCount()) {
            $respuesta = 1;
        }
    } else {
        $respuesta = "existe";
    }

    echo $respuesta;
}

function eliminar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $resp = $db->update("vacantes", [
        "activo_vac" => 0,
        "fechaact_vac" => $fechareg
    ], ["id_vac" => $_POST['id_vac']]);

    echo $resp->rowCount();
}

function duplicar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_vac = replaceUrl($_POST['nombre-duplicar']);

    $sqlValida = "SELECT COUNT(id_vac) AS existe FROM vacantes WHERE activo_vac = 1 AND url_vac = '" . trim($url_vac) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $sql = "INSERT INTO vacantes 
        (url_vac, nom_vac, desc_vac, video_vac, foto_vac, galeria_vac, texto1_vac, texto2_vac, texto3_vac, bullets1_vac, bullets2_vac, bullets3_vac, fechareg_vac, fechaact_vac) 
        SELECT '" . $url_vac . "', '" . $_POST['nombre-duplicar'] . "', desc_vac, video_vac, foto_vac, galeria_vac, texto1_vac, texto2_vac, texto3_vac, bullets1_vac, bullets2_vac, bullets3_vac, '" . $fechareg . "', '" . $fechareg . "' 
        FROM vacantes 
        WHERE id_vac = '" . $_POST['idhid_vac'] . "'; ";

        $res = $db->query($sql);

        if (!$res) {
            // $respuesta = "=>" . mysql_error() . ": " . $sql;
        } else {
            $respuesta = 1;
        }
    } else {
        $respuesta = "existe";
    }

    echo $respuesta;
}
