-- Scrip para insertar los datos iniciales.

USE gestion_novelas;

INSERT INTO Autor (nombre) VALUES
('Frank Herbert'),
('William Gibson'),
('Isaac Asimov'),
('Neal Stephenson');

INSERT INTO Editorial (nombre) VALUES
('Ace Books'),
('Gnome Press'),
('Bantam Books');

INSERT INTO Novela (titulo,  fechaPublicacion, id_autor, id_editorial) VALUES
('Dune', 1965, 1, 1),      
('Neuromante', 1984, 2, 1), 
('Fundación', 1951, 3, 2), 
('Snow Crash', 1992, 4, 3);