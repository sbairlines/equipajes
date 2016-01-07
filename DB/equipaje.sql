-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2015 a las 19:08:13
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
  `id_vuelo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de encabezado ' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `control_equipaje`
--

INSERT INTO `control_equipaje` (`id`, `id_vuelo`, `fecha`, `id_usuario`) VALUES
(1, 2, '2015-02-04 19:06:12', 1),
(2, 1, '2015-02-04 19:36:54', 1),
(3, 3, '2015-02-04 17:37:49', 2);

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
  `bar_tag` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cod_iata` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_punto_control` (`id_punto_control`,`bar_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `detalle_equipaje`
--

INSERT INTO `detalle_equipaje` (`id`, `id_usuario`, `id_punto_control`, `id_control`, `fecha`, `bar_tag`, `cod_iata`) VALUES
(11, 2, 1, 2, '0000-00-00 00:00:00', '1526100001', 'RD01'),
(13, 2, 1, 2, '0000-00-00 00:00:00', '1526100002', 'RD02'),
(14, 2, 1, 2, '0000-00-00 00:00:00', '1526100003', 'RD25'),
(15, 2, 1, 2, '0000-00-00 00:00:00', '1526100004', 'BL15'),
(16, 2, 1, 2, '0000-00-00 00:00:00', '1526100005', 'BL15'),
(17, 2, 1, 2, '0000-00-00 00:00:00', '1526100006', 'BL24'),
(18, 2, 1, 2, '0000-00-00 00:00:00', '1526100007', 'BL08'),
(19, 2, 1, 2, '0000-00-00 00:00:00', '1526100000', 'EF12'),
(20, 2, 1, 2, '0000-00-00 00:00:00', '1526100008', 'RD16'),
(21, 2, 1, 2, '0000-00-00 00:00:00', '1526200000', '1231'),
(22, 2, 1, 2, '0000-00-00 00:00:00', '1526200001', '1236'),
(23, 2, 1, 2, '0000-00-00 00:00:00', '1526200003', '1452'),
(24, 2, 1, 2, '0000-00-00 00:00:00', '1526200004', '1235'),
(25, 2, 1, 2, '0000-00-00 00:00:00', '1526200005', '1236'),
(26, 2, 1, 2, '0000-00-00 00:00:00', '1526200006', '1523'),
(27, 2, 1, 2, '0000-00-00 00:00:00', '1526200007', '1231'),
(28, 2, 1, 2, '0000-00-00 00:00:00', '1526200008', '1235'),
(29, 2, 1, 2, '0000-00-00 00:00:00', '1526200009', '2131'),
(30, 2, 1, 2, '0000-00-00 00:00:00', '1526300000', '2135'),
(31, 2, 1, 2, '0000-00-00 00:00:00', '1526300020', '1235'),
(32, 2, 1, 2, '0000-00-00 00:00:00', '1526300200', 'fs12'),
(33, 2, 1, 2, '0000-00-00 00:00:00', '1526485696', '5235'),
(34, 2, 1, 2, '0000-00-00 00:00:00', '1526800000', 'po15'),
(35, 2, 1, 1, '0000-00-00 00:00:00', '1527100001', 'Rd09'),
(36, 2, 1, 1, '0000-00-00 00:00:00', '1527100002', 'rd08'),
(37, 1, 2, 2, '0000-00-00 00:00:00', '1526500020', 'po82'),
(38, 1, 2, 2, '0000-00-00 00:00:00', '1526300001', 'RD82'),
(39, 1, 2, 2, '0000-00-00 00:00:00', '1526888888', 'Rd08');

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
(3, 'Avion', 3, 1);

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
  `id_sitio` int(11) NOT NULL,
  `id_punto_control` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `clave` varchar(250) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_sitio`, `id_punto_control`, `nombre`, `login`, `clave`, `estatus`) VALUES
(1, 1, 2, 'Jorge Peraza', 'jperaza', '1234', 1),
(2, 1, 1, 'Juan Carlos Nunes', 'jcnunes', '1234', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelos`
--

CREATE TABLE IF NOT EXISTS `vuelos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `periodicos` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `vuelos`
--

INSERT INTO `vuelos` (`id`, `nombre`, `periodicos`) VALUES
(1, '1526', 0),
(2, '1527', 0),
(3, '1528', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
