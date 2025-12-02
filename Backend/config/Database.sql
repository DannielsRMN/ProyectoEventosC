create database proyecto_eventos_c;
use proyecto_eventos_c;

create table usuario(
	id_usuario int primary key auto_increment,
	nombre_completo varchar(100) not null,
	email varchar(100) not null unique,
    password_hash varchar(150) not null,
    rol varchar(150) default ('Cliente'),
    
    tarjeta varchar(16) null unique,
    fecha_vencimiento date null
);

create table sede(
	id_sede int primary key auto_increment,
    nombre varchar(100) not null,
    capacidad int not null,
    direccion varchar(150) not null
);

create table evento(
	id_evento int primary key auto_increment,
    id_cliente int,
    id_sede int,
    nombre_evento varchar(100) not null,
    fecha_evento date,
    hora_inicio time,
    hora_fin time,
    estado enum ('Borrador', 'Confirmado', 'Cancelado') default ('Borrador'),
    
    foreign key (id_cliente) references usuario(id_usuario),
    foreign key (id_sede) references sede(id_sede)
);

create table reserva(
	id_reserva int primary key auto_increment,
    id_evento int,
    fecha_reserva timestamp,
    costo_total decimal(10,2),
    monto_pagado decimal(10,2),
    estado_pago enum ('Pendiente', 'Parcial', 'Pagado') default ('Pendiente'),
    
    foreign key (id_evento) references evento(id_evento)
);

create table recurso(
	id_recurso int primary key auto_increment,
    nombre_recurso varchar(100),
    descripcion varchar(150),
    costounidad decimal(5,2),
    stock int
);

create table proveedor(
	id_proveedor int primary key auto_increment,
    nombre_contacto varchar(100),
    nombre_empresa varchar(150),
    direccion varchar(150),
    telefono varchar(12)
);

create table servicio(
	id_servicio int primary key auto_increment,
    id_proveedor int,
    nombre_servicio varchar(150),
    costo decimal(5,2),
    
    
    foreign key (id_proveedor) references proveedor(id_proveedor)
);

create table detalle_recurso(
	id_evento int,
    id_recurso int,
    cantidad int,
    
    primary key (id_evento, id_recurso),
    foreign key (id_evento) references evento(id_evento),
    foreign key (id_recurso) references recurso(id_recurso)
);

create table detalle_servicio(
	id_evento int,
    id_servicio int,
    
    primary key (id_evento, id_servicio),
    foreign key (id_evento) references evento(id_evento),
    foreign key (id_servicio) references servicio(id_servicio)
);