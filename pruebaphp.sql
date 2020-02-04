-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2020 a las 22:22:09
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebaphp`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_cons_categorias_hijas` ()  BEGIN
	
    DECLARE v_f001_id_categoria INT;
    DECLARE v_f001_nombre VARCHAR(100);
    DECLARE v_f001_foto	VARCHAR(100);
	DECLARE v_categoria_existe INT DEFAULT 0;
    
    DECLARE v_crs_categorias
    	CURSOR FOR
    		SELECT 		`f001_id_categoria`,
            			`f001_nombre`,
                        `f001_foto`
            FROM 		`t001_categorias`
            ORDER BY	`f001_id_categoria` ASC;
           
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET @v_action = TRUE;
    
    DECLARE exit handler for sqlexception
    
    BEGIN
        SELECT	'FALSE'			AS f000_res,
        		'sqlexception'	AS f000_mes;
        ROLLBACK;
    END;
    
    DECLARE exit handler for sqlwarning
    
    BEGIN
    	ROLLBACK;
        SELECT	'FALSE'			AS f000_res,
        		'sqlwarning'	AS f000_mes;
    END;
    
    CREATE TEMPORARY TABLE tmpCategoriasHijas(
       f001_id_categoria INT NOT NULL,
       f001_nombre 		 VARCHAR(100) NOT NULL,
       f001_foto 		 VARCHAR(100) NOT NULL
    );
        
    OPEN v_crs_categorias;
    loop1: LOOP
        FETCH v_crs_categorias INTO v_f001_id_categoria, v_f001_nombre, v_f001_foto;
        
        IF @v_action THEN
        	LEAVE loop1;
        END IF;
        
        
        SET	v_categoria_existe = (SELECT IF( EXISTS(
                                                SELECT	1
                                                FROM	`t002_detalle_categorias`
                                                WHERE	f002_id_categoria_padre = v_f001_id_categoria), 1, 0));

		IF(v_categoria_existe = 0) THEN
			INSERT INTO tmpCategoriasHijas (f001_id_categoria, f001_nombre, f001_foto) VALUES (v_f001_id_categoria, v_f001_nombre, v_f001_foto);
		END IF;
        
        SET v_categoria_existe = NULL;
		
    END LOOP loop1;
    CLOSE v_crs_categorias;
    
    SELECT	*
    FROM	tmpCategoriasHijas;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_categorias` (IN `pv_nombre` VARCHAR(100), `pv_foto` VARCHAR(500), `pv_id_categoria_padre` INT)  BEGIN

	DECLARE v_nivel INT;
    DECLARE v_id_categoria_insert INT;
    DECLARE exit handler for sqlexception
    
    BEGIN
        SELECT	'FALSE'			AS f000_res,
        		'sqlexception'	AS f000_mes;
        ROLLBACK;
    END;
    
    DECLARE exit handler for sqlwarning
    
    BEGIN
    	ROLLBACK;
        SELECT	'FALSE'			AS f000_res,
        		'sqlwarning'	AS f000_mes;
    END;
    
    IF pv_id_categoria_padre = 0 THEN
    	SET v_nivel = 1;
    ELSE
        SET v_nivel = (SELECT 	`f001_nivel`
        			   FROM		`t001_categorias`
                       WHERE	`f001_id_categoria` = pv_id_categoria_padre
                      ) + 1;
    END IF;
    
    INSERT INTO `t001_categorias`(`f001_id_categoria`, `f001_nombre`, `f001_foto`, `f001_nivel`, `created_at`, `updated_at`) VALUES (null, pv_nombre, pv_foto, v_nivel, NOW(), NOW());
    
    SET v_id_categoria_insert = (SELECT	MAX(f001_id_categoria)
    								FROM	`t001_categorias`);
    
    INSERT INTO `t002_detalle_categorias`(`f002_id_detalle_categoria`, `f002_id_categoria`, `f002_id_categoria_padre`) VALUES (null, v_id_categoria_insert , pv_id_categoria_padre);
    
    COMMIT;
    
    SELECT	'TRUE'			AS f000_res;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t001_categorias`
--

