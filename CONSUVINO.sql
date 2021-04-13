-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-04-2021 a las 00:38:31
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `CONSUVINO`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--
create  database CONSUVINO;
use CONSUVINO;
CREATE TABLE `producto` (
    `id` int(11) NOT NULL,
    `nombre` varchar(50) NOT NULL,
    `descripcion` varchar(100) NOT NULL,
    `categoria` varchar(50) NOT NULL,
    `existencia` int(11) DEFAULT 0,
    `fechaEntrada` date DEFAULT NULL,
    `cantidadEntrada` int(11) DEFAULT NULL,
    `fechaSalida` varchar(50) DEFAULT NULL,
    `cantidadSalida` int(11) DEFAULT NULL,
    `IdEmpRecibo` int(11) DEFAULT NULL,
    `IdEmpSurte` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `categoria`, `existencia`, `fechaEntrada`, `cantidadEntrada`, `fechaSalida`, `cantidadSalida`, `IdEmpRecibo`, `IdEmpSurte`) VALUES
    (1, 'Don Julio Blanco', 'TEQUILA DON JULIO BLANCO 700ML', 'Blanco, Destilados, Tequila', 0, '2021-04-13', 100, '2021-04-13', 50, 1, NULL),
    (89, 'Ron Barcelo Imperial', 'RON BARCELO IMPERIAL 750ML', 'Ron', 50, '2021-04-13', 100, '2021-04-13', 50, NULL, NULL),
    (90, 'Whisky Jack Daniel\'s', 'Whisky Jack Daniel\'s Single Barrel 700 ml.', 'whisky escocés', 50, '2021-04-13', 50, '2021-04-13', 50, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serie`
--

CREATE TABLE `serie` (
    `id` int(11) NOT NULL,
    `nombreSerie` varchar(50) NOT NULL,
    `sinopsis` varchar(300) NOT NULL,
    `actores` varchar(150) NOT NULL,
    `url` varchar(100) DEFAULT NULL,
    `fechaEstreno` varchar(50) NOT NULL,
    `activo` tinyint(4) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `serie`
--

INSERT INTO `serie` (`id`, `nombreSerie`, `sinopsis`, `actores`, `url`, `fechaEstreno`, `activo`) VALUES
    (1, 'Filmed Before a Live Studio Audience', 'La pareja de recién casados Wanda y Visión se mudan a la ciudad de Westview durante lo que parece ser la década de 1950. Intentan mezclarse, a pesar de que Visión es un androide y Wanda tiene habilidades telequinéticas.', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1ZgSBa0r2l5oN12MG3SLsLmDT3z_Fmdo0/view?usp=sharing', '2021-01-15', 1),
    (2, 'Don\'t Touch That Dial', 'Durante lo que parece ser la década de 1960, Wanda y Visión oyen extraños ruidos fuera de su casa, que parecen ser causados por una rama de árbol en la ventana. Preparan su acto de magia para un espectáculo de talentos del vecindario.', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1Zh6x_d9cH9A0qInvrre92P_PFj5cqT5v/view?usp=sharing', '2021-01-15', 1),
(3, 'Now in Color', '\r\nWanda se prepara para un parto acelerado con Visión, pero el embarazo daña sus poderes. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1ZcR9zAXE9DDI39WksEC5WEGrA08OxxGp/view?usp=sharing', '2021-01-22', 1),
(4, 'We Interrupt This Program', 'Monica Rambeau, encargada de una tarea especial con respecto a las armas sensibles, desaparece. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1ZzuKqdst3CLoHNRFufkSpLSw4ARFCHyG/view?usp=sharing', '2021-01-29', 1),
(5, 'On a Very Special Episode...', '\r\nWanda aborda las preocupaciones de Vision cuando comienza a sospechar del extraño comportamiento de los vecinos. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1_0qepIAvmiHTc8V5gu6z4GUAX1GmamKi/view?usp=sharing', '2021-02-05', 1),
(6, 'All-New Halloween Spooktacular!', '\r\nLos disturbios en Halloween separan a Wanda de Vision, quien investiga la actividad extraña en Westview. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1_20Fp1XUfo46t2McxPEPioM__FaGsyP2/view?usp=sharing', '2021-02-12', 1),
(7, 'Breaking the Fourth Wall', '\r\nMonica planea su regreso, Wanda navega por complicaciones inquietantes y Vision forma una nueva alianza. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1_ANFNvyIxW9uLC1a0x5RviKIB021aRRg/view?usp=sharing', '2021-02-19', 1),
(8, 'Previously On', 'En Salem en 1693, Agatha Harkness es juzgada por un aquelarre de brujas por practicar magia negra. Mientras intentan matarla, ella les quita la vida. En la actualidad, Agatha exige saber cómo Wanda está controlando Westview, amenazándola con la vida de sus hijos. ', 'Elizabeth Olsen, Paul bettany, Kat Dennings', 'https://drive.google.com/file/d/1_HR4Uyz6e-EZ7rVTzxrS51PTSkf4RU_w/view?usp=sharing', '2021-02-26', 1),
(9, 'No Disponible', 'No Disponible', 'No Disponible', 'No Disponible', '2021-03-05', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(11) NOT NULL,
  `pasillo` varchar(50) NOT NULL,
  `rack` varchar(50) NOT NULL,
  `nivel` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`id`, `pasillo`, `rack`, `nivel`, `idEmpleado`) VALUES
(19, '1', 'rack1', 1, 1),
(21, '10', '10', 10, 10),
(22, 'm', 'm', 566, 5),
(23, 'Pasillo66', 'rack66', 66, 6),
(24, 'b', 'b', 199, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(100) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(150) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `privilegios` varchar(30) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombreUsuario`, `usuario`, `password`, `foto`, `privilegios`, `activo`) VALUES
(124, 'Patricia Franco', 'Patricia.Franco@gmail.com', '$2y$10$TpnGKJrIH3JJazSvOJVkr.fJLxq7BcSxRD2Su1rM.5pD4.pWpWEkm', 'img/20210413_155749.jpg', 'General', 1),
(126, 'Brayan Aguayo', 'Alan.Brayan@gmail.com', '$2y$10$Yc9ss4oanC1gyxBPdYqvTuLSqF5nT5/9OYhylhMmiZQQfxpFdRB7G', 'img/20210413_155750.jpeg', 'General', 1),
(127, 'Rodrigo Hernandez', 'Rodrigo.Hernandez@gmail.com', '$2y$10$5BmmWlPvRV1tFLsXuTWAOu0RaheUt9grpebepATDQqeac84muX3Qu', 'img/IMG-20210413-WA0005.jpg', 'Administrador', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT de la tabla `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;