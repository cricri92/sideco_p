-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-11-2014 a las 12:00:19
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sideco`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `applicant`
--

CREATE TABLE IF NOT EXISTS `applicant` (
`id` int(11) NOT NULL,
  `type_applicant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dependence_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `applicant`
--

INSERT INTO `applicant` (`id`, `type_applicant_id`, `name`, `cedula`, `email`, `password`, `slug`, `create_at`, `update_at`, `dependence_id`) VALUES
(1, 1, 'Kiara Ottogalli', '1234456', 'kottogalli@sideco.com', '5ae955fb17babdbb07a3c3ff012dd7c8850af77f', 'kiara-ottogalli', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8),
(2, 1, 'Antonio Castañeda', '9483823', 'castaneda@redesfacyt.com', '8cb2237d0679ca88db6464eac60da96345513964', 'antonio-castaneda', '2014-11-06 20:12:16', '2014-11-06 20:12:16', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `counselor`
--

CREATE TABLE IF NOT EXISTS `counselor` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `counselor_type_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `counselor_type`
--

CREATE TABLE IF NOT EXISTS `counselor_type` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `counselor_type`
--

INSERT INTO `counselor_type` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Representante de los profesores', '2014-11-07 05:41:56', '2014-11-07 05:41:56'),
(2, 'Representante de los estudiantes', '2014-11-07 05:41:56', '2014-11-07 05:41:56'),
(3, 'Representante suplente de los PROFESORES', '2014-11-07 05:43:34', '2014-11-07 05:43:34'),
(4, 'Director (E)-PRESIDENTE', '2014-11-07 05:43:34', '2014-11-07 05:43:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependence`
--

CREATE TABLE IF NOT EXISTS `dependence` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `dependence`
--

INSERT INTO `dependence` (`id`, `name`, `slug`, `create_at`, `update_at`) VALUES
(7, 'Ninguna', 'ninguna', '2014-11-06 06:27:36', '2014-11-06 06:43:25'),
(8, 'Preparadores', 'preparadores', '2014-11-06 06:27:45', '2014-11-06 06:27:45'),
(9, 'Coordinacion de Pasantias', 'coordinacion-de-pasantias', '2014-11-06 06:43:44', '2014-11-06 06:43:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diary`
--

CREATE TABLE IF NOT EXISTS `diary` (
`id` int(11) NOT NULL,
  `num_acta` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `consideration` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `diary`
--

INSERT INTO `diary` (`id`, `num_acta`, `date`, `consideration`, `create_at`, `update_at`) VALUES
(1, 'N009/12/2014', '2014-09-10', 'Consideracion', '2014-11-04 07:14:05', '2014-11-04 07:14:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diary_attachment`
--

CREATE TABLE IF NOT EXISTS `diary_attachment` (
`id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Administrador', '2014-11-02 03:37:57', '2014-11-02 03:37:57'),
(2, 'Usuario', '2014-11-02 03:37:57', '2014-11-02 03:37:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request`
--

CREATE TABLE IF NOT EXISTS `request` (
`id` int(11) NOT NULL,
  `type_request_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `request`
--

INSERT INTO `request` (`id`, `type_request_id`, `date`, `status_id`, `applicant_id`, `description`, `create_at`, `update_at`) VALUES
(22, 1, '2014-11-19', 5, 1, 'Esta es una descoopadea', '2014-11-06 23:24:29', '2014-11-06 23:24:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `request_attachment`
--

CREATE TABLE IF NOT EXISTS `request_attachment` (
`id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `semester`
--

INSERT INTO `semester` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, '2014 - I', '2014-11-02 17:50:46', '2014-11-02 17:50:46'),
(2, '2014 - II', '2014-11-02 17:50:46', '2014-11-02 17:50:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Aprobado', '2014-11-02 20:46:29', '2014-11-02 20:46:29'),
(2, 'Negado', '2014-11-02 20:46:29', '2014-11-02 20:46:29'),
(3, 'Diferido', '2014-11-02 20:48:04', '2014-11-02 20:48:04'),
(4, 'En cuenta', '2014-11-02 20:48:04', '2014-11-02 20:48:04'),
(5, 'Recibida', '2014-11-02 21:05:44', '2014-11-02 21:05:44'),
(6, 'En agenda', '2014-11-03 20:36:41', '2014-11-03 20:36:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_applicant`
--

CREATE TABLE IF NOT EXISTS `type_applicant` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `type_applicant`
--

INSERT INTO `type_applicant` (`id`, `name`, `create_at`, `update_at`) VALUES
(1, 'Profesor', '2014-11-03 01:16:26', '2014-11-03 01:16:26'),
(2, 'Estudiante', '2014-11-03 01:16:26', '2014-11-03 01:16:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_request`
--

CREATE TABLE IF NOT EXISTS `type_request` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `type_request`
--

INSERT INTO `type_request` (`id`, `name`, `slug`, `create_at`, `update_at`) VALUES
(1, 'Asuntos profesorales', 'asuntos-profesorales', '2014-11-02 20:18:10', '2014-11-02 20:19:03'),
(2, 'Asuntos estudiantiles', 'asuntos-estudiantiles', '2014-11-02 20:41:34', '2014-11-02 20:41:34'),
(3, 'Oriana', 'oriana', '2014-11-02 21:17:28', '2014-11-02 21:17:28'),
(4, 'Gordito', 'gordito', '2014-11-03 03:19:50', '2014-11-03 03:19:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userback`
--

CREATE TABLE IF NOT EXISTS `userback` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `userback`
--

INSERT INTO `userback` (`id`, `username`, `name`, `email`, `password`, `privilege_id`, `slug`, `create_at`, `update_at`) VALUES
(1, 'admin', 'Administrador', 'admin@admin.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'administrador', '2014-11-02 03:34:29', '2014-11-03 01:17:49'),
(2, 'cricri92', 'Oriana Ruiz', 'oriru92@gmail.com', '994519b667315632474c34d145622bc4d0ea7aab', 1, 'oriana-ruiz', '2014-11-02 06:13:36', '2014-11-03 01:17:54'),
(3, 'hflores4', 'Hector Flores', 'hecto932@gmail.com', '786bd9a52ee9af08db5c139b86cc60533ca1c7b6', 1, 'hector-flores', '2014-11-02 06:25:24', '2014-11-06 16:35:14'),
(5, 'usuario1', 'Usuario1', 'usuario1@gmail.com', 'ada6d34bca926b40be00893cabc0aeae138ea2a0', 2, 'usuario1', '2014-11-02 17:38:07', '2014-11-03 01:18:02'),
(6, 'dhrosquete', 'Daniel Rosquete', 'dhrosquete@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 'daniel-rosquete', '2014-11-02 18:28:24', '2014-11-03 01:18:04'),
(8, 'fruiz', 'Flavio Ruiz', 'fruiz@gorditocuchi.com', 'e60aaa4e7dd43e19eecaa8af7691c1bacd724e23', 2, 'flavio-ruiz', '2014-11-03 03:08:19', '2014-11-03 03:08:19'),
(9, 'm0ises2', 'Moises Alvarado', 'moisesalvarado84@gmail.com', '41fd6e5db8918e117fc38ed0c1a8bbac1b34f096', 2, 'moises-alvarado', '2014-11-05 23:31:47', '2014-11-05 23:31:47'),
(10, 'aguerra', 'Anibal Guerra', 'aguerra@gmail.com', '705dbe71b3aa50ebbbcf84ba4d3b81e4dbac870a', 2, 'anibal-guerra', '2014-11-06 06:36:35', '2014-11-06 06:36:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `applicant`
--
ALTER TABLE `applicant`
 ADD PRIMARY KEY (`id`), ADD KEY `type_applicant_id` (`type_applicant_id`), ADD KEY `dependence_id` (`dependence_id`);

--
-- Indices de la tabla `counselor`
--
ALTER TABLE `counselor`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `counselor_type`
--
ALTER TABLE `counselor_type`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dependence`
--
ALTER TABLE `dependence`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diary`
--
ALTER TABLE `diary`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `diary_attachment`
--
ALTER TABLE `diary_attachment`
 ADD PRIMARY KEY (`id`), ADD KEY `request_id` (`request_id`);

--
-- Indices de la tabla `privilege`
--
ALTER TABLE `privilege`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `request`
--
ALTER TABLE `request`
 ADD PRIMARY KEY (`id`), ADD KEY `type_request_id` (`type_request_id`), ADD KEY `status_id` (`status_id`), ADD KEY `user_id` (`applicant_id`);

--
-- Indices de la tabla `request_attachment`
--
ALTER TABLE `request_attachment`
 ADD PRIMARY KEY (`id`), ADD KEY `request_id` (`request_id`);

--
-- Indices de la tabla `semester`
--
ALTER TABLE `semester`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_applicant`
--
ALTER TABLE `type_applicant`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_request`
--
ALTER TABLE `type_request`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `userback`
--
ALTER TABLE `userback`
 ADD PRIMARY KEY (`id`), ADD KEY `privilege_id` (`privilege_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `applicant`
--
ALTER TABLE `applicant`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `counselor`
--
ALTER TABLE `counselor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `counselor_type`
--
ALTER TABLE `counselor_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `dependence`
--
ALTER TABLE `dependence`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `diary`
--
ALTER TABLE `diary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `diary_attachment`
--
ALTER TABLE `diary_attachment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `privilege`
--
ALTER TABLE `privilege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `request`
--
ALTER TABLE `request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `request_attachment`
--
ALTER TABLE `request_attachment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `semester`
--
ALTER TABLE `semester`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `type_applicant`
--
ALTER TABLE `type_applicant`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `type_request`
--
ALTER TABLE `type_request`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `userback`
--
ALTER TABLE `userback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `applicant`
--
ALTER TABLE `applicant`
ADD CONSTRAINT `applicant_ibfk_1` FOREIGN KEY (`type_applicant_id`) REFERENCES `type_applicant` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `applicant_ibfk_2` FOREIGN KEY (`dependence_id`) REFERENCES `dependence` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `diary_attachment`
--
ALTER TABLE `diary_attachment`
ADD CONSTRAINT `diary_attachment_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `request`
--
ALTER TABLE `request`
ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`type_request_id`) REFERENCES `type_request` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`applicant_id`) REFERENCES `applicant` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `request_attachment`
--
ALTER TABLE `request_attachment`
ADD CONSTRAINT `request_attachment_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `request` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `userback`
--
ALTER TABLE `userback`
ADD CONSTRAINT `userback_ibfk_1` FOREIGN KEY (`privilege_id`) REFERENCES `privilege` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
