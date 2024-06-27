-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2024 a las 00:08:51
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cdmi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `NombreAdministrador` text NOT NULL,
  `ApellidoAdministrador` text NOT NULL,
  `DocumentoAdministrador` int(15) NOT NULL,
  `UsuarioAdministrador` varchar(20) NOT NULL,
  `ContrasenaAdministrador` varchar(10) NOT NULL,
  `CorreoAdministrador` varchar(40) NOT NULL,
  `TelefonoAdministrador` int(20) NOT NULL,
  `DireccionAdministrador` varchar(30) NOT NULL,
  `DateCreateRegistrAdmin` varchar(10) NOT NULL,
  `DateLastSessionAdmin` varchar(10) NOT NULL,
  `EstadoCuentaAdmin` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `NombreCliente` text NOT NULL,
  `ApellidoCliente` text NOT NULL,
  `DocumentoCliente` int(15) NOT NULL,
  `UsuarioCliente` varchar(20) NOT NULL,
  `ContrasenaCliente` varchar(10) NOT NULL,
  `CorreoCliente` varchar(40) NOT NULL,
  `TelefonoCliente` int(20) NOT NULL,
  `DireccionCliente` varchar(30) NOT NULL,
  `DateCreateRegistrCliente` varchar(10) NOT NULL,
  `DateLastSessionCliente` varchar(10) NOT NULL,
  `EstadoCuentaCliente` text NOT NULL,
  `PreferenciasCliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `donaciones`
--

CREATE TABLE `donaciones` (
  `id_donaciones` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `Proyecto` text NOT NULL,
  `MontoDonante` varchar(20) NOT NULL,
  `FechaDonante` varchar(10) NOT NULL,
  `MetodoPagoDonacion` text NOT NULL,
  `PropositoDonacion` text NOT NULL,
  `InformacionDonante` text NOT NULL,
  `EstadoDonacion` text NOT NULL,
  `ComentariosDonacion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marketing`
--

CREATE TABLE `marketing` (
  `id_marketing` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `HistorialInteracciones` text NOT NULL,
  `PreferenciasProySer` text NOT NULL,
  `InformacionCampana` text NOT NULL,
  `DatosSeguimiento` text NOT NULL,
  `EstadoCampañas` text NOT NULL,
  `PresupuestoGastos` text NOT NULL,
  `CanalMarketing` text NOT NULL,
  `ResultadosMarketing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `NombreProducto` text NOT NULL,
  `DescripcionProducto` text NOT NULL,
  `PrecioProducto` varchar(15) NOT NULL,
  `CategoriaProducto` text NOT NULL,
  `ProveedorProducto` varchar(36) NOT NULL,
  `CantInventarioProducto` int(255) NOT NULL,
  `DateIncomeInvProducto` varchar(10) NOT NULL,
  `EstadoProducto` text NOT NULL,
  `DimensionesProducto` varchar(15) NOT NULL,
  `PesoProducto` varchar(8) NOT NULL,
  `DateLastUpdateProducto` varchar(10) NOT NULL,
  `FechaFabricaProducto` varchar(10) NOT NULL,
  `FechaCaducaProducto` varchar(10) NOT NULL,
  `ImpuestosProducto` varchar(60) NOT NULL,
  `id_administrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `Vendedor` text NOT NULL,
  `Transaccion` int(255) NOT NULL,
  `FechaHoraVenta` varchar(16) NOT NULL,
  `MetodoPagoVenta` text NOT NULL,
  `TotalVenta` varchar(10) NOT NULL,
  `DescuentosAplicaVenta` varchar(10) NOT NULL,
  `DireccionEnvioVenta` varchar(30) NOT NULL,
  `ImpuestosVenta` varchar(60) NOT NULL,
  `EstadoEntregaVenta` text NOT NULL,
  `MetodoEnvioVenta` text NOT NULL,
  `CostoEnvioVenta` varchar(10) NOT NULL,
  `FechaEntregaVenta` varchar(10) NOT NULL,
  `SeguimientoEnvioVenta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD PRIMARY KEY (`id_donaciones`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`id_marketing`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `id_administrador` (`id_administrador`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD UNIQUE KEY `id_cliente` (`id_cliente`),
  ADD UNIQUE KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `donaciones`
--
ALTER TABLE `donaciones`
  MODIFY `id_donaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marketing`
--
ALTER TABLE `marketing`
  MODIFY `id_marketing` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donaciones`
--
ALTER TABLE `donaciones`
  ADD CONSTRAINT `donaciones_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `marketing`
--
ALTER TABLE `marketing`
  ADD CONSTRAINT `marketing_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id_administrador`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
