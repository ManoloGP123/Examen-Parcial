<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

// Incluir el modelo de libros
require_once('../models/librosmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase Libros
$libros = new librosmodels;

switch ($_GET["op"]) {
    // Obtener todos los registros de libros
    case 'todos':
        $todos = array();
        $datos = $libros->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // Obtener un registro de libro por su ID
    case 'uno':
        $libro_id = $_POST["libro_id"];
        $datos = $libros->uno($libro_id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    // Insertar un nuevo registro de libro
    case 'insertar':
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $fecha_publicacion = $_POST["fecha_publicacion"];
        $isbn = $_POST["isbn"];
        $editorial_id = $_POST["editorial_id"];
        $categoria_id = $_POST["categoria_id"];

        $datos = $libros->insertar($titulo, $genero, $fecha_publicacion, $isbn, $editorial_id, $categoria_id);
        echo json_encode($datos);
        break;

    // Actualizar un registro de libro existente
    case 'actualizar':
        $libro_id = $_POST["libro_id"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $fecha_publicacion = $_POST["fecha_publicacion"];
        $isbn = $_POST["isbn"];
        $editorial_id = $_POST["editorial_id"];
        $categoria_id = $_POST["categoria_id"];

        $datos = $libros->actualizar($libro_id, $titulo, $genero, $fecha_publicacion, $isbn, $editorial_id, $categoria_id);
        echo json_encode($datos);
        break;

    // Eliminar un registro de libro
    case 'eliminar':
        $libro_id = $_POST["libro_id"];
        $datos = $libros->eliminar($libro_id);
        echo json_encode($datos);
        break;
}
?>
