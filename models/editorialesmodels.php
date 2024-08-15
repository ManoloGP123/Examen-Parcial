<?php
require_once('../config/config.php');

class editorialesmodels
{
    // Método para obtener todos los registros de editoriales
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Editoriales";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener un registro de editorial por su ID
    public function uno($editorial_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Editoriales WHERE editorial_id = $editorial_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar un nuevo registro de editorial
    public function insertar($nombre, $pais)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO Editoriales (nombre, pais) VALUES ('$nombre', '$pais')";
            if (mysqli_query($con, $cadena)) {
                return $con->insert_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para actualizar un registro de editorial existente
    public function actualizar($editorial_id, $nombre, $pais)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE Editoriales SET nombre = '$nombre', pais = '$pais' WHERE editorial_id = $editorial_id";
            if (mysqli_query($con, $cadena)) {
                return $editorial_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar un registro de editorial por su ID
    public function eliminar($editorial_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM Editoriales WHERE editorial_id = $editorial_id";
            if (mysqli_query($con, $cadena)) {
                return 1;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
