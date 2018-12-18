-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2018 a las 03:33:03
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pos-sys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Productos Electromecánicos', '2018-08-10 01:32:07'),
(3, 'Taladros', '2018-08-07 20:12:58'),
(4, 'Andámios', '2018-08-07 20:18:42'),
(5, 'Generadores de energía', '2018-08-07 20:18:55'),
(6, 'Equipos para construcción', '2018-08-07 20:19:25'),
(7, 'Soldadura', '2018-08-08 02:34:55'),
(8, 'Taladros', '2018-08-07 21:44:58'),
(9, 'Andámios', '2018-08-07 21:49:34'),
(11, 'Taladros', '2018-08-07 21:59:34'),
(14, 'compresores', '2018-08-08 04:31:38'),
(15, 'Alfombras', '2018-08-09 17:52:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `ultima_compra`, `fecha`) VALUES
(3, 'Miguel Villegas', 1213141516, 'mail@email.com', '(506)5555-5555', 'Calle 25. Entre Avenidas 23 y 25', '2000-12-04', 0, '2000-09-05 00:00:00', '2018-09-06 00:36:02'),
(4, 'Marino Cruz', 2122232425, 'mail@anymail.com', '(507)4544-2384', 'Avenida cualquiera calle donde sea casa #xx', '1984-03-12', -2, '0000-00-00 00:00:00', '2018-09-06 00:43:08'),
(5, 'Guillermo Larrea', 2147483647, 'unmail@fastmail.com', '(110)1112-3334', 'A la vuelta de donde cortaron el antiguo palo de mamon criollo 25 sur y 50 oeste', '2030-10-11', 0, '0000-00-00 00:00:00', '2018-09-06 00:34:51'),
(6, 'Feliz Camareno', 2147483647, 'fc@gamil.com', '(346)7449-5885', '34 calle Santi Maldonado Y Picudo', '2012-03-04', -5, '0000-00-00 00:00:00', '2018-09-06 00:43:55'),
(7, 'Mauricio Alpizar', 34567890, 'alpizar@gmail.com', '(345)4567-8902', '34 calle Santi Maldonado Y Picudo', '2087-06-05', 8, '2018-09-06 19:00:10', '2018-09-07 01:00:10'),
(9, 'Ariel Valentinuzzi', 6329193, 'avalentinuzzi@disruptifcr.com', '(506)8416-2346', 'Costado Oeste tribunales de Justicia. Puntarenas', '1983-05-13', 2, '2018-09-06 10:18:38', '2018-09-06 16:18:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `idCategoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(1, 1, '101', 'Aspiradora Industrial ', 'view/img/productos/101/634.png', 0, 1500, 2100, 0, '2018-08-21 19:57:06'),
(2, 1, '102', 'Plato Flotante para Allanadora', 'view/img/productos/101/106.jpg', 12, 4500, 6300, -3, '2018-09-06 00:43:55'),
(3, 1, '103', 'Compresor de Aire para pintura', 'view/img/productos/103/730.jpg', 18, 3000, 4200, -2, '2018-09-06 00:43:08'),
(4, 1, '104', 'Cortadora de Adobe sin Disco ', 'view/img/productos/104/294.jpg', 19, 4000, 5600, 1, '2018-09-06 16:18:38'),
(5, 1, '105', 'Cortadora de Piso sin Disco ', 'view/img/productos/default/anonymous.png', 29, 1540, 2156, 1, '2018-09-06 16:18:38'),
(6, 1, '106', 'Disco Punta Diamante ', '', 22, 1100, 1540, -2, '2018-09-06 00:43:55'),
(7, 1, '107', 'Extractor de Aire ', '', 20, 1540, 2156, 0, '2018-09-06 00:41:51'),
(8, 1, '108', 'Guada?adora ', '', 20, 1540, 2156, 0, '2018-09-06 00:41:56'),
(9, 1, '109', 'Hidrolavadora El?ctrica ', '', 20, 2600, 3640, 0, '2018-09-06 00:42:01'),
(10, 1, '110', 'Hidrolavadora Gasolina', '', 20, 2210, 3094, 0, '2018-09-06 00:42:05'),
(11, 1, '111', 'Motobomba a Gasolina', '', 20, 2860, 4004, 0, '2018-08-08 17:20:44'),
(12, 1, '112', 'Motobomba El?ctrica', '', 20, 2400, 3360, 0, '2018-08-08 17:20:44'),
(13, 1, '113', 'Sierra Circular ', '', 20, 1100, 1540, 0, '2018-08-08 17:20:44'),
(14, 1, '114', 'Disco de tugsteno para Sierra circular', '', 20, 4500, 6300, 0, '2018-09-06 00:40:40'),
(15, 1, '115', 'Soldador Electrico ', '', 20, 1980, 2772, 0, '2018-08-08 17:20:44'),
(16, 1, '116', 'Careta para Soldador', '', 20, 4200, 5880, 0, '2018-08-08 17:20:44'),
(17, 1, '117', 'Torre de iluminacion ', '', 20, 1800, 2520, 0, '2018-08-08 17:20:44'),
(18, 2, '201', 'Martillo Demoledor de Piso 110V', '', 20, 5600, 7840, 0, '2018-08-08 17:20:44'),
(19, 2, '202', 'Muela o cincel martillo demoledor piso', '', 20, 9600, 13440, 0, '2018-08-08 17:20:44'),
(20, 2, '203', 'Taladro Demoledor de muro 110V', '', 20, 3850, 5390, 0, '2018-08-08 17:20:44'),
(21, 2, '204', 'Muela o cincel martillo demoledor muro', '', 20, 9600, 13440, 0, '2018-08-08 17:20:44'),
(22, 2, '205', 'Taladro Percutor de 1/2 Madera y Metal', '', 20, 8000, 11200, 0, '2018-08-09 03:51:11'),
(23, 2, '206', 'Taladro Percutor SDS Plus 110V', '', 20, 3900, 5460, 0, '2018-08-08 17:20:44'),
(24, 2, '207', 'Taladro Percutor SDS Max 110V (Mineria)', '', 20, 4600, 6440, 0, '2018-08-08 17:20:44'),
(25, 3, '301', 'Andamio colgante', '', 20, 1440, 2016, 0, '2018-08-08 17:20:44'),
(26, 3, '302', 'Distanciador andamio colgante', '', 20, 1600, 2240, 0, '2018-08-08 17:20:44'),
(27, 3, '303', 'Marco andamio modular ', '', 20, 900, 1260, 0, '2018-08-08 17:20:44'),
(28, 3, '304', 'Marco andamio tijera', '', 20, 100, 140, 0, '2018-08-08 17:20:44'),
(29, 3, '305', 'Tijera para andamio', '', 20, 162, 226, 0, '2018-08-08 17:20:44'),
(30, 3, '306', 'Escalera interna para andamio', '', 20, 270, 378, 0, '2018-08-08 17:20:44'),
(31, 3, '307', 'Pasamanos de seguridad', '', 20, 75, 105, 0, '2018-08-08 17:20:44'),
(32, 3, '308', 'Rueda giratoria para andamio', '', 20, 168, 235, 0, '2018-08-08 17:20:44'),
(33, 3, '309', 'Arnes de seguridad', '', 20, 1750, 2450, 0, '2018-08-08 17:20:44'),
(34, 3, '310', 'Eslinga para arnes', '', 20, 175, 245, 0, '2018-08-08 17:20:44'),
(35, 3, '311', 'Plataforma Met?lica', '', 20, 420, 588, 0, '2018-08-08 17:20:44'),
(36, 4, '401', 'Planta Electrica Diesel 6 Kva', '', 20, 3500, 4900, 0, '2018-09-06 00:40:08'),
(37, 4, '402', 'Planta Electrica Diesel 10 Kva', '', 20, 3550, 4970, 0, '2018-08-08 17:20:44'),
(38, 4, '403', 'Planta Electrica Diesel 20 Kva', '', 20, 3600, 5040, 0, '2018-08-08 17:20:44'),
(39, 4, '404', 'Planta Electrica Diesel 30 Kva', '', 20, 3650, 5110, 0, '2018-08-08 17:20:44'),
(40, 4, '405', 'Planta Electrica Diesel 60 Kva', '', 20, 3700, 5180, 0, '2018-08-08 17:20:44'),
(41, 4, '406', 'Planta Electrica Diesel 75 Kva', '', 20, 3750, 5250, 0, '2018-08-08 17:20:44'),
(42, 4, '407', 'Planta Electrica Diesel 100 Kva', '', 20, 3800, 5320, 0, '2018-08-08 17:20:44'),
(43, 4, '408', 'Planta Electrica Diesel 120 Kva', '', 20, 3850, 5390, 0, '2018-08-08 17:20:44'),
(44, 5, '501', 'Escalera de Tijera Aluminio ', '', 20, 350, 490, 0, '2018-08-08 17:20:44'),
(45, 5, '502', 'Extension Electrica ', '', 20, 370, 518, 0, '2018-08-08 17:20:44'),
(46, 5, '503', 'Gato tensor', '', 20, 380, 532, 0, '2018-08-08 17:20:44'),
(47, 5, '504', 'Lamina Cubre Brecha ', '', 20, 380, 532, 0, '2018-09-06 00:40:00'),
(48, 5, '505', 'Llave de Tubo', '', 20, 480, 672, 0, '2018-08-08 17:20:44'),
(49, 5, '506', 'Manila por Metro', '', 20, 600, 840, 0, '2018-08-08 17:20:44'),
(50, 5, '507', 'Polea 2 canales', '', 20, 900, 1260, 0, '2018-08-08 17:20:44'),
(51, 5, '508', 'Tensor', '', 20, 100, 140, 0, '2018-08-08 17:20:44'),
(52, 5, '509', 'Bascula ', '', 20, 130, 182, 0, '2018-08-08 17:20:44'),
(53, 5, '510', 'Bomba Hidrostatica', '', 19, 770, 1078, 1, '2018-09-07 01:00:09'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '2018-08-08 17:20:44'),
(55, 5, '512', 'Cilindro muestra de concreto', '', 20, 400, 560, 0, '2018-08-08 17:20:44'),
(56, 5, '513', 'Cizalla de Palanca', '', 19, 450, 630, 1, '2018-09-07 01:00:09'),
(57, 5, '514', 'Cizalla de Tijera', '', 20, 580, 812, 0, '2018-08-08 17:20:44'),
(58, 5, '515', 'Coche llanta neumatica', '', 20, 420, 588, 0, '2018-08-08 17:20:44'),
(59, 5, '516', 'Cono slump', '', 20, 140, 196, 0, '2018-08-08 17:20:44'),
(60, 5, '517', 'Cortadora de Baldosin', '', 14, 930, 1302, 6, '2018-09-07 01:00:09'),
(61, 3, '312', 'Super Taladro ultimo deluxe', 'view/img/productos/default/anonymous.png', 20, 355, 497, 0, '2018-09-06 00:39:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Tester Admin', 'Admin', '$2a$07$usesomesillystringforeGsJAIIu7nhlxWq.cvdNluLcR1KdMYnq', 'Administrador', 'view/img/usuarios/Admin/484.jpg', 1, '2018-09-07 18:36:42', '2018-09-08 00:36:42'),
(9, 'Ana Gonzales', 'Ana', '$2a$07$usesomesillystringforeGsJAIIu7nhlxWq.cvdNluLcR1KdMYnq', 'Especial', 'view/img/usuarios/Ana/667.jpg', 1, '2018-09-07 18:59:33', '2018-09-08 00:59:33'),
(10, 'Julio Jaramillo', 'Julio', '$2a$07$usesomesillystringforeGsJAIIu7nhlxWq.cvdNluLcR1KdMYnq', 'Vendedor', 'view/img/usuarios/Julio/216.png', 1, '2018-09-07 18:48:20', '2018-09-08 00:48:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `id_vendedor`, `id_cliente`, `productos`, `impuesto`, `neto`, `total`, `metodo_pago`, `fecha`) VALUES
(1, 10001, 9, 4, '[{\"id\":\"3\",\"descripcion\":\"Compresor de Aire para pintura\",\"cantidad\":\"1\",\"stock\":\"8\",\"precio\":\"4200\",\"total\":\"4200\"}]', 546, 4200, 4746, 'TC-9876543', '2018-09-05 17:57:27'),
(2, 10002, 1, 5, '[{\"id\":\"9\",\"descripcion\":\"Hidrolavadora El?ctrica \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"3640\",\"total\":\"3690\"},{\"id\":\"10\",\"descripcion\":\"Hidrolavadora Gasolina\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"3094\",\"total\":\"7088\"}]', 1401.14, 10778, 12179.1, 'efectivo', '2018-09-05 19:33:59'),
(3, 10003, 1, 5, '[{\"id\":\"8\",\"descripcion\":\"Guada?adora \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"2156\",\"total\":\"4500\"}]\r\n', 280.28, 2156, 2436.28, 'TD-2345678', '2018-08-24 17:50:34'),
(4, 10004, 9, 6, '[{\"id\":\"6\",\"descripcion\":\"Disco Punta Diamante \",\"cantidad\":\"2\",\"stock\":\"11\",\"precio\":\"1540\",\"total\":\"3080\"},{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"3\",\"stock\":\"14\",\"precio\":\"6300\",\"total\":\"18900\"}]', 2857.4, 21980, 24837.4, 'TC-123456789', '2018-09-05 18:59:46'),
(5, 10005, 9, 7, '[{\"id\":\"2\",\"descripcion\":\"Plato Flotante para Allanadora\",\"cantidad\":\"2\",\"stock\":\"13\",\"precio\":\"6300\",\"total\":\"2\"}]', 0.26, 2, 2.26, 'TC-8976543567', '2018-09-05 19:34:31'),
(6, 10006, 9, 7, '[{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"3\",\"stock\":\"10\",\"precio\":\"5600\",\"total\":\"3\"}]', 0.39, 3, 0, 'efectivo', '2018-09-05 19:32:33'),
(11, 10007, 1, 9, '[{\"id\":\"4\",\"descripcion\":\"Cortadora de Adobe sin Disco \",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"5600\",\"total\":\"5600\"},{\"id\":\"5\",\"descripcion\":\"Cortadora de Piso sin Disco \",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"2156\",\"total\":\"2156\"}]', 1008.28, 7756, 8764.28, 'efectivo', '2018-09-06 16:18:38'),
(12, 10008, 1, 7, '[{\"id\":\"60\",\"descripcion\":\"Cortadora de Baldosin\",\"cantidad\":\"6\",\"stock\":\"14\",\"precio\":\"1302\",\"total\":\"7812\"},{\"id\":\"56\",\"descripcion\":\"Cizalla de Palanca\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"630\",\"total\":\"630\"},{\"id\":\"53\",\"descripcion\":\"Bomba Hidrostatica\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"1078\",\"total\":\"1078\"}]', 1237.6, 9520, 10757.6, 'TC-47589047363850', '2018-09-07 01:00:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
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
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
