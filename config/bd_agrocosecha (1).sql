-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2024 a las 23:52:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

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
  `cod_servicio` int(11) DEFAULT NULL,
  `cod_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_imagen`
--

INSERT INTO `tbl_imagen` (`codigo_imagen`, `foto`, `cod_servicio`, `cod_producto`) VALUES
(1, '5cc67d492076dc11319d7bba63c78e36_arroz.jpg', NULL, 1),
(2, '9a9d1832f1949106d468467273fb7583_arroz.png', NULL, 1),
(3, '950d674569d88ca10277701562996cf5_arroz.png', NULL, 1),
(4, 'de655ba88420e7467db1a0d5633c4620_arroz.jpg', NULL, 1),
(5, '054c5c3e219fcb8c3cf9cbd05965ed05_arroz.png', NULL, 1),
(6, '670217e899f1614849c0cd38c2139500_arroz.png', NULL, 1),
(231, '7b28929557c8ee4fdbaaa765921de80c_Gallinas criollas.webp', NULL, 5678),
(232, '363f231f5a6f9412270827a2139b3dc9_Gallinas criollas.webp', NULL, 5678),
(233, '6d1bad15a57b194c77f7f7420f1afd49_Gallinas criollas.webp', NULL, 5678),
(234, '43f23ce77d74b1f6f42acf1508c324fe_Gallinas criollas.webp', NULL, 5678),
(235, '48872bb8ffeef918c917bc9d1204f329_Pollos.webp', NULL, 321),
(236, 'b3f8d48e717c294f3ba78f89921d2367_Pollos.webp', NULL, 321),
(237, 'cd1a1a60881263212393e4927e4308f1_Pollos.webp', NULL, 321),
(238, '24af895c7f69c921ef4dfb9f8cbc3028_Cerdos.webp', NULL, 879),
(239, 'a6fab01e9b3925fed4602cf516d54ac2_Cerdos.webp', NULL, 879),
(240, '0a6e0032104fafea58358678b022da8d_Cerdos.webp', NULL, 879),
(241, 'c879d79a520163a73b07da2bb4dbc0f8_Cerdos.webp', NULL, 879),
(242, 'd58519336cc8179fd7f4a5cf3b7b2672_Ponedoras.webp', NULL, 9876),
(243, '4b99cf1c85373ac30fae7633dff31382_Ponedoras.webp', NULL, 9876),
(244, 'c6ea39e67ff846302c6832a3b684db0a_Ponedoras.webp', NULL, 9876),
(245, 'f335d43d35dbf80bc1eaaa0be4a76f74_Ponedoras.webp', NULL, 9876),
(246, '356ea23e225c45c4848b32f882b0fd22_Ganado.webp', NULL, 45675),
(247, 'ca0f8a9992a553d8c3d188575c9f382d_Ganado.webp', NULL, 45675),
(248, '5b354cebfdaab7ac49e88127ebd98a30_Ganado.webp', NULL, 45675),
(249, '798bbf5fb55015af7041a80a62b880c2_Ganado.webp', NULL, 45675),
(250, '456028ca2b1bf9aee2810c89ee3cc8fc_Yuca.webp', NULL, 4432),
(251, '688f018fbe036abe47e0fc386280103d_Yuca.webp', NULL, 4432),
(252, 'ae1648e764f1fe2ae42590f4a1f64842_Yuca.webp', NULL, 4432),
(253, '71bdaa55055886ec5f0df4b5ae821b5a_Yuca.webp', NULL, 4432),
(254, '2cdb05061e7048011cc61bb3318bbdb5_Platano.webp', NULL, 2231),
(255, 'd7eb8c242ceaa72a930d563e2b1e41c9_Platano.webp', NULL, 2231),
(256, '1d35975ed4a8d95819d4e85c7515b2e6_Platano.webp', NULL, 2231),
(257, '3a131c82f0291593c2cdeab1ad5ad261_Platano.webp', NULL, 2231),
(258, '63500c5aea1ea1645d831547247643ad_Peces.webp', NULL, 9987),
(259, '1b6ed5c466e77f8e4b24776b6ab46ba9_Peces.webp', NULL, 9987),
(260, '97fd6c107b5e19144a77be48ed03089d_Peces.webp', NULL, 9987),
(261, 'fd20627afd18237cdf573ed165186359_Peces.webp', NULL, 9987),
(267, 'b6448e9c512b94c9d49a58f290e614ac_Fumigacion.webp', 3452, NULL),
(268, '6f9702cd993ac9da6ce90eecdecf0e69_Fumigacion.webp', 3452, NULL),
(269, '3774a79a745ea12fae6b80b6f33110f1_Fumigacion.webp', 3452, NULL),
(270, '33cbecd322ca3b49a02f92e1d37ed2bc_Fumigacion.webp', 3452, NULL),
(271, '1a54b37f15e576897226b1feac4cde5e_Abono.webp', 2421, NULL),
(272, '38f10c70113310a17911dd1b3a431de9_Abono.webp', 2421, NULL),
(273, 'cd564ade8f0fe47712fb70af66aac1ec_Abono.webp', 2421, NULL),
(274, '8f55781969b83b2e82a71671765dd858_Abono.webp', 2421, NULL),
(275, 'cb539bf9ddd85b5fbaac84f7ea4547fd_Fumigacion.webp', 987, NULL),
(276, '38835b36e8a074306e0d60e07d236ae6_Fumigacion.webp', 987, NULL),
(277, '5d4435f0825d9b41e145dd6628379c1c_Fumigacion.webp', 987, NULL),
(278, '7dcd43a0b91e6dd540bea5c8bac72506_Fumigacion.webp', 987, NULL),
(279, '8eda801740e28e54affb8e3314371311_Controles.webp', 3456, NULL),
(280, 'affb8fe8cb1564d38f1be824c9b96f2e_Controles.webp', 3456, NULL),
(281, 'e3caebc3b59033acb2e7d3e28654abc0_Controles.webp', 3456, NULL),
(282, '6e0831da9156fad5008afc9c31e214cb_Abono.webp', 456423, NULL),
(283, 'fd3ee02dd8042edcca7425b80e5da283_Abono.webp', 456423, NULL),
(284, '6d96518c5b95f0dbedfe9d1ece925db3_Abono.webp', 456423, NULL),
(285, '0b7fc3cf31d0d85468f46d068d3964cb_Asesorias.webp', 2345, NULL),
(286, 'adf5dc7ff52a88a53b9cedb351e86a2c_Asesorias.webp', 2345, NULL),
(287, 'be80e03a7cfec5098422045895914193_Asesorias.webp', 2345, NULL),
(288, 'd23bae7f3d4e277e10a8a4018f4be99c_Preparación de tierras.webp', 9983, NULL),
(289, 'e37a6fd36c0201e47c1d99309218328e_Preparación de tierras.webp', 9983, NULL),
(290, 'f5b2a19c0e0df6dfa6439302a07b13ba_Preparación de tierras.webp', 9983, NULL);

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
(225151063, 2147483647, 'juan', 'jose', 'piedrahita', 'parra', '3138608432', 'denyamanx133@gmail.com', 1, '2003-02-11', 'asadwadawd', '2024-03-27'),
(272384277, 2147483647, 'jose', '', 'parra', 'parra', '324234242323', 'jfkefioee@fg.com', 1, '2000-02-11', 'awdwd', '2024-03-27');

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
(1, 'Arroz', 'Nos enorgullece presentar nuestro arroz, cultivado con cuidado y dedicación en los fértiles campos de la región del Darién. Nuestro arroz es el resultado de prácticas agrícolas sostenibles, garantizando no solo un producto de alta calidad sino también el respeto por el medio ambiente.', 5000, 700, 'f54d4227b8354a7ec7a919984ba0082d_Arroz.mp4', '2024-02-13'),
(321, 'Pollos', 'Nos enorgullece presentar nuestro pollo, criado con esmero y dedicación en los amplios campos de nuestra región. Nuestro pollo es el resultado de prácticas avícolas sostenibles, garantizando no solo un producto de alta calidad, sino también el respeto por el bienestar de las aves y el cuidado del medio ambiente. Con orgullo, ofrecemos a su mesa pollo fresco y sabroso, criados de manera responsable y comprometida con la excelencia y la sostenibilidad.', 8000, 30, '8e585d9f300ba9220372f4b586c3aaed_Pollos.mp4', '2024-03-27'),
(879, 'Cerdos', 'Con satisfacción, introducimos nuestro cerdo, criado con esmero y dedicación en los prósperos terrenos de nuestra región. Nuestro cerdo es el producto de prácticas porcinas sostenibles, asegurando no solo una carne de alta calidad, sino también el respeto por el bienestar animal y la preservación del entorno. Con orgullo, ofrecemos a su mesa carne de cerdo fresca y sabrosa, criada de manera responsable y comprometida con la excelencia y la sostenibilidad.', 6700, 13, '', '2024-03-27'),
(2231, 'Platano', 'Con entusiasmo, les presentamos nuestros plátanos, cultivados con esmero y dedicación en los prósperos campos de nuestra región. Nuestros plátanos son el resultado de prácticas agrícolas sostenibles, garantizando no solo un fruto de alta calidad, sino también el respeto por el medio ambiente. Con orgullo, ofrecemos a su mesa plátanos frescos y deliciosos, cultivados de manera responsable y comprometida con la excelencia y la sostenibilidad en la producción de esta fruta versátil y nutritiva.', 5000, 40, '', '2024-03-27'),
(4432, 'Yuca', 'Con satisfacción, presentamos nuestra yuca, cultivada con esmero y dedicación en los fértiles suelos de nuestra región. Nuestra yuca es el fruto de prácticas agrícolas sostenibles, garantizando no solo un tubérculo de alta calidad, sino también el respeto por el medio ambiente. Con orgullo, ofrecemos a su mesa yuca fresca y nutritiva, cultivada de manera responsable y comprometida con la excelencia y la sostenibilidad en la agricultura.', 1000, 100, '', '2024-03-27'),
(5678, 'Gallinas criollas', 'Nos complace introducir nuestros huevos de gallinas criollas, cuidadosamente producidos con dedicación en los prósperos corrales de nuestra región. Nuestros huevos son el fruto de prácticas avícolas sostenibles, asegurando no solo un producto de excelente calidad, sino también el respeto por el bienestar de las aves y la preservación del entorno. Con orgullo, traemos a su mesa huevos frescos y nutritivos, cultivados en armonía con la naturaleza y comprometidos con la calidad y sostenibilidad.', 3000, 45, '87f309c20e6e36de6d3523a94e4fcb20_Gallinas criollas.mp4', '2024-03-27'),
(9876, 'Ponedoras', 'Nos complace presentar nuestros huevos de gallinas ponedoras, producidos con cuidado y dedicación en los espacios amplios de nuestra región. Nuestros huevos son el resultado de prácticas avícolas sostenibles, garantizando no solo un producto de alta calidad, sino también el respeto por el bienestar de las aves y la preservación del entorno. Con orgullo, ofrecemos a su mesa huevos frescos y nutritivos, cultivados de manera responsable y comprometida con la excelencia y la sostenibilidad.', 2500, 60, '', '2024-03-27'),
(9987, 'Peces', 'Nos complace presentar nuestros peces, criados con cuidado y dedicación en las aguas prístinas de nuestra región. Nuestros peces son el resultado de prácticas acuícolas sostenibles, garantizando no solo productos pesqueros de alta calidad, sino también el respeto por la salud de los ecosistemas acuáticos. Con orgullo, ofrecemos a su mesa pescado fresco y nutritivo, cultivado de manera responsable y comprometida con la excelencia y la sostenibilidad en la pesca.', 4000, 150, '', '2024-03-27'),
(45675, 'Ganado', 'Nos enorgullece presentar nuestro ganado , criado con esmero y dedicación en los extensos pastizales de nuestra región. Nuestro ganado es el resultado de prácticas ganaderas sostenibles, garantizando no solo productos cárnicos de alta calidad, sino también el respeto por el bienestar de los animales y la preservación del entorno. Con orgullo, ofrecemos a su mesa carne fresca y sabrosa, Criado de manera responsable y comprometida con la excelencia y la sostenibilidad en la producción ganadera.', 5000000, 10, '', '2024-03-27');

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
('12643-6', 'agro', '3242342343', 'juan@gmail.com', 'jjpp', '1233124234', 'jjawdwd@g.com');

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
(11, '12643-6', 5678);

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
(987, 'Fumigación', 'Con gran satisfacción, nos complace presentar nuestros servicios personalizados de fumigación, diseñados para brindar soluciones efectivas y seguras en el control de plagas, adaptados a las necesidades específicas de cada cliente. Comprometidos con la calidad y la responsabilidad ambiental, nuestro equipo de expertos utiliza métodos cuidadosamente seleccionados para garantizar un manejo eficiente de las situaciones, respetando tanto la salud humana como el equilibrio de los ecosistemas.', 10000, 45, '2024-03-27', 2),
(2345, 'Asesorias', 'Con gran entusiasmo, presentamos nuestro servicio de asesoría agrícola especializada. Nuestro equipo de expertos está dedicado a proporcionarle orientación precisa y personalizada para potenciar el rendimiento y la eficiencia de sus cultivos. A través de nuestras asesorías agrícolas, abordamos una variedad de aspectos, desde la selección de cultivos hasta la implementación de prácticas agronómicas avanzadas.', 10000, 5, '2024-03-27', 2),
(2421, 'Abono', 'Con gran satisfacción, les presentamos nuestros servicios de alquiler de equipos para fertilización, diseñados para ofrecer soluciones efectivas y sostenibles en el enriquecimiento del suelo. Comprometidos con la calidad y la responsabilidad ambiental, nuestros equipos son cuidadosamente seleccionados para garantizar un manejo eficiente de las prácticas agrícolas, respetando tanto la salud del suelo como la preservación del equilibrio ecológico.', 4000, 5, '2024-03-27', 1),
(3452, 'Fumigación', 'Con gran satisfacción, les presentamos nuestros servicios de alquiler de equipos de fumigación, diseñados para brindar soluciones efectivas y seguras en el control de plagas. Comprometidos con la calidad y la responsabilidad ambiental, nuestros equipos son seleccionados cuidadosamente para garantizar un manejo eficiente de las situaciones, respetando tanto la salud humana como el equilibrio de los ecosistemas.', 5000, 4, '2024-03-27', 1),
(3456, 'Controles', 'Con gran satisfacción, presentamos nuestros servicios de control personalizados, diseñados para ofrecer soluciones efectivas y seguras adaptadas a sus necesidades específicas. En nuestro enfoque integral, nos comprometemos a proporcionar controles especializados.', 300, 34, '2024-03-27', 2),
(9983, 'Preparación de tierras', 'Con gran entusiasmo, presentamos nuestro servicio especializado en la preparación de tierra, enfocado en potenciar la salud y fertilidad de su suelo. Nuestra oferta está meticulosamente diseñada para optimizar las condiciones necesarias que favorecen un crecimiento robusto de sus cultivos.', 3000, 45, '2024-03-27', 2),
(456423, 'Abono', 'Con gran satisfacción, les presentamos nuestro servicio exclusivo de abono, diseñado para optimizar la salud y la fertilidad de su suelo. Comprometidos con la excelencia y la responsabilidad ambiental, nuestra oferta de abono está formulada cuidadosamente para proporcionar los nutrientes esenciales que promueven un crecimiento vigoroso y sostenible de sus plantas.', 3000, 12, '2024-03-27', 2);

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
(129, 'cliente', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 225151063, 2, NULL),
(130, 'proveedor', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 3, '12643-6'),
(131, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 272384277, 1, NULL);

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
  MODIFY `codigo_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

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
  MODIFY `codigo_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT de la tabla `tbl_prov_prod`
--
ALTER TABLE `tbl_prov_prod`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `codigo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

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
