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
delimiter ;