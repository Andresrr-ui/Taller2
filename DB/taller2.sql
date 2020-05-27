-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2020 a las 00:24:39
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `taller2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDO` varchar(30) NOT NULL,
  `CORREO` varchar(40) NOT NULL,
  `EDAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`CEDULA`, `NOMBRE`, `APELLIDO`, `CORREO`, `EDAD`) VALUES
(12345678, 'Juan', 'Avellaneda', 'juan@juan.com', 21),
(34513313, 'Jose', 'Cifuentes', 'jose@cifuentes.com', 65),
(43423423, 'Luis', 'Castillo', 'luis@castillo.com', 54),
(43765676, 'Martin', 'Palacios', 'martin@palacios.com', 54),
(123456789, 'prueba', 'Prueba', 'prueba@prueba.com', 99),
(237876878, 'Ana', 'Rojas', 'ana@rojas.com', 43),
(664522223, 'Rocio', 'Martine', 'rocio@martine.com', 76),
(987654321, 'Marco', 'Polo', 'marco@polo.com', 22),
(2132132312, 'Julian', 'Perez', 'julian@perez.com', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID` int(11) NOT NULL,
  `ROL` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID`, `ROL`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int(11) NOT NULL,
  `USUARIO` varchar(30) NOT NULL,
  `PASSWORD` varchar(600) NOT NULL,
  `CEDULA` int(11) NOT NULL,
  `ROL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `USUARIO`, `PASSWORD`, `CEDULA`, `ROL`) VALUES
(1, 'prueba', 'prueba123', 123456789, 1),
(11, 'user', 'user123', 987654321, 2),
(12, 'juachis', 'juanko', 12345678, 2),
(13, 'usuario1', 'usuario123', 237876878, 2),
(14, 'usuario2', 'usuario2123', 34513313, 2),
(15, 'usuario4', 'usuario4123', 2132132312, 2),
(16, 'usuario5', 'usuario5123', 43423423, 2),
(17, 'usuario7', 'usuario7', 43765676, 2),
(18, 'usuario8', 'usuario8123', 664522223, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`CEDULA`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CEDULA` (`CEDULA`),
  ADD KEY `ROL` (`ROL`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`CEDULA`) REFERENCES `persona` (`CEDULA`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`ROL`) REFERENCES `roles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
