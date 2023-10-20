DROP DATABASE IF EXISTS streaming_system;
CREATE DATABASE streaming_system;
USE streaming_system;


CREATE TABLE detalles_plan (
    id_plan INTEGER NOT NULL AUTO_INCREMENT,
    nombre CHAR(128) NOT NULL,
    descripcion CHAR(255) NOT NULL,
    precio INT NOT NULL,
    PRIMARY KEY(id_plan)
);

CREATE TABLE usuario (
  id_usuario INTEGER NOT NULL AUTO_INCREMENT,
  nombre CHAR(128)  NOT NULL,
  apellido_paterno CHAR(128) NOT NULL,
  apellido_materno CHAR(128) DEFAULT NULL,
  correo CHAR(128) NOT NULL UNIQUE,
  contrasena CHAR(128) NOT NULL,
  id_plan INTEGER NOT NULL,
  PRIMARY KEY(id_usuario),
  FOREIGN KEY(id_plan) REFERENCES detalles_plan(id_plan) ON DELETE RESTRICT
);

CREATE TABLE perfil (
    id_perfil INTEGER NOT NULL AUTO_INCREMENT,
    id_usuario INTEGER NOT NULL,
    username CHAR(64) DEFAULT NULL UNIQUE,
    edad SMALLINT(2) DEFAULT NULL,
    PRIMARY KEY(id_perfil),
    FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE categoria (
    id_categoria INTEGER NOT NULL AUTO_INCREMENT,
    nombre CHAR(128) DEFAULT NULL,
    PRIMARY KEY(id_categoria)
);

CREATE TABLE contenido (
    id_contenido INTEGER NOT NULL AUTO_INCREMENT,
    titulo CHAR(255) DEFAULT NULL,
    tipo CHAR(16) DEFAULT NULL,
    clasificacion CHAR(8) DEFAULT NULL,
    direccion_imagen VARCHAR(255),
    PRIMARY KEY(id_contenido)
);

CREATE TABLE categorias_contenido (
    id_categoria INTEGER NOT NULL,
    id_contenido INTEGER NOT NULL,
    FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria) ON DELETE RESTRICT,
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE resena (
    id_resena INT NOT NULL AUTO_INCREMENT,
    comentario CHAR(255) DEFAULT NULL,
    calificacion SMALLINT(2) DEFAULT NULL,
    PRIMARY KEY(id_resena)
);

CREATE TABLE interaccion(
    id_interaccion INTEGER AUTO_INCREMENT,    
    id_perfil INTEGER NOT NULL,
    id_resena INTEGER DEFAULT NULL,
    id_contenido INTEGER NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_interaccion),
    FOREIGN KEY(id_perfil) REFERENCES perfil(id_perfil) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_resena) REFERENCES resena(id_resena) ON DELETE SET NULL,
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pelicula (
    id_pelicula INTEGER NOT NULL AUTO_INCREMENT,
    id_contenido INTEGER NOT NULL,
    duracion_mins SMALLINT(3) DEFAULT NULL,
    PRIMARY KEY(id_pelicula),
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) ON DELETE RESTRICT
);

CREATE TABLE serie (
    id_serie INTEGER NOT NULL AUTO_INCREMENT,
    id_contenido INTEGER NOT NULL,
    num_temporadas SMALLINT(3) DEFAULT NULL,
    num_capitulos SMALLINT(4) DEFAULT NULL,
    PRIMARY KEY(id_serie),
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) ON DELETE RESTRICT
);

INSERT INTO categoria(nombre) VALUES('Accion');
INSERT INTO categoria(nombre) VALUES('Drama');
INSERT INTO categoria(nombre) VALUES('Ciencia ficcion');
INSERT INTO categoria(nombre) VALUES('Misterio');
INSERT INTO categoria(nombre) VALUES('Comedia');
INSERT INTO categoria(nombre) VALUES('Historico');
INSERT INTO categoria(nombre) VALUES('Crimen');
INSERT INTO categoria(nombre) VALUES('Medico');
INSERT INTO categoria(nombre) VALUES('Romantico');
INSERT INTO categoria(nombre) VALUES('Melodrama');
INSERT INTO categoria(nombre) VALUES('Aventura');
INSERT INTO categoria(nombre) VALUES('Tragedia');
INSERT INTO categoria(nombre) VALUES('Terror');
INSERT INTO categoria(nombre) VALUES('Anime');

INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Titanic', 'Pelicula', 'PG-13');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Matrix', 'Pelicula', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Interstellar', 'Pelicula', 'PG-13');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Better call Saul', 'Serie', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Chernobyl', 'Serie', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Game of Thrones', 'Serie', 'Ao');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Stranger Things', 'Serie', 'T'); 
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('The Office', 'Serie', 'PG-13');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Oppenheimer', 'Pelicula', 'Ao');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Wall-e', 'Pelicula', 'E');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Friends', 'Serie', 'T');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Black mirror', 'Serie', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Joker', 'Pelicula', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Pulp fiction', 'Pelicula', 'Ao');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Terminator', 'Pelicula', 'T');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Back to the future', 'Pelicula', 'E');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Dr. House', 'Serie', 'T');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Breaking bad', 'Serie', 'M');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Hunter x Hunter', 'Serie', 'PG-13');
INSERT INTO contenido(titulo, tipo, clasificacion) VALUES ('Whiplash', 'Pelicula', 'PG');
INSERT INTO contenido(titulo, tipo, clasificacion, direccion_imagen) VALUES ('Anne with an E', 'Serie', 'PG', 'images/img_contenido/AnneWithAnE.jpg');
INSERT INTO contenido(titulo, tipo, clasificacion, direccion_imagen) VALUES ('Kiki: entregas a domicilio', 'Pelicula', 'G', 'images/img_contenido/Kiki.jpg');

