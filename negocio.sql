-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-03-2021 a las 18:47:50
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
(12, 'Samsung', 0),
(13, 'Mariana', 0),
(14, 'SOUL', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas_proveedor`
--

CREATE TABLE `marcas_proveedor` (
  `id` int(11) NOT NULL,
  `id_marca` int(10) UNSIGNED NOT NULL,
  `id_proveedor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `marcas_proveedor`
--

INSERT INTO `marcas_proveedor` (`id`, `id_marca`, `id_proveedor`) VALUES
(1, 5, 1),
(2, 3, 1);

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
(3, 'Teclado', 'Teclado inalambrico', 2100, 2, 6, 6),
(5, 'Ultrabook', 'Notebook DELL 14R', 79000, 10, 6, NULL),
(7, 'Mesa para PC', 'Mesa para PC color caoba', 14000, 10, 7, NULL),
(8, 'Kit Teclado y Mouse wireless', 'Kit Teclado y Mouse wireless Kit Teclado y Mouse wireless Kit Teclado y Mouse wireless', 3000, 10, 6, NULL),
(9, 'Licuadora', 'alalaslda mdlasdmlasldals mdm mdm dsdsdqwyu wyqyuwy djkahsjdhjasdbd basnbd asbhdbas hdjkasbfd gvrv n.', 8100, 10, 5, 9),
(10, 'Soporte microfono', 'Soporte para microfono flexible 50 cm blanco', 650, 10, 6, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `domicilio` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(13) COLLATE utf8_spanish2_ci NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razon_social`, `domicilio`, `telefono`, `borrado`) VALUES
(1, 'Importadora del Valle', 'Av. San Martin 1160', '3834000001', 0),
(2, 'Distribuidora Rafael', 'Av. Virgen del Valle 380', '3834000002', 0),
(14, 'Vega distribuciones', '', '', 0),
(15, 'Prevedello', '', '', 0),
(16, 'probando prov', '', '', 0),
(17, 'pepepeppe', '', '', 0);

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
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = usuario registrado; 1 = administrador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `email`, `nivel`) VALUES
(1, 'qwq', 'errer', 'hernan@email.com', 0),
(2, 'hernan', '$2y$10$77qrsJKFvDkwXf6yJSY9Y.BVrVjNvNHBt4oceRdIyPzoFKjGWIG8K', 'hernan@email.com', 0);

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
(18, '2020-11-09 10:17:00', 3, 1, 2),
(19, '2020-12-01 11:04:00', 3, 2, 3);

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
-- Indices de la tabla `marcas_proveedor`
--
ALTER TABLE `marcas_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `marcas_proveedor`
--
ALTER TABLE `marcas_proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
