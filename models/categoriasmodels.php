<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once('../config/config.php');

class categoriasmodels
{
    // Obtiene todos los registros de categorías
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `categorias`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtiene un registro de categoría específico por ID
    public function uno($categoria_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `categorias` WHERE `categoria_id` = $categoria_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Inserta un nuevo registro de categoría en la base de datos
    public function insertar($nombre)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `categorias` (`nombre`) VALUES ('$nombre')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Devuelve el ID de la nueva categoría
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Actualiza la información de una categoría existente
    public function actualizar($categoria_id, $nombre)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `categorias` SET `nombre` = '$nombre' WHERE `categoria_id` = $categoria_id";
            if (mysqli_query($con, $cadena)) {
                return $categoria_id; // Devuelve el ID de la categoría actualizada
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Elimina un registro de categoría específico por ID
    public function eliminar($categoria_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `categorias` WHERE `categoria_id` = $categoria_id";
            if (mysqli_query($con, $cadena)) {
                return 1; // Devuelve 1 si la eliminación fue exitosa
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }
}
?>
