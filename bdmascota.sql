-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2022 a las 00:44:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdmascota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afiliacion`
--

CREATE TABLE `afiliacion` (
  `id_afiliacion` int(11) NOT NULL,
  `fecha_afiliacion` datetime NOT NULL,
  `id_mascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `tipo_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `tipo_estado`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` int(11) NOT NULL,
  `id_dueño` int(11) NOT NULL,
  `id_tipo_mascota` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `raza` varchar(20) NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id_medicamentos` int(11) NOT NULL,
  `medicamento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `id_receta` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `id_medicamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `id_tipo_mascota` int(11) NOT NULL,
  `tipo_mascota` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'administrador'),
(2, 'veterinario'),
(5, 'propietario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `dirrecion` varchar(20) NOT NULL,
  `tarjeta_profesional` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_tipo_usuario`, `id_estado`, `password`, `identificacion`, `nombre`, `apellido`, `telefono`, `correo`, `dirrecion`, `tarjeta_profesional`) VALUES
(2, 1, 1, '0000', '4444', 'jorge', 'admin', '12345', 'correo@gmail.com', 'Av 100 cr 45 E', NULL),
(3, 2, 1, '0001', '3333', 'Alonso', 'Veterinario', '65432', 'veteri@gmail.com', 'cll 12 # 21 c sur', '10203'),
(4, 5, 1, '0002', '2222', 'paquito', 'Gonzales', '44445', 'paquito@gmail.com', 'cll 45 sur # 11 A', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id_visita` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `id_dueño` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_visita` datetime NOT NULL,
  `temperatura` varchar(20) NOT NULL,
  `peso` varchar(20) NOT NULL,
  `freq_respi` varchar(20) NOT NULL,
  `freq_cardi` varchar(20) NOT NULL,
  `estado_animo` varchar(20) NOT NULL,
  `recomendaciones` varchar(20) NOT NULL,
  `costo_visita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD PRIMARY KEY (`id_afiliacion`),
  ADD KEY `id_mascota` (`id_mascota`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `id_dueño` (`id_dueño`),
  ADD KEY `id_tipo_mascota` (`id_tipo_mascota`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id_medicamentos`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_visita` (`id_visita`),
  ADD KEY `id_medicamento` (`id_medicamento`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`id_tipo_mascota`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id_visita`),
  ADD KEY `id_mascota` (`id_mascota`),
  ADD KEY `id_dueño` (`id_dueño`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  MODIFY `id_afiliacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id_medicamentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  MODIFY `id_tipo_mascota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `id_visita` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afiliacion`
--
ALTER TABLE `afiliacion`
  ADD CONSTRAINT `afiliacion_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`);

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`id_dueño`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `mascota_ibfk_2` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipo_mascota` (`id_tipo_mascota`);

--
-- Filtros para la tabla `receta`
--
ALTER TABLE `receta`
  ADD CONSTRAINT `receta_ibfk_1` FOREIGN KEY (`id_visita`) REFERENCES `visita` (`id_visita`),
  ADD CONSTRAINT `receta_ibfk_2` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id_medicamentos`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `mascota` (`id_mascota`),
  ADD CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`id_dueño`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `visita_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
