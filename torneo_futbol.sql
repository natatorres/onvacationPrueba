-- Crear base de datos
CREATE DATABASE torneo_futbol;

-- Crear tablas
CREATE TABLE equipos (
    id_equipos SERIAL PRIMARY KEY,
    nombre VARCHAR(45)
);

CREATE TABLE jugadores (
    id_jugadores SERIAL PRIMARY KEY,
    fk_equipos INT REFERENCES equipos(id_equipos),
    nombre VARCHAR(45),
    fecha_nacimiento TIMESTAMP
);

CREATE TABLE partidos (
    id_partidos SERIAL PRIMARY KEY,
    fk_equipo_local INT REFERENCES equipos(id_equipos),
    fk_equipo_visitante INT REFERENCES equipos(id_equipos),
    goles_local INT,
    goles_visitante INT,
    fecha_partido TIMESTAMP
);

-- Insertar equipos
INSERT INTO equipos (nombre) VALUES 
('Tiburones'),
('Águilas'),
('Leones'),
('Panteras'),
('Cóndores');

-- Insertar jugadores
INSERT INTO jugadores (fk_equipos, nombre, fecha_nacimiento) VALUES
(1, 'Carlos Pérez', '1995-06-12 00:00:00'),
(1, 'Daniel García', '1997-09-25 00:00:00'),
(2, 'Juan Díaz', '1998-04-20 00:00:00'),
(2, 'Andrés López', '1996-11-11 00:00:00'),
(3, 'Luis Torres', '2000-01-15 00:00:00'),
(3, 'Oscar Martínez', '1994-02-02 00:00:00'),
(4, 'Felipe Ruiz', '1999-08-08 00:00:00'),
(5, 'Mario Vargas', '1993-12-30 00:00:00'),
(5, 'Sebastián Gómez', '2001-03-14 00:00:00');

-- Insertar partidos
INSERT INTO partidos (id_partidos, fk_equipo_local, fk_equipo_visitante, goles_local, goles_visitante, fecha_partido) VALUES
(1, 1, 2, 2, 1, '2023-01-01 00:00:00'),
(2, 2, 3, 3, 3, '2023-03-01 00:00:00'),
(3, 1, 3, 1, 0, '2023-05-15 00:00:00'),
(4, 4, 5, 0, 2, '2023-02-20 00:00:00'),
(5, 5, 1, 1, 1, '2023-07-04 00:00:00'),
(6, 3, 2, 2, 2, '2023-06-12 00:00:00'),
(7, 4, 1, 0, 3, '2023-08-10 00:00:00'),
(8, 2, 5, 1, 0, '2023-09-15 00:00:00'),
(9, 1, 5, 4, 2, '2023-10-05 00:00:00'),
(10, 3, 1, 0, 1, '2023-10-12 00:00:00'),
(11, 2, 4, 3, 2, '2023-11-01 00:00:00'),
(12, 5, 2, 0, 0, '2023-11-10 00:00:00'),
(13, 4, 3, 2, 1, '2023-12-01 00:00:00'),
(14, 1, 2, 1, 1, '2024-01-15 00:00:00'),
(15, 3, 5, 3, 0, '2024-02-20 00:00:00'),
(16, 5, 4, 2, 2, '2024-03-10 00:00:00'),
(17, 2, 1, 0, 2, '2024-04-05 00:00:00'),
(18, 3, 4, 1, 1, '2024-05-01 00:00:00'),
(19, 4, 2, 0, 3, '2024-06-01 00:00:00'),
(20, 5, 3, 4, 1, '2024-07-10 00:00:00'),
(21, 1, 4, 2, 2, '2024-08-01 00:00:00'),
(22, 2, 5, 1, 3, '2024-08-15 00:00:00'),
(23, 3, 1, 0, 2, '2024-09-01 00:00:00'),
(24, 4, 2, 1, 0, '2024-09-20 00:00:00'),
(25, 5, 3, 2, 2, '2024-10-05 00:00:00'),
(26, 1, 5, 3, 1, '2024-10-15 00:00:00'),
(27, 2, 3, 2, 2, '2024-11-01 00:00:00'),
(28, 3, 4, 1, 3, '2024-11-20 00:00:00'),
(29, 4, 1, 0, 1, '2024-12-05 00:00:00'),
(30, 5, 2, 2, 0, '2024-12-15 00:00:00');
