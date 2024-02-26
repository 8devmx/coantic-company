<?php
include("../includes/_funciones.php");
page_protect();
if ($_POST) {
    switch ($_POST['accion']) {
        case 'listar':listar();
            break;
        case 'consultar':consultar();
            break;
        case 'eventoActivo':eventoActivo();
            break;
        
    }
}

function listar() {
    global $db;

    $idland = ($_POST['idland'] != "") ? $_POST['idland'] : 0;
    $fechai = ($_POST['fechai'] != "") ? $_POST['fechai'] : "";
    $fechaf = ($_POST['fechaf'] != "") ? $_POST['fechaf'] : "";

    $sql = "SELECT id_pros, nom_pros, correo_pros, tel_pros, empresa_pros, proyecto_pros, mensaje_pros, fechareg_pros, idprod_pros, nom_prod FROM tbl_prospectos, tbl_productos WHERE activo_pros = 1 AND idprod_pros = id_prod ";
    $sql .= ($idland > 0)   ? "AND idprod_pros = ".$idland." " : "";
    $sql .= ($fechai && $fechaf)   ? "AND fechareg_pros BETWEEN '".$fechai." 00:00:00' AND '".$fechaf." 23:59:59' " : "";
    $sql .= "ORDER BY id_pros ASC";

    $res = $db->query($sql)->fetchAll();

    $_SESSION["sqlSess"] = $sql;
    $datos = array();
    
    foreach($res as $rows){
        $idfolio = str_pad($rows['id_pros'], 6, 0, STR_PAD_LEFT);

        $datos[] = array(
            'idprod_pros' => $rows['idprod_pros'],
            'nom_pros' => $rows['nom_pros'],
            'nomcorto_pros' => custom_echo($rows['nom_pros'],25),
            'nom_prod' => $rows['nom_prod'],
            'nomcorto_prod' => custom_echo($rows['nom_prod'],25),
            'correo_pros' => $rows['correo_pros'],
            'tel_pros' => $rows['tel_pros'],
            'empresa_pros' => $rows['empresa_pros'],
            'proyecto_pros' => $rows['proyecto_pros'],
            'mensaje_pros' => $rows['mensaje_pros'],
            'fechareg_pros' => obtenerDiaSemana($rows['fechareg_pros']),
            'horareg_pros' => obtenerHoraFecha($rows['fechareg_pros']),
            'id_pros' => $rows['id_pros'],
            'idtxt_pros' => "P".$idfolio
        );
    }

    echo json_encode($datos);
}

function consultar() {
    global $db;

    $sql = "SELECT * FROM tbl_prospectos, tbl_productos WHERE idprod_pros = id_prod AND id_pros = ".$_POST["id"];
    $res = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    $datos = array();
    
    $datos[] = array(
        'idprod_pros' => $res[0]['idprod_pros'],
        'nom_prod' => $res[0]['nom_prod'],
        'nom_pros' => $res[0]['nom_pros'],
        'correo_pros' => $res[0]['correo_pros'],
        'tel_pros' => $res[0]['tel_pros'],
        'empresa_pros' => $res[0]['empresa_pros'],
        'proyecto_pros' => $res[0]['proyecto_pros'],
        'mensaje_pros' => $res[0]['mensaje_pros'],
        'fechareg_pros' => obtenerDiaSemana($res[0]['fechareg_pros']),
        'horareg_pros' => obtenerHoraFecha($res[0]['fechareg_pros']),
        'id_pros' => $res[0]['id_pros']
    );

    $_SESSION["idses_pros"] = $res[0]['id_pros'];
    
    // convertimos el array de datos a formato json
    echo json_encode($datos);
}
function eventoActivo() {
    global $db;
    foreach ($_POST as $key => $value) {
        $post[$key] = filtro($value);
    }
    date_default_timezone_set("America/Mexico_City");
    $fecha =  date("Y-m-d");
    $hora = date("H:i:s");
    $fechareg = $fecha." ".$hora;

    $resp = $db->update("tbl_prospectos", [
        "activo_pros" => (($post['valor'] == "") ? 0 : $post['valor']),
        "fechaact_pros" => $fechareg
    ], ["id_pros" => $post['id'] ]);

    echo $resp;
}







