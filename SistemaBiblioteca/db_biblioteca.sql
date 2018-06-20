-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2018 a las 02:33:16
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_biblioteca`
--
CREATE DATABASE IF NOT EXISTS `db_biblioteca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_biblioteca`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `codigo`, `descripcion`) VALUES
(1, '1', 'Fantasia'),
(2, '2', 'Misterio'),
(3, '3', 'Miscelaneos'),
(4, '4', 'Aventura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `libro_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`libro_id`,`persona_id`),
  KEY `fk_historico_libro1_idx` (`libro_id`),
  KEY `fk_historico_persona1_idx` (`persona_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(45) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(45) NOT NULL,
  `editorial` varchar(15) NOT NULL,
  `annio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`categoria_id`),
  KEY `fk_libro_categoria1_idx` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id`, `isbn`, `titulo`, `autor`, `editorial`, `annio`, `cantidad`, `categoria_id`) VALUES
(1, '9789567042128', 'Yo soy simón', 'Becky Albertalli', 'Puck', 2018, 5, 1),
(2, '8408118447', 'El Coleccionista de Lagrimas', 'Augusto Cury', 'Zenith', 2013, 3, 1),
(3, '9789507302190', 'Valle de la Calma', 'Angel David Revilla', 'Ediciones Temas', 2018, 7, 2),
(4, '9781616550417', 'Hyrule Historia', 'Varios Autores', 'Dark Horse', 2011, 1, 3),
(5, '9788435055680', 'Veinte Mil Leguas de viaje Submarino', 'Julio Verne', 'Edhasa', 2006, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Bibliotecario', 1),
(3, 'Docente', 1),
(4, 'Alumno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

DROP TABLE IF EXISTS `persona`;
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(15) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `rut`, `nombres`, `apellidos`, `email`, `telefono`, `estado`) VALUES
(1, '16705425-9', 'Pedro Pablo', 'Perez Pereira', 'pp@gmail.com', '123654987', 1),
(3, '19', 'Simon', 'Gregoire', 's.gregoire@gmail.com', '12234587', 1),
(4, '999999999', 'Miguel Angel', 'Basualto Mora', 'basualto@gmail.com', '321456987', 1),
(5, '666666666', 'Valentina Ignacia', 'Cordero Mora', 'vi.cordero@gmail.com', '456987123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
CREATE TABLE IF NOT EXISTS `prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_entrega` date NOT NULL,
  `persona_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`persona_id`,`libro_id`),
  KEY `fk_prestamo_persona1_idx` (`persona_id`),
  KEY `fk_prestamo_libro1_idx` (`libro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Disparadores `prestamo`
--
DROP TRIGGER IF EXISTS `tr_prestamo_devolver`;
DELIMITER //
CREATE TRIGGER `tr_prestamo_devolver` AFTER DELETE ON `prestamo`
 FOR EACH ROW insert into historico(id, fecha_entrega, fecha_devolucion, persona_id, libro_id) 
				  values(old.id, old.fecha_entrega, now(), old.persona_id, old.libro_id)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_reserva` date NOT NULL,
  `persona_id` int(11) NOT NULL,
  `libro_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`persona_id`,`libro_id`),
  KEY `fk_reserva_persona1_idx` (`persona_id`),
  KEY `fk_reserva_libro1_idx` (`libro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`perfil_id`,`persona_id`),
  KEY `fk_usuario_perfil_idx` (`perfil_id`),
  KEY `fk_usuario_persona1_idx` (`persona_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `password`, `estado`, `perfil_id`, `persona_id`) VALUES
(1, 'admin@pablo-neruda.cl', '$2y$10$7CtxeZxK6OQG41eENRzJr.2Ngd/soKlHwtIVU6Xfk7D388zJIezE2', 1, 1, 1),
(3, 's.gregoire@gmail.com', '$2y$10$199.AyQ2AtVPA5FeOMY3Qel4Sop./iODky7s/Y8vQiFd6myO27.AO', 1, 2, 3),
(4, 'basualto@gmail.com', '$2y$10$/UUT7VDXNeIgqxUImTpo7OEzdM0PFhO9.pQqVuV/AUAyC5196QPY.', 1, 3, 4),
(5, 'vi.cordero@gmail.com', '$2y$10$wQeQAZ4yT9pM.ScEB7KyvuHTn5XQ8p62KRwpZvJNXOLVoLkah3n6u', 1, 4, 5);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `fk_historico_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historico_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `fk_libro_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestamo_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserva_libro1` FOREIGN KEY (`libro_id`) REFERENCES `libro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
