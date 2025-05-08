create database abarrotes;
use abarrotes;
CREATE TABLE tb_rol (

  id_rol INT AUTO_INCREMENT PRIMARY KEY,

  nombre_rol VARCHAR(20) NOT NULL UNIQUE

) ENGINE=InnoDB;
INSERT INTO tb_rol (nombre_rol) VALUES 

('Dueños'), 

('Administrador');


create table tb_usuario (
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

('Kiara', 'Ramirez', 'Kiara', '1234', '987654321', 1, 1), 

('María', 'Gómez', 'admin', 'adminpassword', '912345678', 2, 1);
CREATE TABLE clientes (
    dni INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion varchar(100),
    correo VARCHAR(100)
);

CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE productos (
    id_producto INT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion varchar(30),
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

CREATE TABLE metodos_pago (
    id_metodo_pago INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);
CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    dni INT,
    fecha DATE NOT NULL,
    total DECIMAL(10,2),
    id_metodo_pago INT,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    FOREIGN KEY (dni) REFERENCES clientes(dni),
    FOREIGN KEY (id_metodo_pago) REFERENCES metodos_pago(id_metodo_pago)
);
CREATE TABLE detalle_venta (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    id_producto INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);