delimiter $$
drop procedure if exists `spAgregarGrupoClientes`$$
create procedure spAgregarGrupoClientes(in nombre varchar(50)) begin
    insert into grupo_clientes values(null, nombre, default);
    select last_insert_id() as idGrupoCliente;
end$$
delimiter ;