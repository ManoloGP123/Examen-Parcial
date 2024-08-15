<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

// Incluir el modelo de categorías
require_once('../models/categoriasmodels.php');

// Desactivar la visualización de errores
error_reporting(0);

// Crear una instancia de la clase categoriasmodels
$categorias = new categoriasmodels();

switch ($_GET["op"]) {
    // Obtener todos los registros de categorías
    case 'todos':
        $todos = array(); // Inicializar un arreglo para almacenar los registros de categorías
        $datos = $categorias->todos(); // Recuperar todos los registros de categorías desde el modelo
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row; // Llenar el arreglo con los registros de categorías
        }
        echo json_encode($todos); // Enviar los registros como JSON
        break;

    // Obtener un registro de categoría por su ID
    case 'uno':
        $categoria_id = $_POST["categoria_id"];
        $datos = $categorias->uno($categoria_id); // Recuperar un registro de categoría desde el modelo
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res); // Enviar el registro como JSON
        break;

    // Insertar un nuevo registro de categoría
    case 'insertar':
        $nombre = $_POST["nombre"];
        $datos = $categorias->insertar($nombre); // Insertar el nuevo registro de categoría en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Actualizar un registro de categoría existente
    case 'actualizar':
        $categoria_id = $_POST["categoria_id"];
        $nombre = $_POST["nombre"];
        $datos = $categorias->actualizar($categoria_id, $nombre); // Actualizar el registro de categoría en la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;

    // Eliminar un registro de categoría
    case 'eliminar':
        $categoria_id = $_POST["categoria_id"];
        $datos = $categorias->eliminar($categoria_id); // Eliminar el registro de categoría de la base de datos
        echo json_encode($datos); // Enviar el resultado como JSON
        break;
}
?>
