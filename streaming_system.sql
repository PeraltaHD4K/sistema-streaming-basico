DROP DATABASE IF EXISTS streaming_system;
CREATE DATABASE streaming_system;
USE streaming_system;


CREATE TABLE cuenta (
  id_cuenta INTEGER NOT NULL AUTO_INCREMENT,
  propietario CHAR(128) DEFAULT NULL,
  plan CHAR(64) NOT NULL,
  correo CHAR(128) NOT NULL,
  contrasena CHAR(128) NOT NULL,
  PRIMARY KEY(id_cuenta)
);

CREATE TABLE usuario (
    id_usuario INTEGER NOT NULL AUTO_INCREMENT,
    id_cuenta INTEGER NOT NULL,
    nombre CHAR(128) DEFAULT NULL,
    edad SMALLINT(2) DEFAULT NULL,
    PRIMARY KEY(id_usuario),
    FOREIGN KEY(id_cuenta) REFERENCES cuenta(id_cuenta) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE categoria (
    id_categoria INTEGER NOT NULL AUTO_INCREMENT,
    nombre CHAR(128) DEFAULT NULL,
    PRIMARY KEY(id_categoria)
);


CREATE TABLE contenido (
    id_contenido INTEGER NOT NULL AUTO_INCREMENT,
    id_categoria INTEGER NOT NULL,
    titulo CHAR(255) DEFAULT NULL,
    tipo CHAR(16) DEFAULT NULL,
    clasificacion CHAR(8) DEFAULT NULL,
    PRIMARY KEY(id_contenido),
    FOREIGN KEY(id_categoria) REFERENCES categoria(id_categoria) ON DELETE NO ACTION
);


CREATE TABLE resena (
    id_resena INT NOT NULL AUTO_INCREMENT,
    comentario CHAR(255) DEFAULT NULL,
    calificacion SMALLINT(2) DEFAULT NULL,
    PRIMARY KEY(id_resena)
);

CREATE TABLE interaccion(
    id_interaccion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INTEGER NOT NULL,
    id_resena INT,
    id_contenido INTEGER NOT NULL,
    fecha_interaccion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_resena) REFERENCES resena(id_resena) ON DELETE SET NULL,
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) 
);

CREATE TABLE pelicula (
    id_pelicula INTEGER NOT NULL AUTO_INCREMENT,
    id_contenido INTEGER NOT NULL,
    duracion SMALLINT(3) DEFAULT NULL,
    PRIMARY KEY(id_pelicula),
    FOREIGN KEY(id_contenido) REFERENCES contenido(id_contenido) ON DELETE RESTRICT
);

