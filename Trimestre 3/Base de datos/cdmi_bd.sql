-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2024 a las 05:05:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cdmi_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID_Carrito` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `ID_Producto` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `ID_Donacion` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `Valor_Monto` int(10) NOT NULL,
  `Descripcion_Acción` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `donaciones`
--

INSERT INTO `donaciones` (`ID_Donacion`, `ID_Usuario`, `Valor_Monto`, `Descripcion_Acción`) VALUES
(6, 0, 90000, 'ayuda proyecto'),
(7, 0, 102300, 'donacion ayuda'),
(8, 0, 98750, 'indigena ayuda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envio`
--

CREATE TABLE `envio` (
  `ID_Envio` int(15) NOT NULL,
  `Nombre_Envio` varchar(50) NOT NULL,
  `ID_Producto` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `ID_Venta` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envio`
--

INSERT INTO `envio` (`ID_Envio`, `Nombre_Envio`, `ID_Producto`, `ID_Usuario`, `ID_Venta`) VALUES
(1, 'Manilla Carolina', 1, 1, 6),
(2, 'Collar Alejandro', 2, 2, 7),
(3, 'Bolso Daniela', 3, 3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `ID_Evento` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `ID_Administrador` int(12) NOT NULL,
  `Cronograma` date NOT NULL,
  `Aforo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID_Evento`, `ID_Usuario`, `ID_Administrador`, `Cronograma`, `Aforo`) VALUES
(5, 1, 1, '0000-00-00', 100),
(6, 2, 2, '0000-00-00', 100),
(7, 3, 3, '0000-00-00', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `ID_Factura` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `ID_Producto` int(12) NOT NULL,
  `Fecha_Venta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`ID_Factura`, `ID_Usuario`, `ID_Producto`, `Fecha_Venta`) VALUES
(1, 1, 1, '0000-00-00'),
(2, 2, 2, '0000-00-00'),
(3, 3, 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `caracteristicas` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroevento`
--

CREATE TABLE `registroevento` (
  `ID_Registro_Evento` int(15) NOT NULL,
  `ID_Evento` int(50) NOT NULL,
  `ID_Usuario` int(6) NOT NULL,
  `Fecha_Registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroevento`
--

INSERT INTO `registroevento` (`ID_Registro_Evento`, `ID_Evento`, `ID_Usuario`, `Fecha_Registro`) VALUES
(1, 5, 1, '0000-00-00'),
(2, 6, 2, '0000-00-00'),
(3, 7, 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_recuperacion`
--

CREATE TABLE `solicitudes_recuperacion` (
  `ID_Solicitud` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_recuperacion`
--

INSERT INTO `solicitudes_recuperacion` (`ID_Solicitud`, `correo`, `token`, `fecha_solicitud`) VALUES
(1, 'valentinaramirezld25@gmail.com', '1ad475ba8232b6a68ab8bc494d505c917de5fcb64d79808551275e557788eafc8d3b77268225abf12be76a21b66f4eea034b', '2024-09-09 02:49:37'),
(2, 'valentinaramirezld25@gmail.com', '160a424445f38e3d279df7ceb6858e059f0d217233aaae294f7290e8e916234b71ac4c75293e709cd4c0d5df64426f5dc801', '2024-09-16 02:02:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('usuario','administrador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `nombre`, `apellido`, `fecha_nacimiento`, `correo`, `telefono`, `contraseña`, `rol`) VALUES
(14, 'Laura', 'Ramirez', '2006-10-25', 'valentinaramirezld25@gmail.com', '3143795973', '$2y$10$JhHxWEBCuKtk0SGP2ee.0eIeXG1dA1or2C1w2U1MPQnPgiT09.Zje', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` int(12) NOT NULL,
  `ID_Producto` int(12) NOT NULL,
  `ID_Administrador` int(12) NOT NULL,
  `ID_Usuario` int(12) NOT NULL,
  `Cantidad_Producto` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_Venta`, `ID_Producto`, `ID_Administrador`, `ID_Usuario`, `Cantidad_Producto`) VALUES
(6, 1, 1, 1, 1),
(7, 2, 2, 2, 1),
(8, 3, 3, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID_Carrito`),
  ADD KEY `fk_carrito_producto` (`ID_Producto`),
  ADD KEY `fk_carrito_usuario` (`ID_Usuario`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`ID_Donacion`);

--
-- Indices de la tabla `envio`
--
ALTER TABLE `envio`
  ADD PRIMARY KEY (`ID_Envio`),
  ADD KEY `fk_envio_producto` (`ID_Producto`),
  ADD KEY `fk_envio_ventas` (`ID_Venta`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID_Evento`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`ID_Factura`),
  ADD KEY `fk_factura_producto` (`ID_Producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registroevento`
--
ALTER TABLE `registroevento`
  ADD PRIMARY KEY (`ID_Registro_Evento`),
  ADD KEY `fk_registroevento_eventos` (`ID_Evento`);

--
-- Indices de la tabla `solicitudes_recuperacion`
--
ALTER TABLE `solicitudes_recuperacion`
  ADD PRIMARY KEY (`ID_Solicitud`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `fk_producto` (`ID_Producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID_Carrito` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `ID_Donacion` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `envio`
--
ALTER TABLE `envio`
  MODIFY `ID_Envio` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `ID_Evento` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `ID_Factura` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registroevento`
--
ALTER TABLE `registroevento`
  MODIFY `ID_Registro_Evento` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes_recuperacion`
--
ALTER TABLE `solicitudes_recuperacion`
  MODIFY `ID_Solicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `ID_Venta` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `fk_carrito_producto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`),
  ADD CONSTRAINT `fk_carrito_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `envio`
--
ALTER TABLE `envio`
  ADD CONSTRAINT `fk_envio_producto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`),
  ADD CONSTRAINT `fk_envio_ventas` FOREIGN KEY (`ID_Venta`) REFERENCES `ventas` (`ID_Venta`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_producto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);

--
-- Filtros para la tabla `registroevento`
--
ALTER TABLE `registroevento`
  ADD CONSTRAINT `fk_registroevento_eventos` FOREIGN KEY (`ID_Evento`) REFERENCES `eventos` (`ID_Evento`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`ID_Producto`) REFERENCES `producto` (`ID_Producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
