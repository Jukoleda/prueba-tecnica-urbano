delimiter $$
drop procedure if exists `spModificarGrupoClientes`$$
create procedure spModificarGrupoClientes(in id int(10), in nombre varchar(50), in estado boolean) begin
    update grupo_clientes
        set
            grupo_clientes.nombre = nombre,
            grupo_clientes.estado = estado
            where
                grupo_clientes.id=id;
    select id as idGrupoCliente;

end$$
delimiter ;