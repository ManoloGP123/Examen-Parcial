<?php
require_once('../config/config.php');

class librosmodels
{
    // Método para obtener todos los registros de libros
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Libros";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener un registro de libro por su ID
    public function uno($libro_id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM Libros WHERE libro_id = $libro_id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar un nuevo libro en la base de datos
    public function insertar($titulo, $genero, $fecha_publicacion, $isbn, $editorial_id, $categoria_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO Libros (titulo, genero, fecha_publicacion, isbn, editorial_id, categoria_id) 
                       VALUES ('$titulo', '$genero', '$fecha_publicacion', '$isbn', $editorial_id, $categoria_id)";
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

    // Método para actualizar un libro existente en la base de datos
    public function actualizar($libro_id, $titulo, $genero, $fecha_publicacion, $isbn, $editorial_id, $categoria_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE Libros 
                       SET titulo = '$titulo', genero = '$genero', fecha_publicacion = '$fecha_publicacion', 
                           isbn = '$isbn', editorial_id = $editorial_id, categoria_id = $categoria_id 
                       WHERE libro_id = $libro_id";
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

    // Método para eliminar un libro de la base de datos
    public function eliminar($libro_id)
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM Libros WHERE libro_id = $libro_id";
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
