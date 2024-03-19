-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-03-2024 a las 16:05:54
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
-- Base de datos: `bd_agrocosecha`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle`
--

CREATE TABLE `tbl_detalle` (
  `num_ticket` int(11) NOT NULL,
  `precio_unitario` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` float NOT NULL,
  `cod_producto` int(11) NOT NULL,
  `cod_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_detalle`
--

INSERT INTO `tbl_detalle` (`num_ticket`, `precio_unitario`, `cantidad`, `total`, `cod_producto`, `cod_venta`) VALUES
(12344, 5654, 10, 55676, 1, 12);

--
-- Disparadores `tbl_detalle`
--
DELIMITER $$
CREATE TRIGGER `actualizar_stock` AFTER INSERT ON `tbl_detalle` FOR EACH ROW BEGIN
UPDATE tbl_producto SET stock = stock - NEW.cantidad
WHERE new.cod_producto=tbl_producto.codigo_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_imagen`
--

CREATE TABLE `tbl_imagen` (
  `codigo_imagen` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `cod_servicio` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `codigo_persona` int(11) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `primer_nombre` varchar(50) NOT NULL,
  `segundo_nombre` varchar(50) NOT NULL,
  `primer_apellido` varchar(50) NOT NULL,
  `segundo_apellido` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `cod_sexo` int(11) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`codigo_persona`, `identificacion`, `primer_nombre`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `telefono`, `correo`, `cod_sexo`, `fecha_nacimiento`, `direccion`, `fecha_creacion`) VALUES
(1, 1001030201, 'harold', 'andres', 'ortega', 'teheran', '3205113702', 'harold@gmail.com', 1, '2003-06-12', 'fundadores', '2024-02-13'),
(33, 987348398, 'braider', 'dario', 'urango', 'cabrera', '8768768768', 'dario@gmail.com', 1, '2024-02-19', 'rio grande', '2024-02-21'),
(35, 12345, 'dery', 'andres', 'torrez', 'garcia', '5645', 'dery@gmail.com', 2, '2024-02-19', 'fundadores', '2024-02-21'),
(52, 3453453, 'dario', '', 'urango', '', '097897', 'derbrai@gmail.com', 1, '2024-02-15', 'rio grande', '2024-02-28'),
(65, 21423423, 'manuel', '', 'gutierrez', '', '342626358', 'manuel@gmail.com', 1, '2003-06-12', 'apartado', '2024-03-11'),
(66, 4532352, 'manolo', '', 'mendez', '', '323235654', 'manolo@gmail.com', 1, '2005-07-05', 'poray', '2024-03-05'),
(69, 43443645, 'manolito', '', 'mendez', '', '343542232', 'manolito@gmail.com', 1, '1998-06-05', 'poray', '2024-03-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_per_prod`
--

