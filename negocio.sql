-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-11-2020 a las 13:24:15
-- Versión del servidor: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `negocio`
--
DROP DATABASE IF EXISTS `negocio`;
CREATE DATABASE IF NOT EXISTS `negocio` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `negocio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `dni`) VALUES
(1, 'Jose Luis', 'Alvarez', '123'),
(2, 'Ana Maria', 'Ortiz', '456'),
(3, 'Dario', 'Sanchez', '111'),
(4, 'Alejandro', 'Narvaez', '222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `borrado`) VALUES
(2, 'Sony', 0),
(3, 'Motorola', 1),
(5, 'Lumilagro', 0),
(6, 'IBM', 1),
(7, 'Nike', 0),
(8, 'Atma', 1),
(9, 'Electrolux', 0),
(10, 'Genius', 0),
(11, 'Adidas', 0),
(12, 'Samsung', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(10) UNSIGNED NOT NULL DEFAULT 10,
  `id_rubro` int(11) NOT NULL,
  `id_marca` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `id_rubro`, `id_marca`) VALUES
(1, 'Televisor Smartv', 'Televisor 60\" editado', 55000, 497, 1, NULL),
(3, 'Teclado', 'Teclado inalambrico', 2100, 4, 6, 6),
(5, 'Ultrabook', 'Notebook DELL 14R', 79000, 10, 6, NULL),
(7, 'Mesa para PC', 'Mesa para PC color caoba', 14000, 10, 7, NULL),
(8, 'Kit Teclado y Mouse wireless', 'Kit Teclado y Mouse wireless Kit Teclado y Mouse wireless Kit Teclado y Mouse wireless', 3000, 10, 6, NULL),
(9, 'Licuadora', 'alalaslda mdlasdmlasldals mdm mdm dsdsdqwyu wyqyuwy djkahsjdhjasdbd basnbd asbhdbas hdjkasbfd gvrv n.', 8100, 10, 5, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`id`, `nombre`) VALUES
(1, 'Electronica'),
(2, 'Telefonia'),
(5, 'Eletrodomesticos'),
(6, 'Computacion'),
(7, 'Muebles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `id_producto`, `cantidad`, `id_cliente`) VALUES
(1, '2020-10-20 00:00:00', 3, 2, NULL),
(4, '2020-10-20 00:00:00', 3, 3, NULL),
(8, '2020-10-20 00:00:00', 1, 1, NULL),
(9, '2020-10-20 00:00:00', 1, 1, NULL),
(10, '2020-10-20 00:00:00', 1, 1, NULL),
(11, '2020-10-20 00:00:00', 1, 1, NULL),
(12, '2020-10-20 22:10:00', 1, 1, NULL),
(13, '2020-10-20 22:10:00', 1, 1, NULL),
(14, '2020-10-20 22:10:00', 1, 1, NULL),
(15, '2020-10-20 22:10:00', 1, 1, NULL),
(16, '2020-10-20 07:46:00', 1, 1, NULL),
(17, '2020-10-20 19:47:00', 1, 1, NULL),
(18, '2020-11-09 10:17:00', 3, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
