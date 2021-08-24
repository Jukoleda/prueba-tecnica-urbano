delimiter $$
drop procedure if exists `spAgregarClientes`$$
create procedure spAgregarClientes(in nombre varchar(50), in apellido varchar(50), in email varchar(50), in idGrupo int(10), in observaciones varchar(50)) begin
    insert into clientes values(null, nombre, apellido, email, idGrupo, observaciones, default);
    select last_insert_id() as idCliente;
end$$
delimiter ;