CREATE TABLE `t001_categorias` (
  `f001_id_categoria` int(11) NOT NULL,
  `f001_nombre` varchar(100) NOT NULL,
  `f001_foto` varchar(500) NOT NULL,
  `f001_nivel` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t001_categorias`
--

INSERT INTO `t001_categorias` (`f001_id_categoria`, `f001_nombre`, `f001_foto`, `f001_nivel`, `created_at`, `updated_at`) VALUES
(1, 'Ninguna', 'Ninguna', 1, '2020-02-04 00:00:00', '2020-02-04 00:00:00'),
(28, 'Categoria 1', 'bluetooh.png', 2, '2020-02-04 16:01:15', '2020-02-04 16:01:15'),
(29, 'Categoria 2', 'gmail.png', 2, '2020-02-04 16:01:54', '2020-02-04 16:01:54'),
(30, 'Categoria 3', 'bluetooh.png', 3, '2020-02-04 16:08:46', '2020-02-04 16:08:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t002_detalle_categorias`
--

CREATE TABLE `t002_detalle_categorias` (
  `f002_id_detalle_categoria` int(11) NOT NULL,
  `f002_id_categoria` int(11) NOT NULL,
  `f002_id_categoria_padre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t002_detalle_categorias`
--

INSERT INTO `t002_detalle_categorias` (`f002_id_detalle_categoria`, `f002_id_categoria`, `f002_id_categoria_padre`) VALUES
(21, 28, 1),
(22, 29, 1),
(23, 30, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t003_usuarios`
--

CREATE TABLE `t003_usuarios` (
  `f003_id_usuario` int(11) NOT NULL,
  `f003_nombres` varchar(50) NOT NULL,
  `f003_apellidos` varchar(50) NOT NULL,
  `f003_password` varchar(20) NOT NULL,
  `f003_email` varchar(100) NOT NULL,
  `f003_celular` varchar(10) NOT NULL,
  `f003_ind_usuario` tinyint(1) NOT NULL COMMENT '0-UsuarioExterno, 1-UsuarioAdmin',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t003_usuarios`
--

INSERT INTO `t003_usuarios` (`f003_id_usuario`, `f003_nombres`, `f003_apellidos`, `f003_password`, `f003_email`, `f003_celular`, `f003_ind_usuario`, `created_at`, `updated_at`) VALUES
(1, 'ALBERTRU', '', '1234', 'ALBERTO-TRUJILLO-CH@HOTMAIL.COM', '3102618197', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ALBERTO', 'CHAMORRO', '', 'ALBERTOTRUJILLO0221@GMAIL.COM', '3172272024', 0, '2020-01-31 00:00:00', '2020-01-31 00:00:00'),
(3, 'FRANCISCO', 'MARGOLLES', '', 'ALBERTO@GMAIL.COM', '3102618197', 0, '2020-02-01 22:36:37', '2020-02-01 22:36:37'),
(4, 'FRANCISCO', 'MARGOLLES', '', 'AJA@HOTMAIL.COM', '1111111111', 0, '2020-02-01 23:54:20', '2020-02-01 23:54:20'),
(5, 'ADMIN', 'ADMIN', '1234', 'ADMIN@ADMIN.COM', '310000000', 1, '2020-02-04 21:10:44', '2020-02-04 21:10:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t004_productos`
--

CREATE TABLE `t004_productos` (
  `f004_id_producto` int(11) NOT NULL,
  `f004_nombre` varchar(150) NOT NULL,
  `f004_descripcion` text NOT NULL,
  `f004_peso` double NOT NULL COMMENT 'Peso en KG',
  `f004_precio` double NOT NULL COMMENT 'Precio en USD',
  `f004_categoria` int(11) NOT NULL,
  `f004_foto_1` varchar(500) NOT NULL,
  `f004_foto_2` varchar(500) NOT NULL,
  `f004_foto_3` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t005_solicitudes_compra`
--

CREATE TABLE `t005_solicitudes_compra` (
  `f005_id_solicitud_compra` int(11) NOT NULL,
  `f005_fecha` datetime NOT NULL,
  `f005_asunto` varchar(200) NOT NULL,
  `f005_mensaje` text NOT NULL,
  `f005_usuario` int(11) NOT NULL,
  `f005_ind_compra_leido` tinyint(4) NOT NULL COMMENT '0-No Leído, 1-Leído',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t005_solicitudes_compra`
--

INSERT INTO `t005_solicitudes_compra` (`f005_id_solicitud_compra`, `f005_fecha`, `f005_asunto`, `f005_mensaje`, `f005_usuario`, `f005_ind_compra_leido`, `created_at`, `updated_at`) VALUES
(1, '2020-01-31 00:00:00', 'AUNTO', 'AUDDDF KDFNGDFGG', 1, 0, '2020-01-31 10:17:00', '2020-01-31 10:17:00'),
(2, '2020-01-31 17:25:23', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 1, '2020-01-31 17:25:23', '2020-02-01 22:24:12'),
(3, '2020-01-31 17:29:40', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:29:40', '2020-01-31 17:29:40'),
(4, '2020-01-31 17:30:10', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:30:10', '2020-01-31 17:30:10'),
(5, '2020-01-31 17:31:05', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:31:05', '2020-01-31 17:31:05'),
(6, '2020-01-31 17:32:09', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:32:09', '2020-01-31 17:32:09'),
(7, '2020-01-31 17:32:27', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:32:27', '2020-01-31 17:32:27'),
(8, '2020-01-31 17:33:04', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:33:04', '2020-01-31 17:33:04'),
(9, '2020-01-31 17:34:09', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:34:09', '2020-01-31 17:34:09'),
(10, '2020-01-31 17:37:01', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:37:01', '2020-01-31 17:37:01'),
(11, '2020-01-31 17:37:09', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:37:09', '2020-01-31 17:37:09'),
(12, '2020-01-31 17:37:48', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:37:48', '2020-01-31 17:37:48'),
(13, '2020-01-31 17:38:30', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:38:30', '2020-01-31 17:38:30'),
(14, '2020-01-31 17:39:01', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:39:01', '2020-01-31 17:39:01'),
(15, '2020-01-31 17:39:28', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:39:28', '2020-01-31 17:39:28'),
(16, '2020-01-31 17:40:02', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:40:02', '2020-01-31 17:40:02'),
(17, '2020-01-31 17:42:03', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:42:03', '2020-01-31 17:42:03'),
(18, '2020-01-31 17:42:14', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:42:14', '2020-01-31 17:42:14'),
(19, '2020-01-31 17:42:25', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:42:25', '2020-01-31 17:42:25'),
(20, '2020-01-31 17:42:53', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:42:53', '2020-01-31 17:42:53'),
(21, '2020-01-31 17:43:29', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:43:29', '2020-01-31 17:43:29'),
(22, '2020-01-31 17:43:51', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:43:51', '2020-01-31 17:43:51'),
(23, '2020-01-31 17:43:58', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:43:58', '2020-01-31 17:43:58'),
(24, '2020-01-31 17:44:29', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:44:29', '2020-01-31 17:44:29'),
(25, '2020-01-31 17:44:43', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:44:43', '2020-01-31 17:44:43'),
(26, '2020-01-31 17:46:54', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:46:54', '2020-01-31 17:46:54'),
(27, '2020-01-31 17:47:33', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:47:33', '2020-01-31 17:47:33'),
(28, '2020-01-31 17:48:19', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:48:19', '2020-01-31 17:48:19'),
(29, '2020-01-31 17:48:56', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:48:56', '2020-01-31 17:48:56'),
(30, '2020-01-31 17:49:14', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:49:14', '2020-01-31 17:49:14'),
(31, '2020-01-31 17:49:28', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:49:28', '2020-01-31 17:49:28'),
(32, '2020-01-31 17:49:43', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:49:43', '2020-01-31 17:49:43'),
(33, '2020-01-31 17:49:53', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:49:53', '2020-01-31 17:49:53'),
(34, '2020-01-31 17:50:27', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:50:27', '2020-01-31 17:50:27'),
(35, '2020-01-31 17:50:44', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:50:44', '2020-01-31 17:50:44'),
(36, '2020-01-31 17:50:58', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:50:58', '2020-01-31 17:50:58'),
(37, '2020-01-31 17:52:33', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 17:52:33', '2020-01-31 17:52:33'),
(38, '2020-01-31 18:01:53', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 18:01:53', '2020-01-31 18:01:53'),
(39, '2020-01-31 18:02:32', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 18:02:32', '2020-01-31 18:02:32'),
(40, '2020-01-31 18:03:49', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'HOLA quiero', 2, 0, '2020-01-31 18:03:49', '2020-01-31 18:03:49'),
(41, '2020-01-31 18:09:13', 'Solicitud de compra: PRODUCTO 1', 'jajajajjaja', 2, 0, '2020-01-31 18:09:13', '2020-01-31 18:09:13'),
(42, '2020-01-31 18:13:43', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'porfin', 1, 1, '2020-01-31 18:13:43', '2020-02-01 22:23:49'),
(43, '2020-02-01 18:52:08', 'Solicitud de compra: PRODUCTO PRUEBA 3', 'sssssssss', 1, 0, '2020-02-01 18:52:08', '2020-02-01 18:52:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t006_suscriptores`
--

CREATE TABLE `t006_suscriptores` (
  `f006_id_supscritor` int(11) NOT NULL,
  `f006_correo` varchar(100) NOT NULL,
  `f006_ind_activo` tinyint(4) NOT NULL COMMENT '0-Activo,1-Inactivo',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t006_suscriptores`
--

INSERT INTO `t006_suscriptores` (`f006_id_supscritor`, `f006_correo`, `f006_ind_activo`, `created_at`, `updated_at`) VALUES
(1, 'junior@gmail.com', 0, '2020-02-01 23:17:26', '2020-02-01 23:17:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `t001_categorias`
--
ALTER TABLE `t001_categorias`
  ADD PRIMARY KEY (`f001_id_categoria`);

--
-- Indices de la tabla `t002_detalle_categorias`
--
ALTER TABLE `t002_detalle_categorias`
  ADD PRIMARY KEY (`f002_id_detalle_categoria`),
  ADD KEY `t002_detalle_categoria_t001_categoria_1` (`f002_id_categoria`),
  ADD KEY `t002_detalle_categoria_t001_categoria_2` (`f002_id_categoria_padre`);

--
-- Indices de la tabla `t003_usuarios`
--
ALTER TABLE `t003_usuarios`
  ADD PRIMARY KEY (`f003_id_usuario`);

--
-- Indices de la tabla `t004_productos`
--
ALTER TABLE `t004_productos`
  ADD PRIMARY KEY (`f004_id_producto`),
  ADD KEY `t001_categoria_t004_producto` (`f004_categoria`);

--
-- Indices de la tabla `t005_solicitudes_compra`
--
ALTER TABLE `t005_solicitudes_compra`
  ADD PRIMARY KEY (`f005_id_solicitud_compra`),
  ADD KEY `t003_usuarios_t005_solicitudes` (`f005_usuario`);

--
-- Indices de la tabla `t006_suscriptores`
--
ALTER TABLE `t006_suscriptores`
  ADD PRIMARY KEY (`f006_id_supscritor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t001_categorias`
--
ALTER TABLE `t001_categorias`
  MODIFY `f001_id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `t002_detalle_categorias`
--
ALTER TABLE `t002_detalle_categorias`
  MODIFY `f002_id_detalle_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `t003_usuarios`
--
ALTER TABLE `t003_usuarios`
  MODIFY `f003_id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `t004_productos`
--
ALTER TABLE `t004_productos`
  MODIFY `f004_id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t005_solicitudes_compra`
--
ALTER TABLE `t005_solicitudes_compra`
  MODIFY `f005_id_solicitud_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `t006_suscriptores`
--
ALTER TABLE `t006_suscriptores`
  MODIFY `f006_id_supscritor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t002_detalle_categorias`
--
ALTER TABLE `t002_detalle_categorias`
  ADD CONSTRAINT `t002_detalle_categoria_t001_categoria_1` FOREIGN KEY (`f002_id_categoria`) REFERENCES `t001_categorias` (`f001_id_categoria`),
  ADD CONSTRAINT `t002_detalle_categoria_t001_categoria_2` FOREIGN KEY (`f002_id_categoria_padre`) REFERENCES `t001_categorias` (`f001_id_categoria`);

--
-- Filtros para la tabla `t004_productos`
--
ALTER TABLE `t004_productos`
  ADD CONSTRAINT `t001_categoria_t004_producto` FOREIGN KEY (`f004_categoria`) REFERENCES `t001_categorias` (`f001_id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `t005_solicitudes_compra`
--
ALTER TABLE `t005_solicitudes_compra`
  ADD CONSTRAINT `t003_usuarios_t005_solicitudes` FOREIGN KEY (`f005_usuario`) REFERENCES `t003_usuarios` (`f003_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
