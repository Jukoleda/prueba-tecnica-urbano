-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-08-2021 a las 22:19:02
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `urbano_db`
--
CREATE DATABASE IF NOT EXISTS `urbano_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `urbano_db`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `spAgregarClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAgregarClientes` (IN `nombre` VARCHAR(50), IN `apellido` VARCHAR(50), IN `email` VARCHAR(50), IN `idGrupo` INT(10), IN `observaciones` VARCHAR(50))  begin
    insert into clientes values(null, nombre, apellido, email, idGrupo, observaciones, default);
    select last_insert_id() as idCliente;
end$$

DROP PROCEDURE IF EXISTS `spAgregarGrupoClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAgregarGrupoClientes` (IN `nombre` VARCHAR(50))  begin
    insert into grupo_clientes values(null, nombre, default);
    select last_insert_id() as idGrupoCliente;
end$$

DROP PROCEDURE IF EXISTS `spListarClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarClientes` (IN `_id` INT(10), IN `_nombre` VARCHAR(50), IN `_apellido` VARCHAR(50), IN `_email` VARCHAR(50), IN `_idGrupo` INT(10))  begin
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

DROP PROCEDURE IF EXISTS `spListarGrupoClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spListarGrupoClientes` (IN `_id` INT(10), IN `_nombre` VARCHAR(50))  begin

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

DROP PROCEDURE IF EXISTS `spModificarClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarClientes` (IN `id` INT(10), IN `nombre` VARCHAR(50), IN `apellido` VARCHAR(50), IN `email` VARCHAR(50), IN `idGrupo` INT(10), IN `observaciones` VARCHAR(50), IN `estado` BOOLEAN)  begin
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

DROP PROCEDURE IF EXISTS `spModificarGrupoClientes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `spModificarGrupoClientes` (IN `id` INT(10), IN `nombre` VARCHAR(50), IN `estado` BOOLEAN)  begin
    update grupo_clientes
        set
            grupo_clientes.nombre = nombre,
            grupo_clientes.estado = estado
            where
                grupo_clientes.id=id;
    select id as idGrupoCliente;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `apellido` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `grupo_cliente` int(11) NOT NULL,
  `observaciones` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_clientes_grupo_clientes` (`grupo_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `grupo_cliente`, `observaciones`, `estado`) VALUES
(1, 'Dario', 'Fernandez', 'dario.fernandez@correo.com', 3, '0', 1),
(2, 'Micaela', 'Fernandez', 'micaela.fernandez@correo.com', 2, '', 1),
(3, 'Alberto', 'Dominguez', 'alberto.dominguez@correo.com', 1, '', 1),
(4, 'Aldo', 'Barraza', 'aldo.barraza@correo.com', 1, '', 1),
(5, 'Jose', 'Lopez', 'jose.lopez@correo.com', 2, '', 1),
(6, 'Jaime', 'Altozano', 'jaime.altozano@correo.com', 3, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_clientes`
--

DROP TABLE IF EXISTS `grupo_clientes`;
CREATE TABLE IF NOT EXISTS `grupo_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `grupo_clientes`
--

INSERT INTO `grupo_clientes` (`id`, `nombre`, `estado`) VALUES
(1, 'Grupo A', 1),
(2, 'Grupo B', 1),
(3, 'Grupo C', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
