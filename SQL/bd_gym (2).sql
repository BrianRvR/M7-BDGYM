-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2023 a las 23:26:58
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
-- Base de datos: `bd_gym`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_socio` (IN `p_dni` VARCHAR(10), IN `p_nombre_apellidos` VARCHAR(100), IN `p_correo` VARCHAR(100), IN `p_telefono` VARCHAR(15), IN `p_contrasena` VARCHAR(50))   BEGIN
    UPDATE Socios
    SET nombre_apellidos = p_nombre_apellidos,
        correo = p_correo,
        telefono = p_telefono,
        contrasena = p_contrasena
    WHERE dni = p_dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_actividades_con_socios` ()   BEGIN
    SELECT a.nombre_actividad, COUNT(i.dni) AS cantidad_socios
    FROM Actividades a
    LEFT JOIN Inscripcion i ON a.nombre_actividad = i.nombre_actividad
    GROUP BY a.nombre_actividad;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `nombre_actividad` varchar(100) NOT NULL,
  `hora_actividad` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`nombre_actividad`, `hora_actividad`) VALUES
('Body Pump', '14:00:00'),
('Muay Thai', '16:00:00'),
('Pilates', '11:00:00'),
('Spinning', '18:00:00'),
('Yoga', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `nombre_actividad` varchar(100) DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id`, `dni`, `nombre_actividad`, `fecha_inscripcion`) VALUES
(38, '12345678A', 'Spinning', '2023-05-18'),
(39, '56789012F', 'Yoga', '2023-05-26'),
(40, 'J1232333H', 'Body Pump', '2023-05-16'),
(41, '12345678A', 'Muay Thai', '2023-05-16'),
(42, '12345678A', 'Yoga', '2023-05-16');

--
-- Disparadores `inscripcion`
--
DELIMITER $$
CREATE TRIGGER `verificar_actividad_inscripcion` BEFORE INSERT ON `inscripcion` FOR EACH ROW BEGIN
    IF NOT EXISTS (SELECT 1 FROM Actividades WHERE nombre_actividad = NEW.nombre_actividad) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La actividad especificada no existe';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `nombre_apellidos` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `dni` varchar(10) NOT NULL,
  `contraseña` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`nombre_apellidos`, `correo`, `telefono`, `dni`, `contraseña`) VALUES
('Juan Pérez', 'juan.perez@gmail.com', '630592001', '12345678A', 'juan123'),
('Laura Fernández', 'laura.fernandez@gmail.com', '602249245', '23456789D', 'laura123'),
('Luisa González', 'luisa.gonzalez@hotmail.com', '699023412', '34567890E', 'luisa123'),
('Pedro Rodríguez', 'pedro.rodriguez@yahoo.com', '602693510', '45678901C', 'pedro123'),
('Pablo García', 'pablo.garcia@yahoo.com', '675839502', '56789012F', 'pablo123'),
('Ana Martínez', 'ana.martinez@gmail.com', '667300912', '67890123G', 'ana123'),
('Carlos Sánchez', 'carlos.sanchez@hotmail.com', '660324303', '78901234H', 'carlos123'),
('José Torres', 'jose.torres@gmail.com', '660321958', '90123456J', 'jose123'),
('Luna Perez Wow', 'luna123@gmail.com', '602306239', 'J1232333H', 'luna123'),
('Junior Hernandez', 'junio@gmail.com', '673200000', 'y233545g', 'junior12');

--
-- Disparadores `socios`
--
DELIMITER $$
CREATE TRIGGER `asegurar_correo_unico` BEFORE UPDATE ON `socios` FOR EACH ROW BEGIN
    IF NEW.correo != OLD.correo AND EXISTS (SELECT 1 FROM Socios WHERE correo = NEW.correo) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El correo especificado ya está en uso por otro socio';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pilates`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_pilates` (
`id` int(11)
,`dni` varchar(20)
,`nombre_actividad` varchar(100)
,`fecha_inscripcion` date
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_yoga`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_yoga` (
`id` int(11)
,`dni` varchar(20)
,`nombre_actividad` varchar(100)
,`fecha_inscripcion` date
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pilates`
--
DROP TABLE IF EXISTS `vista_pilates`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pilates`  AS SELECT `inscripcion`.`id` AS `id`, `inscripcion`.`dni` AS `dni`, `inscripcion`.`nombre_actividad` AS `nombre_actividad`, `inscripcion`.`fecha_inscripcion` AS `fecha_inscripcion` FROM `inscripcion` WHERE `inscripcion`.`nombre_actividad` = 'Pilates\'Pilates' ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_yoga`
--
DROP TABLE IF EXISTS `vista_yoga`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_yoga`  AS SELECT `inscripcion`.`id` AS `id`, `inscripcion`.`dni` AS `dni`, `inscripcion`.`nombre_actividad` AS `nombre_actividad`, `inscripcion`.`fecha_inscripcion` AS `fecha_inscripcion` FROM `inscripcion` WHERE `inscripcion`.`nombre_actividad` = 'Yoga\'Yoga' ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`nombre_actividad`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre_actividad` (`nombre_actividad`),
  ADD KEY `Inscripcion_ibfk_1` (`dni`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `Inscripcion_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `socios` (`dni`) ON DELETE CASCADE,
  ADD CONSTRAINT `Inscripcion_ibfk_2` FOREIGN KEY (`nombre_actividad`) REFERENCES `actividades` (`nombre_actividad`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
