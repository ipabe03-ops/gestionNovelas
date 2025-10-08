--Creamos la base de datos y la seleccionamos para usarla.
CREATE DATABASE gestion_novelas;
USE gestion_novelas; 

--Creamos las tabla Autor que contendrá los datos de los autores.
CREATE TABLE Autor (
    id_autor INT AUTO_INCREMENT PRIMARY KEY, --Clave primaria
    nombreAutor VARCHAR(100) NOT NULL --Nombre del autor
);

--Creamos la tabla Editorial que contendrá los datos de las editoriales.
CREATE TABLE Editorial (
    id_editorial INT AUTO_INCREMENT PRIMARY KEY, --Clave primaria
    nombreEditorial VARCHAR(100) NOT NULL --Nombre de la editorial  
);

--Creamos la tabla Novela que contendrá los datos de las novelas.
CREATE TABLE Novela (
    id_novela INT AUTO_INCREMENT PRIMARY KEY, --Clave primaria
    titulo VARCHAR(150) NOT NULL, --Título de la novela
    fechaPublicacion INT, --Año de publicación
    id_autor INT, --ID del autor 
    id_editorial INT, --ID de la editorial
    FOREIGN KEY (id_autor) REFERENCES Autor(id_autor), --Clave foránea que referencia a la tabla Autor
    FOREIGN KEY (id_editorial) REFERENCES Editorial(id_editorial) --Clave foránea que referencia a la tabla Editorial
);


-- Scrip para insertar los datos iniciales.

USE gestion_novelas;

INSERT INTO Autor (nombreAutor) VALUES
('Frank Herbert'),
('William Gibson'),
('Isaac Asimov'),
('Neal Stephenson');

INSERT INTO Editorial (nombreEditorial) VALUES
('Ace Books'),
('Gnome Press'),
('Bantam Books');

INSERT INTO Novela (titulo,  fechaPublicacion, id_autor, id_editorial) VALUES
('Dune', 1965, 1, 1),      
('Neuromante', 1984, 2, 1), 
('Fundación', 1951, 3, 2), 
('Snow Crash', 1992, 4, 3);
