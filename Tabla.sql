-- Base de datos para Juegos de rol de mesa

-- Primera tabla para los generos

CREATE TABLE IF NOT EXISTS generos (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Valores de la tabla generos

INSERT INTO generos (id, nombre) VALUES 
(1, 'Acción'),
(2, 'Aventura'),
(3, 'Social'),
(4, 'Terror');

-- Segunda tabla para las ambientaciones

CREATE TABLE IF NOT EXISTS ambientaciones (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Valores de la tabla ambientaciones

INSERT INTO ambientaciones (id, nombre) VALUES 
(1, 'Medieval'),
(2, 'Fantasia'),
(3, 'Actualidad'),
(4, 'Futurista');

-- Tabla de usuarios para ingresar

CREATE TABLE IF NOT EXISTS usuarios (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre_usuario varchar(45) NOT NULL,
  clave varchar(255) NOT NULL,
  nombre varchar(200) NOT NULL,
  apellido varchar(200) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY usuario (nombre_usuario)
) ENGINE=InnoDB;

-- Insertamos un usuario: nombre de usuario: Quintel - Clave: 1234 (encriptada)
INSERT INTO usuarios (nombre_usuario, clave, nombre, apellido)
VALUES ('Quintel','$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO',
        'Quintel','Hashiri');


-- Tabla principal: Sistemas de juegos

CREATE TABLE IF NOT EXISTS juegos ( 
id INT(10) unsigned NOT NULL AUTO_INCREMENT,
nombre varchar(45) NOT NULL,
descripcion varchar(255) NOT NULL,
id_genero INT(10) unsigned NOT NULL,
id_ambientacion INT(10) unsigned NOT NULL,
id_usuario INT(10) unsigned NOT NULL,
PRIMARY KEY(id),
UNIQUE KEY modulo (nombre),
FOREIGN KEY (id_genero)
	REFERENCES generos(id),
FOREIGN KEY (id_ambientacion)
	REFERENCES ambientaciones(id),
FOREIGN KEY (id_usuario)
	REFERENCES usuarios(id)
) ENGINE=InnoDB CHARSET=utf8;

-- Valores de la tabla juegos

INSERT INTO juegos (id, nombre, descripcion, id_genero, id_ambientacion, id_usuario) VALUES
(1, 'Dungeons and Dragons', 'El sistema más conocido a la hora de hablar de juegos de rol de mesa, basado en dados de 20 caras, vive una aventura medieval fantastica llena de acción', 2, 2, 1),
(2, 'Musu musu Musume!?', 'Un sistema basado en los videojuegos y novelas de romance, donde nuestro objetivo es llevarnos el corazón de aquella persona que tanto nos gusta', 3, 3, 1),
(3, 'Cultos innombrables', 'En un mundo donde el terror eldrico es una realidad, tienen que investigar para sacar a la luz todos los secretos de un oscuro mundo lleno de terrores invisibles', 4, 3, 1); 