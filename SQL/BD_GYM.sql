-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-04-2023 a las 11:48:25
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BD_GYM`
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
-- Estructura de tabla para la tabla `Actividades`
--

CREATE TABLE `Actividades` (
  `nombre_actividad` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `hora_actividad` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `Actividades`
--

INSERT INTO `Actividades` (`nombre_actividad`, `hora_actividad`) VALUES
('Body Pump', '13:00:00'),
('Pilates', '11:00:00'),
('Spinning', '12:00:00'),
('Yoga', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Inscripcion`
--

CREATE TABLE `Inscripcion` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `nombre_actividad` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_inscripcion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `Inscripcion`
--

INSERT INTO `Inscripcion` (`id`, `dni`, `nombre_actividad`, `fecha_inscripcion`) VALUES
(14, '56789012F', 'Spinning', '2023-03-30'),
(15, '67890123G', 'Pilates', '2023-03-31'),
(25, '87654321B', 'Pilates', '2023-04-20'),
(29, '67890123G', 'Body Pump', '2023-04-20'),
(30, 'P234K44', 'Body Pump', '2023-04-20'),
(31, '90123456J', 'Body Pump', '2023-04-20'),
(32, 'P124J11', 'Pilates', '2023-04-26'),
(33, '89012345I', 'Pilates', '2023-04-24');

--
-- Disparadores `Inscripcion`
--
DELIMITER $$
CREATE TRIGGER `verificar_actividad_inscripcion` BEFORE INSERT ON `Inscripcion` FOR EACH ROW BEGIN
    IF NOT EXISTS (SELECT 1 FROM Actividades WHERE nombre_actividad = NEW.nombre_actividad) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La actividad especificada no existe';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Socios`
--

CREATE TABLE `Socios` (
  `nombre_apellidos` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `dni` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `contraseña` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `Socios`
--

INSERT INTO `Socios` (`nombre_apellidos`, `correo`, `telefono`, `dni`, `contraseña`) VALUES
('Juan Pérez', 'juan.perez@gmail.com', '630592001', '12345678A', 'juan123'),
('Laura Fernández', 'laura.fernandez@gmail.com', '602249245', '23456789D', 'laura123'),
('Luisa González', 'luisa.gonzalez@hotmail.com', '699023412', '34567890E', 'luisa123'),
('Pedro Rodríguez', 'pedro.rodriguez@yahoo.com', '602693510', '45678901C', 'pedro123'),
('Pablo García', 'pablo.garcia@yahoo.com', '675839502', '56789012F', 'pablo123'),
('Ana Martínez', 'ana.martinez@gmail.com', '667300912', '67890123G', 'ana123'),
('Carlos Sánchez', 'carlos.sanchez@hotmail.com', '660324303', '78901234H', 'carlos123'),
('María Gómez', 'maria.gomez@hotmail.com', '602395183', '87654321B', 'maria123'),
('Lucía López', 'lucia.lopez@yahoo.com', '600221475', '89012345I', 'lucia123'),
('José Torres', 'jose.torres@gmail.com', '660321958', '90123456J', 'jose123'),
('Luna Perez Wow', 'luna123@gmail.com', '602306239', 'J1232333H', 'luna123'),
('Ñaña Ramirez', 'nanana@gmail.com', '673209338', 'P124J11', 'ñaña123'),
('Jose Manuel Perez', 'josete@gmail.com', '673334445', 'P234K44', 'josejose123'),
('Brian Raul Vilchez Retamozo ', 'brianrvr12@gmail.com', '673200202', 'Y1733220H', 'brian123');

--
-- Disparadores `Socios`
--
DELIMITER $$
CREATE TRIGGER `asegurar_correo_unico` BEFORE UPDATE ON `Socios` FOR EACH ROW BEGIN
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pilates`  AS SELECT `Inscripcion`.`id` AS `id`, `Inscripcion`.`dni` AS `dni`, `Inscripcion`.`nombre_actividad` AS `nombre_actividad`, `Inscripcion`.`fecha_inscripcion` AS `fecha_inscripcion` FROM `Inscripcion` WHERE `Inscripcion`.`nombre_actividad` = 'Pilates''Pilates'  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_yoga`
--
DROP TABLE IF EXISTS `vista_yoga`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_yoga`  AS SELECT `Inscripcion`.`id` AS `id`, `Inscripcion`.`dni` AS `dni`, `Inscripcion`.`nombre_actividad` AS `nombre_actividad`, `Inscripcion`.`fecha_inscripcion` AS `fecha_inscripcion` FROM `Inscripcion` WHERE `Inscripcion`.`nombre_actividad` = 'Yoga''Yoga'  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Actividades`
--
ALTER TABLE `Actividades`
  ADD PRIMARY KEY (`nombre_actividad`);

--
-- Indices de la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni` (`dni`),
  ADD KEY `nombre_actividad` (`nombre_actividad`);

--
-- Indices de la tabla `Socios`
--
ALTER TABLE `Socios`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Inscripcion`
--
ALTER TABLE `Inscripcion`
  ADD CONSTRAINT `Inscripcion_ibfk_1` FOREIGN KEY (`dni`) REFERENCES `Socios` (`dni`),
  ADD CONSTRAINT `Inscripcion_ibfk_2` FOREIGN KEY (`nombre_actividad`) REFERENCES `Actividades` (`nombre_actividad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
