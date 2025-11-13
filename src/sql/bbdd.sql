-- Creamos la base de datos y la seleccionamos para usarla.
CREATE DATABASE gestion_novelas;
USE gestion_novelas; 

-- Creamos las tabla Autor que contendrá los datos de los autores.
CREATE TABLE Autor (
    id_autor INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(100) NOT NULL 
);

-- Creamos la tabla Editorial que contendrá los datos de las editoriales.
CREATE TABLE Editorial (
    id_editorial INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(100) NOT NULL  
);

-- Creamos la tabla Novela que contendrá los datos de las novelas.
CREATE TABLE Novela (
    id_novela INT AUTO_INCREMENT PRIMARY KEY, 
    titulo VARCHAR(150) NOT NULL, 
    fechaPublicacion INT,
    id_autor INT, 
    id_editorial INT, 
    FOREIGN KEY (id_autor) REFERENCES Autor(id_autor), 
    FOREIGN KEY (id_editorial) REFERENCES Editorial(id_editorial) 
);

-- Creamos un usuario específico para gestionar la base de datos gestion_novelas.
CREATE USER 'novelas_user'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON gestion_novelas.* TO 'novelas_user'@'localhost';

-- Reiniciamos los contadores AUTO_INCREMENT de las tablas.
ALTER TABLE Novela AUTO_INCREMENT = 4;