CREATE TABLE `tbl_per_prod` (
  `codigo` int(11) NOT NULL,
  `cod_persona` int(11) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_per_ser`
--

CREATE TABLE `tbl_per_ser` (
  `codigo` int(11) NOT NULL,
  `cod_persona` int(11) NOT NULL,
  `cod_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `codigo_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `video` varchar(200) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`codigo_producto`, `nombre`, `descripcion`, `precio`, `stock`, `video`, `fecha_registro`) VALUES
(1, 'arroz', 'programar es como hacer arroz', 5000000000, 10, 'hola mundo!!!', '2024-02-13'),
(767588678, 'aguacate', 'el aguacate es una fruta', 78576, 6899, 'khfydfghjh', '2024-02-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedor`
--

CREATE TABLE `tbl_proveedor` (
  `nit` varchar(15) NOT NULL,
  `nombre_razonsocial` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nom_per_contacto` varchar(30) NOT NULL,
  `tel_contacto` varchar(15) NOT NULL,
  `correo_contacto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_proveedor`
--

INSERT INTO `tbl_proveedor` (`nit`, `nombre_razonsocial`, `telefono`, `correo`, `nom_per_contacto`, `tel_contacto`, `correo_contacto`) VALUES
('2423543-4', 'agrocosecha', '3132234325', 'agro@gmail.com', 'darwin', '345465', 'darwin@gmail.com'),
('32422453453', 'proveedor', '3121342342', 'proveedor@gmail.com', 'juan', '323434238', 'juan@gmail.com'),
('32482934', 'helados h', '5371365578', 'heladosH@gmail.com', 'harold', '6326327678', 'harold@gmail.com'),
('3264263-4357', 'darwinianos', '3762548997', 'darwinianos@gmail.com', 'miguel', '3726823768', 'miguel@gmail.com'),
('95548-8', 'juan  jose ', '3138608446', 'juan@gmail.com', 'jose', '31389634', 'jose@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_prov_prod`
--

CREATE TABLE `tbl_prov_prod` (
  `codigo` int(11) NOT NULL,
  `nit_proveedor` varchar(15) NOT NULL,
  `cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_prov_prod`
--

INSERT INTO `tbl_prov_prod` (`codigo`, `nit_proveedor`, `cod_producto`) VALUES
(1, '2423543-4', 1),
(2, '3264263-4357', 767588678),
(5, '2423543-4', 767588678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_servicio`
--

CREATE TABLE `tbl_servicio` (
  `codigo_servicio` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` float NOT NULL,
  `duracion` int(3) NOT NULL,
  `fecha_registro` date NOT NULL,
  `cod_tipo_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_servicio`
--

INSERT INTO `tbl_servicio` (`codigo_servicio`, `nombre`, `descripcion`, `precio`, `duracion`, `fecha_registro`, `cod_tipo_servicio`) VALUES
(57567, 'fdfsdg', 'dffdhfhgfdg', 345, 45, '2024-02-27', 2),
(877687, 'jhgjhgjk', 'kugkjhvgvh', 78009, 89, '2024-02-21', 1),
(5645654, 'juan jose', 'juanadsjsiuj', 94789, 98, '2024-03-13', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sexo`
--

CREATE TABLE `tbl_sexo` (
  `codigo_sexo` int(11) NOT NULL,
  `sexo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_sexo`
--

INSERT INTO `tbl_sexo` (`codigo_sexo`, `sexo`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_servicio`
--

CREATE TABLE `tbl_tipo_servicio` (
  `codigo_tipo_servicio` int(11) NOT NULL,
  `tipo_servicio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_servicio`
--

INSERT INTO `tbl_tipo_servicio` (`codigo_tipo_servicio`, `tipo_servicio`) VALUES
(1, 'alquiler de equipos'),
(2, 'servicios personales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_usuario`
--

CREATE TABLE `tbl_tipo_usuario` (
  `codigo_tipo_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_usuario`
--

INSERT INTO `tbl_tipo_usuario` (`codigo_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'administrador'),
(2, 'cliente'),
(3, 'proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `codigo_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `cod_persona` int(11) DEFAULT NULL,
  `cod_tipo_usuario` int(11) NOT NULL,
  `nit_proveedor` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`codigo_usuario`, `usuario`, `contrasena`, `cod_persona`, `cod_tipo_usuario`, `nit_proveedor`) VALUES
(5, 'Harold', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 1, NULL),
(31, 'agrocosecha', '43cfb601f7ce3675c2361cb578cb0d2b6f109adc', NULL, 3, '2423543-4'),
(33, 'jose', '3e8306d204cb86f1ecd67c5f820c8ccf19090088', NULL, 3, '95548-8'),
(43, 'dario', '352ec802e20730b5bf7bd240a4b58a822a472a27', 33, 2, NULL),
(45, 'dery', '7cf8cc32538cf4e7a78dc764aebf0aaf2a0e3045', 35, 2, NULL),
(67, 'derbrai', '797615f36867ec6826c39e19f95e67f648dec093', 52, 1, NULL),
(73, 'manolo', '0d18e2b6d68973f0f02c17c97e4765f716eca440', 66, 2, NULL),
(86, 'heladosH', 'heladosh', NULL, 3, '32482934'),
(87, 'holaproveedor', '123456', NULL, 3, '32422453453'),
(92, 'manuel150', '123', 65, 2, NULL),
(117, 'darwinianos', '8cb2237d0679ca88db6464eac60da96345513964', NULL, 3, '3264263-4357');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_venta`
--

CREATE TABLE `tbl_venta` (
  `codigo_venta` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `sub_total` float NOT NULL,
  `total_venta` float NOT NULL,
  `iva` float NOT NULL,
  `cod_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_venta`
--

INSERT INTO `tbl_venta` (`codigo_venta`, `fecha_venta`, `direccion`, `sub_total`, `total_venta`, `iva`, `cod_persona`) VALUES
(12, '2024-02-13', 'carepa', 0, 0, 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_detalle`
--
ALTER TABLE `tbl_detalle`
  ADD PRIMARY KEY (`num_ticket`),
  ADD KEY `cod_producto` (`cod_producto`),
  ADD KEY `cod_venta` (`cod_venta`);

--
-- Indices de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  ADD PRIMARY KEY (`codigo_imagen`),
  ADD KEY `cod_servicio` (`cod_servicio`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`codigo_persona`),
  ADD KEY `cod_sexo` (`cod_sexo`);

--
-- Indices de la tabla `tbl_per_prod`
--
ALTER TABLE `tbl_per_prod`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cod_persona` (`cod_persona`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tbl_per_ser`
--
ALTER TABLE `tbl_per_ser`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cod_persona` (`cod_persona`),
  ADD KEY `cod_servicio` (`cod_servicio`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`codigo_producto`);

--
-- Indices de la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `tbl_prov_prod`
--
ALTER TABLE `tbl_prov_prod`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `cod_producto` (`cod_producto`),
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `tbl_servicio`
--
ALTER TABLE `tbl_servicio`
  ADD PRIMARY KEY (`codigo_servicio`),
  ADD KEY `cod_tipo_servicio` (`cod_tipo_servicio`);

--
-- Indices de la tabla `tbl_sexo`
--
ALTER TABLE `tbl_sexo`
  ADD PRIMARY KEY (`codigo_sexo`);

--
-- Indices de la tabla `tbl_tipo_servicio`
--
ALTER TABLE `tbl_tipo_servicio`
  ADD PRIMARY KEY (`codigo_tipo_servicio`);

--
-- Indices de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  ADD PRIMARY KEY (`codigo_tipo_usuario`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD KEY `cod_persona` (`cod_persona`),
  ADD KEY `cod_tipo_usuario` (`cod_tipo_usuario`),
  ADD KEY `nit_proveedor` (`nit_proveedor`);

--
-- Indices de la tabla `tbl_venta`
--
ALTER TABLE `tbl_venta`
  ADD PRIMARY KEY (`codigo_venta`),
  ADD KEY `cod_persona` (`cod_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_detalle`
--
ALTER TABLE `tbl_detalle`
  MODIFY `num_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12345;

--
-- AUTO_INCREMENT de la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  MODIFY `codigo_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  MODIFY `codigo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `tbl_per_prod`
--
ALTER TABLE `tbl_per_prod`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_per_ser`
--
ALTER TABLE `tbl_per_ser`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `codigo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=767588679;

--
-- AUTO_INCREMENT de la tabla `tbl_prov_prod`
--
ALTER TABLE `tbl_prov_prod`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_servicio`
--
ALTER TABLE `tbl_servicio`
  MODIFY `codigo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `tbl_sexo`
--
ALTER TABLE `tbl_sexo`
  MODIFY `codigo_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_servicio`
--
ALTER TABLE `tbl_tipo_servicio`
  MODIFY `codigo_tipo_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_usuario`
--
ALTER TABLE `tbl_tipo_usuario`
  MODIFY `codigo_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de la tabla `tbl_venta`
--
ALTER TABLE `tbl_venta`
  MODIFY `codigo_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_detalle`
--
ALTER TABLE `tbl_detalle`
  ADD CONSTRAINT `tbl_detalle_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_producto` (`codigo_producto`),
  ADD CONSTRAINT `tbl_detalle_ibfk_2` FOREIGN KEY (`cod_venta`) REFERENCES `tbl_venta` (`codigo_venta`);

--
-- Filtros para la tabla `tbl_imagen`
--
ALTER TABLE `tbl_imagen`
  ADD CONSTRAINT `tbl_imagen_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_producto` (`codigo_producto`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_imagen_ibfk_2` FOREIGN KEY (`cod_servicio`) REFERENCES `tbl_servicio` (`codigo_servicio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD CONSTRAINT `tbl_persona_ibfk_1` FOREIGN KEY (`cod_sexo`) REFERENCES `tbl_sexo` (`codigo_sexo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_per_prod`
--
ALTER TABLE `tbl_per_prod`
  ADD CONSTRAINT `tbl_per_prod_ibfk_1` FOREIGN KEY (`cod_persona`) REFERENCES `tbl_persona` (`codigo_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_per_prod_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_producto` (`codigo_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_per_ser`
--
ALTER TABLE `tbl_per_ser`
  ADD CONSTRAINT `tbl_per_ser_ibfk_1` FOREIGN KEY (`cod_persona`) REFERENCES `tbl_persona` (`codigo_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_per_ser_ibfk_2` FOREIGN KEY (`cod_servicio`) REFERENCES `tbl_servicio` (`codigo_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_prov_prod`
--
ALTER TABLE `tbl_prov_prod`
  ADD CONSTRAINT `tbl_prov_prod_ibfk_1` FOREIGN KEY (`nit_proveedor`) REFERENCES `tbl_proveedor` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_prov_prod_ibfk_2` FOREIGN KEY (`cod_producto`) REFERENCES `tbl_producto` (`codigo_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_servicio`
--
ALTER TABLE `tbl_servicio`
  ADD CONSTRAINT `tbl_servicio_ibfk_1` FOREIGN KEY (`cod_tipo_servicio`) REFERENCES `tbl_tipo_servicio` (`codigo_tipo_servicio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`cod_persona`) REFERENCES `tbl_persona` (`codigo_persona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_usuario_ibfk_3` FOREIGN KEY (`nit_proveedor`) REFERENCES `tbl_proveedor` (`nit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_usuario_ibfk_4` FOREIGN KEY (`cod_tipo_usuario`) REFERENCES `tbl_tipo_usuario` (`codigo_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_venta`
--
ALTER TABLE `tbl_venta`
  ADD CONSTRAINT `tbl_venta_ibfk_1` FOREIGN KEY (`cod_persona`) REFERENCES `tbl_persona` (`codigo_persona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
