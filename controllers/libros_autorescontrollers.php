<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

// Incluir el modelo de libros_autores
require_once('../models/libros_autoresmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Libros_Autores
$libros_autores = new libros_autoresmodels;

switch ($_GET["op"]) {
    // Obtener todos los registros de la relación libros-autores
    case 'todos':
        $todos = array();
        $datos = $libros_autores->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // Obtener un registro de la relación libros-autores por libro_id y autor_id
    case 'uno':
        $libro_id = $_POST["libro_id"];
        $autor_id = $_POST["autor_id"];
        $datos = $libros_autores->uno($libro_id, $autor_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    // Insertar un nuevo registro en la relación libros-autores
    case 'insertar':
        $libro_id = $_POST["libro_id"];
        $autor_id = $_POST["autor_id"];
        $datos = $libros_autores->insertar($libro_id, $autor_id);
        echo json_encode($datos);
        break;

    // Actualizar un registro existente en la relación libros-autores
    case 'actualizar':
        $libro_id = $_POST["libro_id"];
        $autor_id = $_POST["autor_id"];
        $datos = $libros_autores->actualizar($libro_id, $autor_id);
        echo json_encode($datos);
        break;

    // Eliminar un registro en la relación libros-autores
    case 'eliminar':
        $libro_id = $_POST["libro_id"];
        $autor_id = $_POST["autor_id"];
        $datos = $libros_autores->eliminar($libro_id, $autor_id);
        echo json_encode($datos);
        break;
}
?>
