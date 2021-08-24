delimiter $$
drop procedure if exists `spModificarClientes`$$
create procedure spModificarClientes(in id int(10), in nombre varchar(50), in apellido varchar(50), in email varchar(50), in idGrupo int(10), in observaciones varchar(50), in estado boolean) begin
    update clientes
        set
            clientes.nombre = nombre,
            clientes.apellido = apellido,
            clientes.email = email,
            clientes.grupo_cliente = idGrupo,
            clientes.observaciones = observaciones,
            clientes.estado = estado
            where
                clientes.id=id;
    select id as idCliente;
end$$
delimiter ;