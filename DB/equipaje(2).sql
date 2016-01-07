-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-04-2015 a las 22:40:28
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
  `dqf` tinyint(4) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de encabezado ' AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `control_equipaje`
--

INSERT INTO `control_equipaje` (`id`, `id_vuelo`, `dqf`, `fecha`, `id_usuario`) VALUES
(9, 1, 1, '2015-04-24 15:01:31', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `detalle_equipaje`
--

INSERT INTO `detalle_equipaje` (`id`, `id_usuario`, `id_punto_control`, `id_control`, `fecha`, `bar_tag`, `cod_iata`) VALUES
(1, 1, 1, 9, '2015-04-24 15:17:25', '0511221734', '0511'),
(9, 1, 1, 9, '2015-04-24 15:18:12', '7343156645', '0511'),
(11, 1, 1, 9, '2015-04-24 15:18:12', '0511221767', '0511');

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
(1, 1, 1, 'Jorge Peraza', 'jperaza', '1234', 1),
(2, 1, 2, 'Juan Carlos Nunes', 'jcnunes', '1234', 1);

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
