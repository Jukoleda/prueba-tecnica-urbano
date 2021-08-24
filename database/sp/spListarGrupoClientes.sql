delimiter $$
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
delimiter ;


