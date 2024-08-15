<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de editoriales
require_once('../models/editorialesmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase editorialesmodels
$editoriales = new editorialesmodels();

switch ($_GET["op"]) {
    case 'todos':
        $todos = array();
        $datos = $editoriales->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $editorial_id = $_POST["editorial_id"];
        $datos = $editoriales->uno($editorial_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombre = $_POST["nombre"];
        $pais = $_POST["pais"];
        $datos = $editoriales->insertar($nombre, $pais);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $editorial_id = $_POST["editorial_id"];
        $nombre = $_POST["nombre"];
        $pais = $_POST["pais"];
        $datos = $editoriales->actualizar($editorial_id, $nombre, $pais);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $editorial_id = $_POST["editorial_id"];
        $datos = $editoriales->eliminar($editorial_id);
        echo json_encode($datos);
        break;
}
?>
