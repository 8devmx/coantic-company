<?php
include("../../includes/_funciones.php");
page_protect();
$seccion_actual = "usuarios";
// 1. Agrega el nombre de la tabla
$tabla =  'usuarios';
// 2. Agrega el sufijo de la tabla
$sufijo = "_usr";
// 3. Array para insertar y editar(Modificar los campos correspondientes)

$usuario = trim($_POST['usuario']);
$password = md5(str_replace(' ', '', $_POST['password']));
$correo = trim($_POST['correo']);
$login = time();
$insertar_editar = [
    "nombre" . $sufijo => $_POST['nombre'],
    "correo" . $sufijo => $_POST['correo'],
    "usuario" . $sufijo => $usuario,
    "clave" . $sufijo => $password,
    "permisos" . $sufijo => $_POST['permisos'],
    "modulos" . $sufijo => $_POST['modulos'],
];

if ($_POST) {
    switch ($_POST['accion']) {
        case 'guardar':
            guardar($tabla, $insertar_editar);
            break;
        case 'listar':
            listar($tabla, $sufijo);
            break;
        case 'consultar':
            consultar($tabla, $sufijo);
            break;
        case 'editar':
            editar($tabla, $sufijo, $insertar_editar);
            break;
        case 'eliminar':
            eliminar($tabla, $sufijo);
            break;
    }
}

function guardar($tabla, $insertar_editar)
{
    global $db;
    $db->insert($tabla, $insertar_editar);
    $idInsert = $db->id();
    if ($idInsert > 0) {
        $respuesta = $idInsert;
    } else {
        $respuesta = "No se registro";
    }
    echo $respuesta;
}

function listar($tabla, $sufijo)
{
    global $db;
    $sql =  $db->select($tabla, "*", ["AND" => ["id" . $sufijo . "[>]" => 1, "activo" . $sufijo . "[>]" => 0], "ORDER" => "id" . $sufijo]);
    $datos = array();
    foreach ($sql as $key => $rows) {
        $tipo = ($rows['modulos' . $sufijo] === "todos") ? 'Administrador' : 'Editor';
        $permisos = ($rows['permisos' . $sufijo] === "1") ? 'Lectura/Escritura' : 'Lectura';
        $datos[] = array(
            'nombre' => $rows['nombre' . $sufijo],
            'usuario' => $rows['usuario' . $sufijo],
            'tipo' => $tipo,
            'permisos' => $permisos,
            'status' => $rows['activo' . $sufijo],
            'id' => $rows['id' . $sufijo]
        );
    }
    echo json_encode($datos);
}

function consultar($tabla, $sufijo)
{
    global $db;
    $sql = $db->get($tabla, "*", ["id" . $sufijo => $_POST['id']]);
    $datos = array();
    $datos[] = array(
        'nombre' => $sql['nombre' . $sufijo],
        'usuario' => $sql['usuario' . $sufijo],
        'clave' => $sql['clave' . $sufijo],
        'correo' => $sql['correo' . $sufijo],
        'permisos' => $sql['permisos' . $sufijo],
        'modulos' => $sql['modulos' . $sufijo],
        'id' => $sql['id' . $sufijo]
    );
    $_SESSION["idses" . $sufijo] = $sql['id' . $sufijo];
    $_SESSION["pwd_activo"] = $sql['clave' . $sufijo];
    echo json_encode($datos);
}

function editar($tabla, $sufijo, $insertar_editar)
{
    global $db;
    $idInsert = $db->update($tabla, $insertar_editar, ["id" . $sufijo => $_SESSION['idses' . $sufijo]]);
    if ($idInsert->rowCount()) {
        $respuesta = $idInsert;
    } else {
        $respuesta = "No se registro, el usuario ya existe o no ha realizado modificaciones";
    }
    echo $respuesta;
}

function eliminar($tabla, $sufijo)
{
    global $db;
    $res = $db->update($tabla, ["activo" . $sufijo => 0], ["id" . $sufijo => $_POST['id' . $sufijo]]);
    $respuesta = 0;
    if ($res->rowCount()) {
        $respuesta = 1;
    }
    echo $respuesta;
}
