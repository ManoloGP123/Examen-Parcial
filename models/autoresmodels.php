<?php
// Incluir el archivo de configuración para la conexión a la base de datos
require_once('../config/config.php');

class autoresmodels
{
    // Obtiene todos los registros de autores
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `autores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Obtiene un registro de autor específico por ID
    public function uno($autor_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `autores` WHERE `autor_id` = $autor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Inserta un nuevo autor en la base de datos
    public function insertar($nombre, $apellido, $fecha_nacimiento, $nacionalidad)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `autores` (`nombre`, `apellido`, `fecha_nacimiento`, `nacionalidad`) 
                       VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$nacionalidad')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id; // Devuelve el ID del nuevo autor
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Actualiza la información de un autor existente
    public function actualizar($autor_id, $nombre, $apellido, $fecha_nacimiento, $nacionalidad)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `autores` 
                       SET `nombre` = '$nombre', `apellido` = '$apellido', `fecha_nacimiento` = '$fecha_nacimiento', `nacionalidad` = '$nacionalidad' 
                       WHERE `autor_id` = $autor_id";
            if (mysqli_query($con, $cadena)) {
                return $autor_id; // Devuelve el ID del autor actualizado
            } else {
                return $con->error; // Devuelve el error si la consulta falla
            }
        } catch (Exception $th) {
            return $th->getMessage(); // Devuelve el mensaje de excepción si ocurre un error
        } finally {
            $con->close(); // Cierra la conexión a la base de datos
        }
    }

    // Elimina un registro de autor específico por ID
    public function eliminar($autor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `autores` WHERE `autor_id` = $autor_id";
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
