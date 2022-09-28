-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generaciÃ³n: 07-03-2022 a las 00:12:27
-- VersiÃ³n del servidor: 10.4.21-MariaDB
-- VersiÃ³n de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cursacredenciales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

/*CREATE database orientation_course;*/

CREATE TABLE credenciales (
  Usuario varchar(100) NOT NULL,
  Contrasenya varchar(100) NOT NULL,
  Correo varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`Usuario`, `Contrasenya`, `Correo`) VALUES
('Martin', '123', 'martin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equip`
--

CREATE TABLE `equip` (
  `id_equip` int(11) NOT NULL,
  `nom_equip` varchar(150) DEFAULT NULL,
  `participants_equip` int(11) DEFAULT NULL,
  `codi_equip` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equip_fites`
--

CREATE TABLE `equip_fites` (
  `id_equip` int(11) NOT NULL,
  `id_fita` int(11) NOT NULL,
  `temps` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fites`
--

CREATE TABLE `fites` (
  `id_fita` int(11) NOT NULL,
  `punt_fita` int(11) DEFAULT NULL,
  `valor_fita` int(11) DEFAULT NULL,
  `codi_fita` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participants_equip`
--

CREATE TABLE `participants_equip` (
  `id_equip` int(11) DEFAULT NULL,
  `id_participant` int(11) NOT NULL,
  `nom_participant` varchar(150) DEFAULT NULL,
  `edat_participant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `participants_equip`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temps`
--

CREATE TABLE `temps` (
  `temps` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `temps`
--


--
-- Ã?ndices para tablas volcadas
--

--
-- Indices de la tabla `equip`
--
ALTER TABLE `equip`
  ADD PRIMARY KEY (`id_equip`);

--
-- Indices de la tabla `equip_fites`
--
ALTER TABLE `equip_fites`
  ADD PRIMARY KEY (`id_equip`,`id_fita`),
  ADD KEY `id_fita` (`id_fita`);

--
-- Indices de la tabla `fites`
--
ALTER TABLE `fites`
  ADD PRIMARY KEY (`id_fita`);

--
-- Indices de la tabla `participants_equip`
--
ALTER TABLE `participants_equip`
  ADD PRIMARY KEY (`id_participant`),
  ADD KEY `FK_participants_equip_equip` (`id_equip`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equip`
--
ALTER TABLE `equip`
  MODIFY `id_equip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fites`
--
ALTER TABLE `fites`
  MODIFY `id_fita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `participants_equip`
--
ALTER TABLE `participants_equip`
  MODIFY `id_participant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equip_fites`
--
ALTER TABLE `equip_fites`
  ADD CONSTRAINT `equip_fites_ibfk_1` FOREIGN KEY (`id_equip`) REFERENCES `equip` (`id_equip`),
  ADD CONSTRAINT `equip_fites_ibfk_2` FOREIGN KEY (`id_fita`) REFERENCES `fites` (`id_fita`);

--
-- Filtros para la tabla `participants_equip`
--
ALTER TABLE `participants_equip`
  ADD CONSTRAINT `FK_participants_equip_equip` FOREIGN KEY (`id_equip`) REFERENCES `equip` (`id_equip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
