<?php
// Ajustar la ruta para incluir el archivo de configuración desde la carpeta 'config'
require_once('config/config.php'); 

// Crear una instancia de la clase de conexión
$con = new ClaseConectar();
$conexion = $con->ProcedimientoParaConectar();

// Verificar la conexión
if ($conexion->connect_error) {
    echo "Error de conexión: " . $conexion->connect_error;
} else {
    echo "Conexión exitosa a la base de datos.";
}

// Cerrar la conexión
$conexion->close();
?>
