drop database if exists biblioteca;
create database biblioteca;
use biblioteca;

create table usuarios(
	id varchar(9) primary key,
    ps blob not null,
    tipo enum ('A','S') not null -- A para Admin y S para Socios
)engine innodb;

insert into usuarios values('admin',sha2('admin',512),'A'),
('11111111A',sha2('11111111A',512),'S'),
('22222222A',sha2('22222222A',512),'S'),
('33333333A',sha2('33333333A',512),'S'),
('44444444A',sha2('44444444A',512),'S'),
('55555555A',sha2('55555555A',512),'S');

create table socios(
	id int auto_increment primary key,
    nombre varchar(100) not null,
    fechaSancion date default null,
    email varchar(255) not null,
    us varchar(9) not null unique,
    foreign key (us) references usuarios(id) on update cascade on delete restrict
)engine innodb;

create table libros(
	id int auto_increment primary key,
    titulo varchar(100) not null,
    ejemplares int not null,
    autor varchar(100)
)engine innodb;

insert into socios values (null,'Carlos Diaz',null,'carlos@gmail.com','11111111A'),
(null,'Marta Sanchez',null,'marta@gmail.com','22222222A'),
(null,'Lucas Lopez',null,'lucas@gmail.com','33333333A'),
(null,'Raúl Garcia',null,'raul@gmail.com','44444444A'),
(null,'Ana Martin','2024-12-31','ana@gmail.com','55555555A');

insert into libros values (null,'La sombra del viento','0','Carlos Ruíz Zafón'),
(null,'El Quijote','12','Cervantes'),
(null,'Redes','5','Eloy Moreno'),
(null,'Invisible','10','Eloy Moreno'),
(null,'Terra Alta','3','Javier Cercas');

create table prestamos(
	id int auto_increment primary key,
    socio int not null,
    libro int not null,
    fechaP date not null, -- Fecha Prestamo 
    fechaD date not null, -- Fecha Devolucion
    fechaRD date null default null, -- Fecha Real de devolucion
    foreign key (socio) references socios(id) on update cascade on delete restrict,
    foreign key (libro) references libros(id) on update cascade on delete restrict
)engine innodb;

insert into prestamos values (null,1,1,20230101,20230115,null),
(null,2,1,20230101,20230115,20230110),
(null,2,3,2040901,20241031,null),
(null,2,1,20240901,20241031,null),
(null,3,3,20240901,20241031,null);

-- Funcion que comprueba si se puede prestar el libro al socio
-- Devuelve:
-- 1:Si se puede hacer el prestamo
-- -1:Si no hay ejemplares del libro
-- -2:Si el socio está sancionado
-- -3:Si el socio tiene prestamos caducados
-- -4:Si el socio tiene más de 2 libros prestados

delimiter //
	create function comprobarSiPrestar(pSocio int, pLibro int) returns int deterministic
    begin
		declare resultado int default 1;
        declare vId int;
        
        -- Comprobar ejemplares
        select id into vId from libros
			where id = pLibro and ejemplares > 0;
        if(vId is null)then
			return -1;
		end if;
        
        -- Comprobar socio
        set vId = null;
        select id into vId from socios
			where id = pSocio and (fechaSancion is null or fechaSancion < curdate());
		if(vId is null) then
			return -2;
		end if;
        
        -- Chequear si el socio tiene prestamos caducados
        select count(*) into vId from prestamos
			where socio = pSocio and fechaD < curdate() and fechaRD is null;
		if(vId > 0) then
			return -3;
		end if;
        
        -- Chequear si tiene mas de 2 libros prestados
		select count(*) into vId from prestamos
			where socio = pSocio and fechaRD is null;
		if(vId >= 2) then
			return -4;
		end if;
            
        return resultado;
    end//
delimiter ;

select comprobarSiPrestar(5,1);  -- Chequea ejemplares
select comprobarSiPrestar(5,2);  -- Chequea ejemplares
select comprobarSiPrestar(5,100);  -- Chequea ejemplares
select comprobarSiPrestar(50,2);
select comprobarSiPrestar(1,2);
select comprobarSiPrestar(5,100);
