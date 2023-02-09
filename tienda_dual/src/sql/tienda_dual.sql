-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-02-2023 a las 15:05:04
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_dual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `descripcion`, `img`) VALUES
(1, 'Terror clásico', 'categoria desc', 'signalis-banner.jpg'),
(13, 'Roguelike', 'Subgénero de los videojuegos de rol que se caracterizan por una aventura a través de laberintos, a través de niveles generados por procedimientos al azar, videojuegos basados en turnos, gráficos basados en fichas y la muerte permanente del personaje del jugador.', 'dead-cells-banner.jpg'),
(14, 'Indie', 'Juegos indie', 'outer-wilds-banner.jpg'),
(15, 'Acción', '', 'hellsinger-banner.jpg'),
(16, 'Aventura', '', 'elden-ring-banner.jpg'),
(17, 'JRPG', 'RPG\'s japos', 'yakuza-like-a-dragon-banner.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `precio_total` double NOT NULL,
  `fecha_pedido` datetime NOT NULL DEFAULT current_timestamp(),
  `codigo_pedido` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `precio_total`, `fecha_pedido`, `codigo_pedido`, `id_usuario`) VALUES
(13, 5.6453, '2023-02-02 11:11:19', 'FWx4uhVMam', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_usuario`
--

CREATE TABLE `perfil_usuario` (
  `id_perfil_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripción` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `id_privilegio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`id_privilegio`, `nombre`, `descripcion`) VALUES
(1, 'admin', ''),
(2, 'asd', 'asd'),
(5, '2d3', '2fino3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` text NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `precio`, `descripcion`, `id_categoria`) VALUES
(5, 'Vampire Survivors', 3.99, '', 13),
(6, 'Elden Ring', 59.99, 'aasd', 16),
(7, 'Hades II', 19.99, 'Battle beyond the Underworld using dark sorcery to take on the Titan of Time in this bewitching sequel to the award-winning rogue-like dungeon crawler.', 13),
(8, 'Hades', 19.99, 'Desafía al dios de los muertos y protagoniza una salvaje fuga del Inframundo en este juego de exploración de mazmorras de los creadores de Bastion, Transistor y Pyre.', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagen`
--

CREATE TABLE `producto_imagen` (
  `id_producto_imagen` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_imagen`
--

INSERT INTO `producto_imagen` (`id_producto_imagen`, `nombre`, `descripcion`, `imagen`, `id_producto`) VALUES
(28, 'Vampire Survivors', '', 'vampire-survivors-banner.jpg', 5),
(29, 'Hades II', '', 'hadesII-banner.jpg', 7),
(30, 'Hades', '', 'hades-banner.jpg', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `id_privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `username`, `password`, `email`, `id_privilegio`) VALUES
(11, 'Admin', 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'admin@gmail.com', 1),
(16, 'Usuario', 'usuario', 'b665e217b51994789b02b1838e730d6b93baa30f', 'usuario@gmail.com', 5),
(18, 'nombre', 'usuario', 'b665e217b51994789b02b1838e730d6b93baa30f', 'asd@gmail.com', 1),
(19, 'asddasasd', 'asd', '148dd2bd2c00aeef39a1323fd4466cfc1152986d', 'asd', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `codigo_pedido` (`codigo_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  ADD PRIMARY KEY (`id_perfil_usuario`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD PRIMARY KEY (`id_producto_imagen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `perfil_usuario`
--
ALTER TABLE `perfil_usuario`
  MODIFY `id_perfil_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  MODIFY `id_producto_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `producto_imagen`
--
ALTER TABLE `producto_imagen`
  ADD CONSTRAINT `producto_imagen_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegio` (`id_privilegio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