CREATE TABLE serie (
    id_serie INTEGER NOT NULL AUTO_INCREMENT,
    id_contenido INTEGER NOT NULL,
    temporadas SMALLINT(3) DEFAULT NULL,
    capitulos SMALLINT(4) DEFAULT NULL,
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

INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Titanic', 'Pelicula', 'PG-13' FROM categoria WHERE nombre='Drama';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Matrix', 'Pelicula', 'M' FROM categoria WHERE nombre='Accion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Interstellar', 'Pelicula', 'PG-13' FROM categoria WHERE nombre='Ciencia ficcion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Better call Saul', 'Serie', 'M' FROM categoria WHERE nombre='Crimen';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Chernobyl', 'Serie', 'M' FROM categoria WHERE nombre='Historico';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Game of Thrones', 'Serie', 'Ao' FROM categoria WHERE nombre='Accion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Stranger Things', 'Serie', 'T' FROM categoria WHERE nombre='Ciencia ficcion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'The Office', 'Serie', 'PG-13' FROM categoria WHERE nombre='Comedia';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Oppenheimer', 'Pelicula', 'Ao' FROM categoria WHERE nombre='Historico';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Wall-e', 'Pelicula', 'E' FROM categoria WHERE nombre='Ciencia ficcion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Friends', 'Serie', 'T' FROM categoria WHERE nombre='Comedia';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Black mirror', 'Serie', 'M' FROM categoria WHERE nombre='Ciencia ficcion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Joker', 'Pelicula', 'M' FROM categoria WHERE nombre='Drama';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Pulp fiction', 'Pelicula', 'Ao' FROM categoria WHERE nombre='Crimen';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Terminator', 'Pelicula', 'T' FROM categoria WHERE nombre='Accion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Back to the future', 'Pelicula', 'E' FROM categoria WHERE nombre='Ciencia ficcion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Dr. House', 'Serie', 'T' FROM categoria WHERE nombre='Medico';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Breaking bad', 'Serie', 'M' FROM categoria WHERE nombre='Crimen';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Hunter x Hunter', 'Serie', 'PG-13' FROM categoria WHERE nombre='Accion';
INSERT INTO contenido(id_categoria, titulo, tipo, clasificacion) SELECT id_categoria, 'Whiplash', 'Pelicula', 'PG' FROM categoria WHERE nombre='Drama';

INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 194 FROM contenido WHERE titulo = 'Titanic';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 136 FROM contenido WHERE titulo = 'Matrix';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 169 FROM contenido WHERE titulo = 'Interstellar';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 180 FROM contenido WHERE titulo = 'Oppenheimer';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 98 FROM contenido WHERE titulo = 'Wall-e';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 122 FROM contenido WHERE titulo = 'Joker';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 154 FROM contenido WHERE titulo = 'Pulp Fiction';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 107 FROM contenido WHERE titulo = 'Terminator';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 116 FROM contenido WHERE titulo = 'Back to the future';
INSERT INTO pelicula (id_contenido, duracion) SELECT id_contenido, 107 FROM contenido WHERE titulo = 'Whiplash';

INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 6, 63 FROM contenido WHERE titulo = 'Better Call Saul';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 1, 5 FROM contenido WHERE titulo = 'Chernobyl';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 8, 73 FROM contenido WHERE titulo = 'Game of Thrones';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 4, 34 FROM contenido WHERE titulo = 'Stranger Things';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 9, 201 FROM contenido WHERE titulo = 'The Office';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 10, 236 FROM contenido WHERE titulo = 'Friends';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 6, 27 FROM contenido WHERE titulo = 'Black mirror';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 8, 177 FROM contenido WHERE titulo = 'Dr. House';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 5, 62 FROM contenido WHERE titulo = 'Breaking bad';
INSERT INTO serie (id_contenido, temporadas, capitulos) SELECT id_contenido, 5, 148 FROM contenido WHERE titulo = 'Hunter x Hunter';

INSERT INTO cuenta (propietario, plan, correo) VALUES
    ('Juan Perez', 'Estandar con anuncios', 'juanperez123@gmail.com'),
    ('Maria Rodriguez', 'Basico', 'maria.rodriguez45@hotmail.com'),
    ('Luis Gonzalez', 'Estandar', 'luis.gonzalez56@gmail.com'),
    ('Ana Martinez', 'Premium', 'ana.martinez12@outlook.com'),
    ('Pedro Garcia', 'Estandar con anuncios', 'pedro.garcia89@hotmail.com'),
    ('Laura Lopez', 'Basico', 'laura.lopez34@gmail.com'),
    ('Carlos Sanchez', 'Estandar', 'carlos.sanchez67@hotmail.com'),
    ('Sofia Diaz', 'Premium', 'sofia.diaz78@outlook.com'),
    ('Diego Torres', 'Estandar con anuncios', 'diego.torres90@gmail.com'),
    ('Isabella Ramirez', 'Basico', 'isabella.ramirez12@hotmail.com'),
    ('Andres Fernandez', 'Estandar', 'andres.fernandez34@gmail.com'),
    ('Valentina Herrera', 'Premium', 'valentina.herrera56@outlook.com'),
    ('Mateo Castro', 'Estandar con anuncios', 'mateo.castro78@gmail.com'),
    ('Camila Gonzalez', 'Basico', 'camila.gonzalez90@hotmail.com'),
    ('Javier Silva', 'Estandar', 'javier.silva12@gmail.com'),
    ('Mariana Rios', 'Premium', 'mariana.rios34@outlook.com'),
    ('Daniel Paredes', 'Estandar con anuncios', 'daniel.paredes56@gmail.com'),
    ('Lucia Torres', 'Basico', 'lucia.torres67@hotmail.com'),
    ('Eduardo Mendoza', 'Estandar', 'eduardo.mendoza12@gmail.com'),
    ('Valeria Navarro', 'Premium', 'valeria.navarro34@outlook.com');

INSERT INTO usuario (id_cuenta, nombre, edad) 
    SELECT id_cuenta, propietario, 24 FROM cuenta;

INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Juan Hernandez', 25 FROM cuenta WHERE propietario = 'Ana Martinez';
INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Mauricio Flores', 19 FROM cuenta WHERE propietario = 'Ana Martinez';
INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Alberto Miranda', 30 FROM cuenta WHERE propietario = 'Ana Martinez';
INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Guadalupe Hernandez', 35 FROM cuenta WHERE propietario = 'Sofia Diaz';
INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Antonio Rojas', 16 FROM cuenta WHERE propietario = 'Sofia Diaz';
INSERT INTO usuario (id_cuenta, nombre, edad)
    SELECT id_cuenta, 'Sebastin Sandoval', 23 FROM cuenta WHERE propietario = 'Sofia Diaz';

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

INSERT INTO interaccion (id_usuario, id_resena, id_contenido) VALUES
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Ana Martinez'),
    (SELECT id_resena FROM resena WHERE comentario = 'Muy buena'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Sofia Diaz'),
    (SELECT id_resena FROM resena WHERE comentario = '10/10'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Oppenheimer')),
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Juan Hernandez'),
    (SELECT id_resena FROM resena WHERE comentario = 'God'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Game of Thrones')),
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Alberto Miranda'),
    (SELECT id_resena FROM resena WHERE comentario = 'La he visto 1000 veces'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker')),
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Guadalupe Hernandez'),
    (SELECT id_resena FROM resena WHERE comentario = 'De lo mejor que he visto'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Friends')),
    ((SELECT id_usuario FROM usuario WHERE nombre = 'Javier Silva'),
    (SELECT id_resena FROM resena WHERE comentario = 'Pesima'),
    (SELECT id_contenido FROM contenido WHERE titulo = 'Joker'));