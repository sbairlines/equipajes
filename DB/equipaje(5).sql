-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-07-2015 a las 17:49:41
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `equipaje`
--
CREATE DATABASE IF NOT EXISTS `equipaje` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `equipaje`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_equipaje`
--

CREATE TABLE IF NOT EXISTS `control_equipaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vuelo` varchar(5) CHARACTER SET utf8 NOT NULL,
  `dqf` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario_pt1` int(11) NOT NULL,
  `id_usuario_pt2` int(11) NOT NULL,
  `id_usuario_pt3` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de encabezado ' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `control_equipaje`
--

INSERT INTO `control_equipaje` (`id`, `vuelo`, `dqf`, `fecha`, `id_usuario_pt1`, `id_usuario_pt2`, `id_usuario_pt3`, `id_usuario`) VALUES
(4, '1516', 1, '2015-07-09 14:02:38', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_equipaje`
--

CREATE TABLE IF NOT EXISTS `detalle_equipaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_punto_control` int(11) NOT NULL,
  `id_control` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `bar_tag` varchar(12) CHARACTER SET latin1 NOT NULL,
  `cod_iata` varchar(4) DEFAULT NULL,
  `dqf` varchar(12) DEFAULT NULL,
  `leido` int(11) NOT NULL,
  `estatus` int(1) NOT NULL COMMENT '0.- Cerrado 1.- Abierto',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_punto_control` (`id_punto_control`,`id_control`,`bar_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `detalle_equipaje`
--

INSERT INTO `detalle_equipaje` (`id`, `id_usuario`, `id_punto_control`, `id_control`, `fecha`, `bar_tag`, `cod_iata`, `dqf`, `leido`, `estatus`) VALUES
(6, 1, 1, 4, '2015-07-08 13:22:24', '003249865679', 'rd26', NULL, 1, 1),
(7, 1, 1, 4, '2015-07-08 13:22:24', '003249865677', 'gr36', NULL, 1, 1),
(10, 1, 3, 4, '2015-07-08 14:03:54', '003249865679', NULL, '1414', 1, 1),
(12, 1, 3, 4, '2015-07-08 14:08:16', '003249865677', NULL, '1414', 1, 1),
(14, 1, 1, 5, '2015-07-08 17:42:28', '101010101010', 'rd12', NULL, 1, 1),
(15, 1, 1, 5, '2015-07-08 17:42:29', '101010101011', 'rd12', NULL, 1, 1),
(16, 1, 2, 5, '2015-07-08 17:43:09', '101010101010', '', NULL, 1, 1),
(17, 1, 2, 5, '2015-07-08 17:43:09', '101010101011', '', NULL, 1, 1),
(18, 1, 2, 5, '2015-07-08 17:43:09', '101010101012', '', NULL, 1, 1),
(19, 1, 2, 4, '2015-07-09 15:27:40', '003249865679', '', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inconsistencias`
--

CREATE TABLE IF NOT EXISTS `inconsistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vuelo` varchar(5) NOT NULL,
  `id_control` int(11) NOT NULL,
  `id_punto_control` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `detalle` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `inconsistencias`
--

INSERT INTO `inconsistencias` (`id`, `vuelo`, `id_control`, `id_punto_control`, `id_usuario`, `fecha`, `descripcion`, `detalle`) VALUES
(1, '1526', 4, 2, 1, '2015-07-09 15:02:44', 'Existe una inconsistencia de 2 equipajes faltantes con Counter.', '003249865677\n003249865679'),
(2, '1516', 4, 2, 1, '2015-07-09 15:27:44', 'Existe una inconsistencia de 1 equipajes faltantes con Counter.', '003249865677'),
(3, '1516', 4, 2, 1, '2015-07-09 15:28:39', 'Existe una inconsistencia de 1 equipajes faltantes con Counter.', '003249865677'),
(4, '1516', 4, 2, 1, '2015-07-09 15:31:54', 'Existe una inconsistencia de 1 equipajes faltantes con Counter.', '003249865677');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos_controles`
--

CREATE TABLE IF NOT EXISTS `puntos_controles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `orden` int(11) NOT NULL,
  `id_sitio` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `puntos_controles`
--

INSERT INTO `puntos_controles` (`id`, `nombre`, `orden`, `id_sitio`) VALUES
(1, 'Counter', 1, 1),
(2, 'Correa', 2, 1),
(3, 'Avion/RX', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema`
--

CREATE TABLE IF NOT EXISTS `sistema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(200) NOT NULL,
  `valor` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `sistema`
--

INSERT INTO `sistema` (`id`, `parametro`, `valor`) VALUES
(1, 'nombre_sistema', 'Sistema de seguridad de equipajes'),
(2, 'cliente', 'SbAirlines');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE IF NOT EXISTS `sitios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`id`, `nombre`) VALUES
(1, 'Maiquetia'),
(2, 'Miami');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod_trabajador` varchar(4) NOT NULL,
  `id_sitio` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `tipo` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cod_trabajador`, `id_sitio`, `nombre`, `login`, `clave`, `tipo`, `estatus`) VALUES
(1, '0001', 1, 'Jorge Peraza', 'jperaza', '1234', 1, 0),
(2, '0002', 1, 'Juan Carlos Nunes', 'jcnunes', '1234', 0, 0),
(3, '', 1, 'Marquiel', 'mgonzalez', '1234', 0, 0),
(4, '0004', 1, 'David Castellanos', 'dcastellanos', 'dcastellanos', 1, 0),
(5, '', 1, 'David Enrique Rodriguez Carvajal', 'drodriguez', 'hemlsi89', 1, 0),
(6, '', 1, 'Juan Antonio Blanco Bautista', 'jblanco', 'jsalim43', 1, 0),
(7, '', 1, 'Juan Carlo Laventiur Salazar', 'jlaventiur', 'ncgwpa30', 1, 0),
(8, '', 1, 'Joaquin Alfredo Rodriguez', 'jrodriguez', 'dkoytb71', 1, 0),
(9, '', 1, 'Jesus Antonio Salazar Salazar', 'jsalazar', 'hcxoqa04', 1, 0),
(10, '', 1, 'Eliecer Enrique Sivira Aleman', 'esivira', 'kfunme82', 0, 0),
(11, '', 1, 'Leoraima Leonelsy Palma Pacheco', 'lpalma', 'hfgsxz43', 0, 0),
(12, '', 1, 'Bianka Nathaly Ruiz', 'bruiz', 'opiney29', 0, 0),
(13, '', 1, 'Miguel Alexander Almanzor Sulbaran', 'malmanzor', 'qwebnm24', 0, 0),
(14, '', 1, 'Andera Edelmira Chinchilla Henriquez', 'achinchilla', 'rfvcde19', 0, 0),
(15, '', 1, 'Maryuris Gertrudis Garcia Palma', 'mgarcia', 'plmxdr55', 0, 0),
(16, '', 1, 'Deyra Angelica Soto Rivero', 'dsoto', 'tyucvb83', 0, 0),
(17, '', 1, 'Johnny Dernier Rodriguez Mayora', 'jorodriguez', 'vghnjm27', 0, 0),
(18, '', 1, 'Solangel Isabel Romero Sifonte', 'sromero', 'sdfjkl12', 0, 0),
(19, '', 1, 'Norysis Aracelis Pinango Ramirez', 'npinango', 'gyudrt61', 0, 0),
(20, '', 1, 'Beatriz Carolina Patino Marval ', 'bpatino', 'mkawep09', 0, 0),
(21, '', 1, 'Alisvi Cleidy Martinez Rodriguez', 'amartinez', 'tgxlkq67', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE IF NOT EXISTS `vuelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `estatus` int(1) NOT NULL COMMENT '0.-Activo 1.- Inactivo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`id`, `nombre`, `estatus`) VALUES
(1, '1515', 0),
(2, '1521', 0),
(3, '1525', 0),
(4, '1516', 0),
(5, '1520', 0),
(6, '1526', 0),
(7, '1340', 0),
(8, '1341', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
