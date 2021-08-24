delimiter $$
drop procedure if exists `spListarClientes`$$
create procedure spListarClientes(in _id int(10), in _nombre varchar(50), in _apellido varchar(50), in _email varchar(50), in _idGrupo int(10)) begin
select 
    c.id as idCliente, 
    c.nombre as nombreCliente, 
    c.apellido as apellidoCliente, 
    c.email as emailCliente,
    g.id as idGrupoCliente,
    g.nombre as nombreGrupoCliente,
    c.observaciones as observacionesCliente
    from clientes c 
    join grupo_clientes g 
    on c.grupo_cliente = g.id
    where
        (_id is null or _id = c.id)
        and ((length(_nombre) = 0 or lower(c.nombre) like concat('%', lower(_nombre), '%'))
        or (length(_apellido) = 0 or lower(c.apellido) like concat('%', lower(_apellido), '%'))
        or (length(_email) = 0 or lower(c.email) like concat('%', lower(_email), '%')))
        and (_idGrupo is null or c.grupo_cliente = _idGrupo)
        and c.estado = 1

       
  
;
end$$

drop procedure if exists `spListarGrupoClientes`$$
create procedure spListarGrupoClientes(in _id int(10), in _nombre varchar(50)) begin

select id, nombre
    from grupo_clientes
    where id = _id 
    and estado = 1
union all

select id, nombre
    from grupo_clientes
    where 
            lower(nombre) like concat('%', lower(_nombre), '%')
            and estado = 1;
end$$

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