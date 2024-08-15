<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de autores
require_once('../models/autoresmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase autoresmodels
$autores = new autoresmodels();

switch ($_GET["op"]) {
    // Obtener todos los registros de autores
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de autores
        $datos = $autores->todos(); // Recuperar todos los registros de autores desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de autores
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de autor por su ID
    case 'uno':
        $autor_id = $_POST["autor_id"];
        $datos = $autores->uno($autor_id); // Recuperar un registro de autor desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de autor
    case 'insertar':
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];
        $datos = $autores->insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad); // Insertar el nuevo registro de autor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de autor existente
    case 'actualizar':
        $autor_id = $_POST["autor_id"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $nacionalidad = $_POST["nacionalidad"];
        $datos = $autores->actualizar($autor_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad); // Actualizar el registro de autor en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de autor
    case 'eliminar':
        $autor_id = $_POST["autor_id"];
        $datos = $autores->eliminar($autor_id); // Eliminar el registro de autor de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
?>
