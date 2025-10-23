
create database crm2;
use crm2;
CREATE TABLE tb_rol ( -- listo 

  id_rol INT AUTO_INCREMENT PRIMARY KEY,

  nombre_rol VARCHAR(20) NOT NULL UNIQUE

) ENGINE=InnoDB;
INSERT INTO tb_rol (nombre_rol) VALUES 

('DueÃ±os'), 

('Gerente');


create table tb_usuario (-- listo 
    id_usuario int auto_increment primary key,
    nombre varchar(50) not null,
    apellido varchar(50) not null,
    usuario varchar(20) not null unique,
    password varchar(255) not null,
    telefono varchar(15) not null,
    id_rol int not null,
    estado tinyint(1) not null default 1,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp,
    foreign key (id_rol) references tb_rol(id_rol) on delete restrict on update cascade
) engine=innodb;

INSERT INTO tb_usuario (nombre, apellido, usuario, password, telefono, id_rol, estado) VALUES 

('andres', 'Ramirez', 'DueÃ±o', '1234', '987654321', 1, 1), 

('MarÃ­a', 'GÃ³mez', 'Gerente', '1234', '912345678', 2, 1);

create table clientes2 (-- listo 
    dni_cliente varchar(20) primary key,
    nombres_cliente varchar(100),
    apellidos_cliente varchar(100),
    correo_cliente varchar(100),
    telefono_cliente varchar(20),
    lugar_nacimiento varchar(100),
    fecha_nacimiento varchar(100),
    estado_civil varchar(100)
 
);
ALTER TABLE clientes2
ADD COLUMN fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP;

create table deseo2 (
    id_deseo int primary key auto_increment,
    dni_cliente varchar(20), -- puede ser null para deseos generales
    destino varchar(100),
    peso_indicador decimal(5,2),
    presupuesto_estimado decimal(10,2),
    tiempo_estimado varchar(50),
    foreign key (dni_cliente) references clientes2(dni_cliente)
);
create table experiencia2 (
    id_experiencia int primary key auto_increment,
    dni_cliente varchar(20),
    bien_adquirido varchar(100),
    calificacion int,
    rango_costo varchar(50),
    lugar varchar(100),
    descripcion text,
    tipo_de_viaje varchar(50),
    fecha_visita date,
    foreign key (dni_cliente) references clientes2(dni_cliente)
);
create table campaÃ±a2 (-- listo 
    id_campaÃ±a int primary key auto_increment,
    nombre_campaÃ±a varchar(100),
    descripcion text,
    fecha_inicio date,
    fecha_fin date
);
select * from encuestas2;

UPDATE encuestas2 SET puntos_encuesta = 10 WHERE id_encuesta = 4;
create table encuestas2 (-- listo 
    id_encuesta int primary key auto_increment,
    id_campaÃ±a int,
    nombre_encuesta varchar(100),
    descripcion text,
    fecha_creacion date,
    foreign key (id_campaÃ±a) references campaÃ±a2(id_campaÃ±a)
);
select * from preguntas2;
create table preguntas2 (-- listo 
    id_pregunta int primary key auto_increment,
    pregunta varchar(200)
);
select * from encuesta_pregunta2;
create table encuesta_pregunta2 (-- listo 
    id_encuesta int,
    id_pregunta int,
    primary key (id_encuesta, id_pregunta),
    foreign key (id_encuesta) references encuestas2(id_encuesta),
    foreign key (id_pregunta) references preguntas2(id_pregunta)
);
select * from respuestas2;
create table respuestas2 (
    id_respuesta int primary key auto_increment,
    id_encuesta int,
    id_pregunta int,
    dni_cliente varchar(20),
    respuesta varchar(200),
    fecha_respuesta date,
    foreign key (id_encuesta) references encuestas2(id_encuesta),
    foreign key (id_pregunta) references preguntas2(id_pregunta),
    foreign key (dni_cliente) references clientes2(dni_cliente)
);

create table interacciones2 (
    id_interaccion int primary key auto_increment,
    dni_cliente varchar(20),
    fecha date,
    canal varchar(50),
    descripcion text,
    foreign key (dni_cliente) references clientes2(dni_cliente)
);
CREATE TABLE promociones2 (
    id_promocion INT AUTO_INCREMENT PRIMARY KEY,
    descripcion TEXT NOT NULL, -- Aquí escribes todo el mensaje libremente
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO promociones2 (descripcion) VALUES 
('🎉 ¡Feliz San Valentín! ❤️ Disfruta de un 20% de descuento en paquetes románticos a Cusco del 10 al 15 de febrero. Reserva ya y sorprende a tu pareja 💕');

SELECT * FROM licencias;
select * from configuracion;


-- ======================================
-- 🧱 Tabla: licencias
-- ======================================
CREATE TABLE licencias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo_hash VARCHAR(255) NOT NULL,
  codigo_publico VARCHAR(100) NOT NULL,
  usado TINYINT(1) DEFAULT 0,
  activado_por VARCHAR(100) DEFAULT NULL,
  fecha_activacion DATETIME DEFAULT NULL,
  expiracion DATETIME DEFAULT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- 🧱 Tabla: configuracion
-- ======================================
CREATE TABLE configuracion (
  id INT AUTO_INCREMENT PRIMARY KEY,
  version_pro CHAR(1) DEFAULT 'N',
  licencia_id INT DEFAULT NULL,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_config_licencia FOREIGN KEY (licencia_id)
    REFERENCES licencias(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ======================================
-- 🔹 Registro inicial en configuración
-- ======================================
INSERT INTO configuracion (version_pro, licencia_id, updated_at)
VALUES ('N', NULL, NOW());

INSERT INTO licencias (codigo_hash, codigo_publico) 
VALUES ('$2y$10$...', 'PRO-123ABC');

INSERT INTO licencias (codigo_hash, codigo_publico, usado)
VALUES (
  '$2y$10$F5xq7FZ9mMNZ2IhHyqQkBe5G3tqKkJHfA1Re8rHnAMoZ0Dh5G1U2a',
  'PRO-123ABC',
  0
);
INSERT INTO licencias (codigo_hash, codigo_publico, usado)
VALUES ('$2y$10$G5Dk...etc...', 'PRO-Z0D13X', 0);

INSERT INTO licencias (codigo_hash, codigo_publico, usado)
VALUES (
  '$2y$10$4HyTE/GHloXVKCCtmACicuws.l8aiRDTjNbeqdW8VhBrjzWytWOWG',
  'PRO-9DD808',
  0
);
SELECT * FROM licencias;
select * from configuracion;