INSERT INTO categorias_contenido (id_categoria, id_contenido) VALUES
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Titanic')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Romantico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Titanic')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Melodrama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Titanic')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Tragedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Titanic')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Accion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Matrix')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Matrix')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Matrix')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Interstellar')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Interstellar')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Crimen'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Better call Saul')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Better call Saul')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Tragedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Better call Saul')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Historico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Chernobyl')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Tragedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Chernobyl')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Chernobyl')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Accion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Game of Thrones')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Game of Thrones')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Stranger Things')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Terror'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Stranger Things')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Stranger Things')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Comedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'The Office')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Historico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Wall-e')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Comedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Wall-e')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Comedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Friends')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Romantico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Friends')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Black mirror')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Black mirror')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Crimen'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Crimen'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Pulp fiction')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Pulp fiction')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Accion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Pulp fiction')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Accion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Terminator')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Terminator')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Terminator')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Ciencia ficcion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Back to the future')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Back to the future')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Medico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Dr. House')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Dr. House')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Breaking bad')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Crimen'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Breaking bad')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Tragedia'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Breaking bad')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Accion'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Hunter x Hunter')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Hunter x Hunter')),
	((SELECT id_categoria FROM categoria WHERE nombre = 'Anime'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Hunter x Hunter')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Whiplash')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Historico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Anne with an E')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Drama'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Anne with an E')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Romantico'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Anne with an E')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Aventura'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Kiki: entregas a domicilio')),
    ((SELECT id_categoria FROM categoria WHERE nombre = 'Anime'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Kiki: entregas a domicilio'));



INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 194 FROM contenido WHERE titulo = 'Titanic';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 136 FROM contenido WHERE titulo = 'Matrix';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 169 FROM contenido WHERE titulo = 'Interstellar';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 180 FROM contenido WHERE titulo = 'Oppenheimer';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 98 FROM contenido WHERE titulo = 'Wall-e';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 122 FROM contenido WHERE titulo = 'Joker';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 154 FROM contenido WHERE titulo = 'Pulp Fiction';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 107 FROM contenido WHERE titulo = 'Terminator';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 116 FROM contenido WHERE titulo = 'Back to the future';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 107 FROM contenido WHERE titulo = 'Whiplash';
INSERT INTO pelicula (id_contenido, duracion_mins) SELECT id_contenido, 107 FROM contenido WHERE titulo = 'Kiki: entregas a domicilio';

INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 6, 63 FROM contenido WHERE titulo = 'Better Call Saul';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 1, 5 FROM contenido WHERE titulo = 'Chernobyl';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 8, 73 FROM contenido WHERE titulo = 'Game of Thrones';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 4, 34 FROM contenido WHERE titulo = 'Stranger Things';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 9, 201 FROM contenido WHERE titulo = 'The Office';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 10, 236 FROM contenido WHERE titulo = 'Friends';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 6, 27 FROM contenido WHERE titulo = 'Black mirror';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 8, 177 FROM contenido WHERE titulo = 'Dr. House';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 5, 62 FROM contenido WHERE titulo = 'Breaking bad';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 5, 148 FROM contenido WHERE titulo = 'Hunter x Hunter';
INSERT INTO serie (id_contenido, num_temporadas, num_capitulos) SELECT id_contenido, 3, 27 FROM contenido WHERE titulo = 'Anne with an E';

INSERT INTO detalles_plan (nombre, descripcion, precio) VALUES
    ('Estandar con anuncios', 'Con anuncios, todas las peliculas y series excepto unas pocas, hasta dos pantallas a la vez, FullHD', 99),
    ('Basico', 'Peliculas y series ilimitadas sin anuncios, 1 pantalla a la vez, HD, descarga en 1 dispositivo a la vez', 139),
    ('Estandar', 'Peliculas y series ilimitadas sin anuncios, 2 pantalla a la vez, FullHD, descarga en 2 dispositivo a la vez, agregar 1 perfil adicional que no viva contigo', 219),
    ('Premium', 'Peliculas y series ilimitadas sin anuncios, 4 pantalla a la vez, UltraHD, descarga en 6 dispositivo a la vez, agregar 2 perfiles adicionales que no vivan contigo',299);


INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, correo, contrasena, id_plan) VALUES
    ('admin', 'admin', 'admin', 'admin@admin', 'dywMNuk4Xe2LYsH', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Premium')),
    ('Andrea', 'Martinez', 'Perez', 'andrea@hotmail.com', 'andrea567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar con anuncios')),
    ('Miguel', 'Hernandez', 'Rodriguez', 'miguel@gmail.com', 'miguel890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Laura', 'Lopez', 'Fernandez', 'laura@hotmail.com', 'laura123', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Daniel', 'Perez', 'Gonzalez', 'daniel@gmail.com', 'daniel567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Carla', 'Rodriguez', 'Morales', 'carla@hotmail.com', 'carla890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Diego', 'Fernandez', 'Diaz', 'diego@gmail.com', 'diego1234', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Sofia', 'Gonzalez', 'Ruiz', 'sofia@hotmail.com', 'sofia567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Pablo', 'Morales', 'Alvarez', 'pablo@gmail.com', 'pablo890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Premium')),
    ('Valeria', 'Diaz', 'Sanchez', 'valeria@hotmail.com', 'valeria123', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Alejandro', 'Ruiz', 'Torres', 'alejandro@gmail.com', 'alejandro567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Fernanda', 'Alvarez', 'Ramirez', 'fernanda@hotmail.com', 'fernanda890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Luisa', 'Sanchez', 'Vargas', 'luisa@gmail.com', 'luisa1234', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Carlos', 'Torres', 'Castro', 'carlos@hotmail.com', 'carlos567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Ana', 'Ramirez', 'Juarez', 'ana@gmail.com', 'ana890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Premium')),
    ('David', 'Vargas', 'Navarro', 'david@hotmail.com', 'david123', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Elena', 'Castro', 'Soto', 'elena@gmail.com', 'elena567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Basico')),
    ('Ricardo', 'Juarez', 'Martinez', 'ricardo@hotmail.com', 'ricardo890', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Premium')),
    ('Marina', 'Navarro', 'Gomez', 'marina@gmail.com', 'marina123', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar')),
    ('Adrian', 'Soto', 'Lopez', 'adrian@hotmail.com', 'adrian567', (SELECT id_plan FROM detalles_plan WHERE nombre = 'Estandar'));

INSERT INTO perfil (id_usuario, username, edad) VALUES 
    ((SELECT id_usuario FROM usuario WHERE correo = 'admin@admin'), 'admin', 22),
    ((SELECT id_usuario FROM usuario WHERE correo = 'andrea@hotmail.com'), 'andreamartinez', 25),
    ((SELECT id_usuario FROM usuario WHERE correo = 'miguel@gmail.com'), 'miguelhernandez', 29),
	((SELECT id_usuario FROM usuario WHERE correo = 'miguel@gmail.com'), 'rodrigoperez', 18),
    ((SELECT id_usuario FROM usuario WHERE correo = 'laura@hotmail.com'), 'lauralopez', 24),
    ((SELECT id_usuario FROM usuario WHERE correo = 'daniel@gmail.com'), 'danielperez', 27),
    ((SELECT id_usuario FROM usuario WHERE correo = 'carla@hotmail.com'), 'carlarodriguez', 26),
    ((SELECT id_usuario FROM usuario WHERE correo = 'diego@gmail.com'), 'diegofernandez', 31),
	((SELECT id_usuario FROM usuario WHERE correo = 'diego@gmail.com'), 'ernestodiaz', 24),
    ((SELECT id_usuario FROM usuario WHERE correo = 'sofia@hotmail.com'), 'sofiagonzalez', 30),
	((SELECT id_usuario FROM usuario WHERE correo = 'sofia@hotmail.com'), 'luizgonzalez', 9),
    ((SELECT id_usuario FROM usuario WHERE correo = 'pablo@gmail.com'), 'pablomorales', 33),
	((SELECT id_usuario FROM usuario WHERE correo = 'pablo@gmail.com'), 'paolarodriguez', 36),
	((SELECT id_usuario FROM usuario WHERE correo = 'pablo@gmail.com'), 'miguelmorales', 14),
    ((SELECT id_usuario FROM usuario WHERE correo = 'valeria@hotmail.com'), 'valeriadiaz', 29),
	((SELECT id_usuario FROM usuario WHERE correo = 'valeria@hotmail.com'), 'sofiavergara', 21),
    ((SELECT id_usuario FROM usuario WHERE correo = 'alejandro@gmail.com'), 'alejandroruiz', 32),
    ((SELECT id_usuario FROM usuario WHERE correo = 'fernanda@hotmail.com'), 'fernandaalvarez', 26),
    ((SELECT id_usuario FROM usuario WHERE correo = 'luisa@gmail.com'), 'luisasanchez', 28),
    ((SELECT id_usuario FROM usuario WHERE correo = 'carlos@hotmail.com'), 'carlostorres', 31),
    ((SELECT id_usuario FROM usuario WHERE correo = 'ana@gmail.com'), 'anaramirez', 35),
	((SELECT id_usuario FROM usuario WHERE correo = 'ana@gmail.com'), 'lauragarcia', 28),
    ((SELECT id_usuario FROM usuario WHERE correo = 'david@hotmail.com'), 'davidvargas', 27),
    ((SELECT id_usuario FROM usuario WHERE correo = 'elena@gmail.com'), 'elenacastro', 28),
    ((SELECT id_usuario FROM usuario WHERE correo = 'ricardo@hotmail.com'), 'ricardojuarez', 34),
	((SELECT id_usuario FROM usuario WHERE correo = 'ricardo@hotmail.com'), 'andresflores', 19),
	((SELECT id_usuario FROM usuario WHERE correo = 'ricardo@hotmail.com'), 'juandiaz', 22),
    ((SELECT id_usuario FROM usuario WHERE correo = 'marina@gmail.com'), 'marinanavarro', 30),
	((SELECT id_usuario FROM usuario WHERE correo = 'marina@gmail.com'), 'carloshernandez', 25),
    ((SELECT id_usuario FROM usuario WHERE correo = 'adrian@hotmail.com'), 'adriansoto', 29);

INSERT INTO resena (comentario, calificacion) VALUES
    ("Muy buena", 8),
    ("De lo mejor que he visto", 9),
    ("Que mala", 4),
    ("10/10", 10),
    ("God", 10),
    ("Pesima", 0),
    ("De lo peor", 1),
    ("La he visto 1000 veces", 10),
    ("No la volveria a ver", 5),
    ("Perdida de tiempo", 3);

INSERT INTO interaccion (id_perfil, id_resena, id_contenido) VALUES
    ((SELECT id_perfil FROM perfil WHERE username = 'miguelhernandez'),
    (SELECT id_resena FROM resena WHERE comentario = 'Muy buena'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
    ((SELECT id_perfil FROM perfil WHERE username = 'sofiagonzalez'),
    (SELECT id_resena FROM resena WHERE comentario = '10/10'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
    ((SELECT id_perfil FROM perfil WHERE username = 'diegofernandez'),
    (SELECT id_resena FROM resena WHERE comentario = 'God'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Game of Thrones')),
    ((SELECT id_perfil FROM perfil WHERE username = 'luisasanchez'),
    (SELECT id_resena FROM resena WHERE comentario = 'La he visto 1000 veces'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker')),
    ((SELECT id_perfil FROM perfil WHERE username = 'davidvargas'),
    (SELECT id_resena FROM resena WHERE comentario = 'De lo mejor que he visto'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Friends')),
    ((SELECT id_perfil FROM perfil WHERE username = 'valeriadiaz'),
    (SELECT id_resena FROM resena WHERE comentario = 'Pesima'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker'));