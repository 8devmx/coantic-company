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

    $url_blog = replaceUrl($_POST['nom_blog']);
    $galeria_blog = "";

    $countGaleria = strlen($_POST["galeria_blog"]);
    if ($countGaleria > 1) {
        $galeria_blog = $_POST["galeria_blog"];
    } else {
        $galeria_blog = "**";
    }

    $sqlValida = "SELECT COUNT(id_blog) AS existe FROM blog WHERE activo_blog = 1 AND url_blog = '" . trim($url_blog) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $db->insert("blog", [
            "url_blog" => $url_blog,
            "nom_blog" => $_POST["nom_blog"],
            "texto1_blog" => $_POST["texto1_blog"],
            "desc_blog" => $_POST["desc_blog"],
            "foto_blog" => $_POST["foto_blog"],
            "galeria_blog" => $galeria_blog,
            "fechaact_blog" => $fechareg
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

    $sql = "SELECT * FROM blog WHERE activo_blog in (1,2) ORDER BY nom_blog ASC";
    $res = $db->query($sql)->fetchAll();

    $datos = array();

    foreach ($res as $rows) {

        $idfolio = str_pad($rows['id_blog'], 6, 0, STR_PAD_LEFT);

        $datos[] = array(
            'nom_blog' => $rows['nom_blog'],
            'url_blog' => $rows['url_blog'],
            'fechaact_blog' => obtenerDiaSemana($rows['fechaact_blog']),
            'horaact_blog' => obtenerHoraFecha($rows['fechaact_blog']),
            'id_blog' => $rows['id_blog'],
            'idtxt_blog' => "N" . $idfolio
        );
    }

    echo json_encode($datos);
}

function consultar()
{
    global $db;

    $sql = "SELECT * FROM blog WHERE id_blog = " . $_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();

    $datos[] = array(
        'url_blog' => $res[0]['url_blog'],
        'nom_blog' => $res[0]['nom_blog'],
        'texto1_blog' => $res[0]['texto1_blog'],
        'desc_blog' => $res[0]['desc_blog'],
        'foto_blog' => $res[0]['foto_blog'],
        'urlfoto_blog' => "../../../uploads/blog/" . $res[0]['foto_blog'],
        'galeria_blog' => (($res[0]['galeria_blog'] == null || $res[0]['galeria_blog'] == "") ? "**" : $res[0]['galeria_blog']),
        'id_blog' => $res[0]['id_blog']
    );

    $_SESSION["idses_blog"] = $res[0]['id_blog'];
    echo json_encode($datos);
}

function editar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_blog = replaceUrl($_POST['nom_blog']);

    $galeria_blog = "";

    $countGaleria = strlen($_POST["galeria_blog"]);
    if ($countGaleria > 1) {
        $galeria_blog = $_POST["galeria_blog"];
    } else {
        $galeria_blog = "**";
    }

    $sqlValida = "SELECT COUNT(id_blog) AS existe FROM blog WHERE activo_blog = 1 AND id_blog != " . $_SESSION['idses_blog'] . " AND url_blog = '" . trim($url_blog) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $resp = $db->update("blog", [
            "url_blog" => $url_blog,
            "nom_blog" => $_POST["nom_blog"],
            "texto1_blog" => $_POST["texto1_blog"],
            "desc_blog" => $_POST["desc_blog"],
            "foto_blog" => $_POST["foto_blog"],
            "galeria_blog" => $galeria_blog,
            "fechaact_blog" => $fechareg,
            "activo_blog" => 1
        ], ["id_blog" => $_SESSION['idses_blog']]);

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

    $resp = $db->update("blog", [
        "activo_blog" => 0,
        "fechaact_blog" => $fechareg
    ], ["id_blog" => $_POST['id_blog']]);

    echo $resp->rowCount();
}

function duplicar()
{
    global $db;
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha . " " . $hora;

    $url_blog = replaceUrl($_POST['nombre-duplicar']);

    $sqlValida = "SELECT COUNT(id_blog) AS existe FROM blog WHERE activo_blog = 1 AND url_blog = '" . trim($url_blog) . "'; ";
    $resValida = $db->query($sqlValida)->fetchAll(PDO::FETCH_ASSOC);
    $existe = $resValida[0]['existe'];

    if ($existe == 0) {
        $sql = "INSERT INTO blog 
        (url_blog, nom_blog, desc_blog, video_blog, foto_blog, galeria_blog, texto1_blog, texto2_blog, texto3_blog, bullets1_blog, bullets2_blog, bullets3_blog, fechareg_blog, fechaact_blog) 
        SELECT '" . $url_blog . "', '" . $_POST['nombre-duplicar'] . "', desc_blog, video_blog, foto_blog, galeria_blog, texto1_blog, texto2_blog, texto3_blog, bullets1_blog, bullets2_blog, bullets3_blog, '" . $fechareg . "', '" . $fechareg . "' 
        FROM blog 
        WHERE id_blog = '" . $_POST['idhid_blog'] . "'; ";

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
