-- base de datos para la evaluacion tecnica Urbano
create database urbano_db character set utf8mb4 collate utf8mb4_bin;
use urbano_db;

create table clientes(
	id int not null auto_increment,
	nombre varchar(50) not null,
	apellido varchar(50) not null,
	email varchar(50) not null,
    grupo_cliente int not null,
	observaciones varchar(50) not null,
	estado boolean not null default 1,
	constraint pk_usuarios primary key(id),
    constraint fk_clientes_grupo_clientes foreign key (grupo_cliente) references grupo_clientes (id)
);

create table grupo_clientes(
	id int not null auto_increment,
	nombre varchar(50) not null,
	constraint pk_tipos_alojamientos primary key(id),
	estado boolean not null default 1
);

insert into grupo_clientes values (null, 'Grupo A', default)
,(null, 'Grupo B', default)
,(null, 'Grupo C', default);


insert into clientes values (null, 'Dario', 'Fernandez', 'dario.fernandez@correo.com', 1, '', default)
,(null, 'Micaela', 'Fernandez', 'micaela.fernandez@correo.com', 2, '', default)
,(null, 'Alberto', 'Dominguez', 'alberto.dominguez@correo.com', 1, '', default)
,(null, 'Aldo', 'Barraza', 'aldo.barraza@correo.com', 1, '', default)
,(null, 'Jose', 'Lopez', 'jose.lopez@correo.com', 2, '', default)
,(null, 'Jaime', 'Altozano', 'jaime.altozano@correo.com', 3, '', default);
