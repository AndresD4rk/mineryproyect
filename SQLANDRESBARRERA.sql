-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 07-06-2023 a las 02:05:14
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectomineria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reganalisis`
--

CREATE TABLE `reganalisis` (
  `idga` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reganalisis`
--

INSERT INTO `reganalisis` (`idga`, `nombre`, `descripcion`, `fecha`) VALUES
('64738de7a41dc', 'Hombres y Mujeres', 'Cantidad de Hombres y Mujeres que generan Citas Médicas', '2023-05-28'),
('647394b53fb7c', 'Citas por Centro de Costo', 'Cantidad de citas por centro de costo', '2023-05-28'),
('647398ae7dca1', 'Ingresos por Centro de Costo', 'Cantidad de ingresos por centro de costo', '2023-05-28'),
('6473c6678ac55', 'Embarazadas y No Embarazadas', 'Cantidad de mujeres embarazadas y no embarazadas', '2023-05-28'),
('6473ca67236a8', 'Grupo Sanguíneo de Embarazadas ', 'Cantidad por grupo sanguíneo de todas las embarazadas', '2023-05-28'),
('6473d0c14170b', 'Estado Civil de Embarazadas', 'Estado civil de todas la embarazadas registradas', '2023-05-29'),
('6473d62c5a78d', 'Edades de Embarazadas', 'Edades agrupadas de las embarazadas registradas', '2023-05-29'),
('647fc97229213', 'Grupo Sanguíneo de Embarazadas ', 'Cantidad por grupo sanguíneo de todas las embarazadas', '2023-06-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reganalisis`
--
ALTER TABLE `reganalisis`
  ADD PRIMARY KEY (`idga`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
