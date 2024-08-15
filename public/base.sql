CREATE DATABASE IF NOT EXISTS biblioteca;
USE biblioteca;
-- Tabla para almacenar editoriales
CREATE TABLE IF NOT EXISTS Editoriales (
    editorial_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    pais VARCHAR(100)
);

-- Tabla para almacenar categorías
CREATE TABLE IF NOT EXISTS Categorias (
    categoria_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla para almacenar libros
CREATE TABLE IF NOT EXISTS Libros (
    libro_id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    genero VARCHAR(100),
    fecha_publicacion DATE,
    isbn VARCHAR(20) UNIQUE,
    editorial_id INT,
    categoria_id INT,
    FOREIGN KEY (editorial_id) REFERENCES Editoriales(editorial_id) ON DELETE SET NULL,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(categoria_id) ON DELETE SET NULL
);

-- Tabla para almacenar autores
CREATE TABLE IF NOT EXISTS Autores (
    autor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE,
    nacionalidad VARCHAR(100)
);

-- Tabla intermedia para la relación muchos a muchos entre libros y autores
CREATE TABLE IF NOT EXISTS Libro_Autores (
    libro_id INT,
    autor_id INT,
    PRIMARY KEY (libro_id, autor_id),
    FOREIGN KEY (libro_id) REFERENCES Libros(libro_id) ON DELETE CASCADE,
    FOREIGN KEY (autor_id) REFERENCES Autores(autor_id) ON DELETE CASCADE
);
