<?php
require_once('../config/config.php');

class libros_autoresmodels
{
    // Método para obtener todos los registros de la relación libros-autores
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Libro_Autores";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener un registro específico de la relación libros-autores
    public function uno($libro_id, $autor_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Libro_Autores WHERE libro_id = $libro_id AND autor_id = $autor_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar un nuevo registro en la relación libros-autores
    public function insertar($libro_id, $autor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO Libro_Autores (libro_id, autor_id) VALUES ($libro_id, $autor_id)";
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

    // Método para actualizar un registro en la relación libros-autores (aunque en una tabla intermedia, normalmente no se actualiza, se puede eliminar y volver a insertar)
    public function actualizar($libro_id, $autor_id)
    {
        try {
            // Normalmente, no se actualizan registros en una tabla intermedia de muchos a muchos, pero si fuera necesario, este sería el enfoque
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE Libro_Autores SET libro_id = $libro_id, autor_id = $autor_id WHERE libro_id = $libro_id AND autor_id = $autor_id";
            if (mysqli_query($con, $cadena)) {
                return $libro_id;
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar un registro de la relación libros-autores
    public function eliminar($libro_id, $autor_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM Libro_Autores WHERE libro_id = $libro_id AND autor_id = $autor_id";
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
