-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2024 a las 18:29:27
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `altas`
--

CREATE TABLE `altas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `observaciones` text DEFAULT NULL,
  `rssi` varchar(20) NOT NULL,
  `test` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `averias`
--

CREATE TABLE `averias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nodo` bigint(20) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `solucion` text DEFAULT NULL,
  `susti_A` bigint(20) UNSIGNED DEFAULT NULL,
  `susti_B` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@uoc.edu|195.53.32.2', 'i:1;', 1717224163),
('admin@uoc.edu|195.53.32.2:timer', 'i:1717224163;', 1717224163),
('javier.aestrada@gmail.com|195.53.32.2', 'i:1;', 1717072008),
('javier.aestrada@gmail.com|195.53.32.2:timer', 'i:1717072008;', 1717072008),
('mantenimiento@gmail.com|170.253.19.104', 'i:1;', 1717225816),
('mantenimiento@gmail.com|170.253.19.104:timer', 'i:1717225816;', 1717225816),
('soorte@gmail.com|127.0.0.1', 'i:1;', 1717013510),
('soorte@gmail.com|127.0.0.1:timer', 'i:1717013510;', 1717013510);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `movil` int(11) DEFAULT NULL,
  `dni` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `servicio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_id` bigint(20) UNSIGNED DEFAULT NULL,
  `disponibilidad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `default` varchar(255) NOT NULL DEFAULT 'no',
  `font_color` varchar(255) DEFAULT NULL,
  `bg_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`, `default`, `font_color`, `bg_color`, `created_at`, `updated_at`) VALUES
(4, 'Facturable', 'no', '#4d4d4d', '#35c918', '2024-06-02 13:40:33', '2024-06-02 13:42:45'),
(5, 'En pausa', 'no', '#171717', '#f09414', '2024-06-02 13:42:28', '2024-06-02 13:42:45'),
(6, 'Solicitado', 'si', '#f2f2f2', '#f31616', '2024-06-02 13:42:40', '2024-06-02 13:42:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `nombre_factura` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cliente` bigint(20) UNSIGNED NOT NULL,
  `id_tecnico` bigint(20) UNSIGNED NOT NULL,
  `via_comunicacion` varchar(255) NOT NULL,
  `tipo_incidencia` varchar(255) NOT NULL,
  `necesita_visita` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_visita` date DEFAULT NULL,
  `descripcion` text NOT NULL,
  `solucion` text DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'abierto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `num_serie` varchar(255) NOT NULL,
  `mac` varchar(255) NOT NULL,
  `utilizado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nodo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `denominacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `marca`, `modelo`, `num_serie`, `mac`, `utilizado`, `created_at`, `updated_at`, `nodo_id`, `ip`, `denominacion`) VALUES
(2, 'Ubiquiti', 'NanoStation M2', 'Nano01', '68:72:51:66:B5:37\n', 1, '2024-04-25 19:21:36', '2024-06-01 12:55:15', NULL, NULL, NULL),
(3, 'Ubiquiti', 'PowerBeam', 'PB01', 'B4:FB:E4:A1:A0:B8\n', 1, '2024-04-25 21:10:55', '2024-06-01 12:55:37', NULL, NULL, NULL),
(6, 'Ubiquiti', 'Bullet M2', 'BUL015', '68:72:51:86:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(7, 'Ubiquiti', 'PowerBeam 5AC 400 ISO', 'POWERBEAMAC010', 'F0:9F:C2:50:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(8, 'Ubiquiti', 'BULLET M5 AC', 'fdsfds33', '74:83:C2:64:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(9, 'Ubiquiti', 'Switch Mikrotik', '607104B61BFD', '00:00:00:00:00:01', 0, NULL, NULL, NULL, NULL, NULL),
(10, 'Ubiquiti', 'PowerBeam M5', '085M5', 'FC:EC:DA:52:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(11, 'Ubiquiti', 'NanoBeam M5', '286EBEB0', '80:2A:A8:DE:AB:31', 0, NULL, NULL, NULL, NULL, NULL),
(12, 'Ubiquiti', 'NanoBeam M5', '2870BEB0', '00:15:6D:3A:7F:9C', 0, NULL, NULL, NULL, NULL, NULL),
(13, 'Ubiquiti', 'NanoStation Loco M2', 'S8JSDGFA', '68:72:51:86:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(14, 'Ubiquiti', 'NanoStation Loco M2', 'S8JASDFG', 'F0:9F:C2:50:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(15, 'Ubiquiti', 'NanoStation Loco M5', 'S8LNSD90', '74:83:C2:64:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(16, 'Ubiquiti', 'NanoStation M2', 'S8LNASDF', 'FC:EC:DA:52:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(17, 'Ubiquiti', 'Rocket M2', 'RKT-BR3', '68:72:51:87:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(18, 'Ubiquiti', 'Rocket M5', 'RKT-BR2', 'F0:9F:C2:51:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(19, 'Ubiquiti', 'Rocket M5', 'RKT-BR4', '74:83:C2:65:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(20, 'Ubiquiti', 'Rocket M5', 'RKT-BR5', 'FC:EC:DA:53:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(21, 'Ubiquiti', 'UniFi AP', '6786NBBF', '68:72:51:86:F8:63', 1, NULL, '2024-06-01 12:58:45', NULL, NULL, NULL),
(22, 'Ubiquiti', 'UniFi AP', '6786NBCF', 'F0:9F:C2:50:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(23, 'Ubiquiti', 'UniFi AP', '6786NBGF', '74:83:C2:64:C6:8C', 1, NULL, '2024-06-01 13:00:32', NULL, NULL, NULL),
(24, 'Ubiquiti', 'UniFi AP', '6786NBKF', 'FC:EC:DA:52:23:73', 1, NULL, '2024-06-01 12:59:02', NULL, NULL, NULL),
(25, 'Ubiquiti', 'UniFi AP', '6786NBLF', '68:72:51:87:F8:63', 1, NULL, '2024-06-01 12:59:18', NULL, NULL, NULL),
(26, 'Ubiquiti', 'UniFi AP', '6786NBMF', 'F0:9F:C2:51:37:30', 1, NULL, '2024-06-01 12:59:57', NULL, NULL, NULL),
(27, 'Ubiquiti', 'UniFi AP', '6786NBNF', '74:83:C2:65:C6:8C', 1, NULL, '2024-06-01 12:59:31', NULL, NULL, NULL),
(28, 'Ubiquiti', 'UniFi AP', '6786NBOF', 'FC:EC:DA:53:23:73', 1, NULL, '2024-06-01 12:59:41', NULL, NULL, NULL),
(29, 'Ubiquiti', 'UniFi AP', '6786NBPF', '68:72:51:86:F8:63', 1, NULL, '2024-06-01 13:00:08', NULL, NULL, NULL),
(30, 'Ubiquiti', 'UniFi AP', '6786NBQF', 'F0:9F:C2:50:37:30', 1, NULL, '2024-06-01 13:00:19', NULL, NULL, NULL),
(31, 'Ubiquiti', 'UniFi AP', '6786NBRF', '74:83:C2:64:C6:8C', 1, NULL, '2024-06-01 13:00:47', NULL, NULL, NULL),
(32, 'Ubiquiti', 'UniFi AP', '6786NBSF', 'FC:EC:DA:52:23:73', 1, NULL, '2024-06-01 13:01:40', NULL, NULL, NULL),
(33, 'Ubiquiti', 'UniFi AP', '6786NBTF', '68:72:51:87:F8:63', 1, NULL, '2024-06-01 13:01:10', NULL, NULL, NULL),
(34, 'Ubiquiti', 'UniFi AP', '6786NBUF', 'F0:9F:C2:51:37:30', 1, NULL, '2024-06-01 13:01:27', NULL, NULL, NULL),
(35, 'Ubiquiti', 'UniFi AP', '6786NBVF', '74:83:C2:65:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(36, 'Ubiquiti', 'UniFi AP', '6786NBWF', 'FC:EC:DA:53:23:73', 1, NULL, '2024-06-01 13:01:56', NULL, NULL, NULL),
(37, 'Ubiquiti', 'UniFi AP', '6786NBXF', '68:72:51:86:F8:63', 1, NULL, '2024-06-01 13:03:04', NULL, NULL, NULL),
(38, 'Ubiquiti', 'UniFi AP', '6786NBYF', 'F0:9F:C2:50:37:30', 1, NULL, '2024-06-01 13:02:14', NULL, NULL, NULL),
(39, 'Ubiquiti', 'UniFi AP', '6786NBZF', '74:83:C2:64:C6:8C', 1, NULL, '2024-06-01 13:03:29', NULL, NULL, NULL),
(40, 'Ubiquiti', 'UniFi AP', '6786NC0F', 'FC:EC:DA:52:23:73', 1, NULL, '2024-06-01 13:02:51', NULL, NULL, NULL),
(41, 'Ubiquiti', 'UniFi AP', '6786NC1F', '68:72:51:87:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(42, 'Ubiquiti', 'UniFi AP', '6786NC2F', 'F0:9F:C2:51:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(43, 'Ubiquiti', 'UniFi AP', '6786NC3F', '74:83:C2:65:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(44, 'Ubiquiti', 'UniFi AP', '6786NC4F', 'FC:EC:DA:53:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(45, 'Ubiquiti', 'UniFi AP', '6786NC5F', '68:72:51:86:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(46, 'Ubiquiti', 'UniFi AP', '6786NC6F', 'F0:9F:C2:50:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(47, 'Ubiquiti', 'UniFi AP', '6786NC7F', '74:83:C2:64:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(48, 'Ubiquiti', 'UniFi AP', '6786NC8F', 'FC:EC:DA:52:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(49, 'Ubiquiti', 'UniFi AP', '6786NC9F', '68:72:51:87:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(50, 'Ubiquiti', 'UniFi AP', '6786NCAF', 'F0:9F:C2:51:37:30', 0, NULL, NULL, NULL, NULL, NULL),
(51, 'Ubiquiti', 'UniFi AP', '6786NCBF', '74:83:C2:65:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(52, 'Ubiquiti', 'UniFi AP', '6786NCCF', 'FC:EC:DA:53:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(53, 'Ubiquiti', 'UniFi AP', '6786NCDF', '68:72:51:86:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(54, 'Ubiquiti', 'UniFi AP', '6786NCEF', 'F0:9F:C2:50:37:30', 1, NULL, '2024-06-01 13:02:05', NULL, NULL, NULL),
(55, 'Ubiquiti', 'UniFi AP', '6786NCFF', '74:83:C2:64:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(56, 'Ubiquiti', 'UniFi AP', '6786NCGF', 'FC:EC:DA:52:23:73', 1, NULL, '2024-06-01 12:58:27', NULL, NULL, NULL),
(57, 'Ubiquiti', 'UniFi AP', '6786NCHF', '68:72:51:87:F8:63', 1, NULL, '2024-06-01 12:58:01', NULL, NULL, NULL),
(58, 'Ubiquiti', 'UniFi AP', '6786NCIF', 'F0:9F:C2:51:37:30', 1, NULL, '2024-06-01 13:02:27', NULL, NULL, NULL),
(59, 'Ubiquiti', 'UniFi AP', '6786NCJF', '74:83:C2:65:C6:8C', 0, NULL, NULL, NULL, NULL, NULL),
(60, 'Ubiquiti', 'UniFi AP', '6786NCKF', 'FC:EC:DA:53:23:73', 0, NULL, NULL, NULL, NULL, NULL),
(61, 'Ubiquiti', 'UniFi AP', '6786NCLF', '68:72:51:86:F8:63', 0, NULL, NULL, NULL, NULL, NULL),
(62, 'Ubiquiti', 'UniFi AP', '6786NCMF', 'F0:9F:C2:50:37:30', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_cliente`
--

CREATE TABLE `material_cliente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`, `id`) VALUES
('0001_01_01_000000_create_users_table', 1, 1),
('0001_01_01_000001_create_cache_table', 1, 2),
('0001_01_01_000002_create_jobs_table', 1, 3),
('2024_04_20_171859_create_clients', 1, 4),
('2024_04_21_180202_create_servicios_table', 1, 5),
('2024_04_22_073553_create_estados_table', 1, 6),
('2024_04_22_192609_add_services_and_status_to_clients', 1, 7),
('2024_04_24_224416_altas', 2, 8),
('2024_04_25_085553_material', 3, 12),
('2024_04_25_085951_material_cliente', 3, 13),
('2024_04_27_183140_create_tickets_table', 4, 14),
('2024_05_01_104312_create_incidencias_table', 5, 18),
('2024_05_07_120454_create_nodos_table', 6, 19),
('2024_05_07_122239_add_additional_material', 6, 20),
('2024_05_08_105041_create_relacion_material_nodos_table', 7, 21),
('2024_05_11_175819_create_averias_table', 8, 22),
('2024_05_20_191656_create_facturas_table', 9, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nodos`
--

CREATE TABLE `nodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `geoposicionamiento` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `nodos`
--

INSERT INTO `nodos` (`id`, `nombre`, `geoposicionamiento`, `created_at`, `updated_at`) VALUES
(2, 'Ouzande', '42°41\'08.0\"N 8°29\'26.8\"W', '2024-05-08 09:57:32', '2024-05-08 09:57:32'),
(5, 'A Baiuca', '42.68779871630536, -8.483552449438307', '2024-05-29 12:55:30', '2024-05-29 12:55:30'),
(6, 'Ambulatorio', '42.68887446588161, -8.4967314431286', '2024-05-29 12:56:06', '2024-05-29 12:56:06'),
(7, 'Antiguo INEM', '42.688176534056915, -8.490991515846012', '2024-05-29 12:56:25', '2024-05-29 12:56:25'),
(8, 'Antón Losada', '42.68940283841237, -8.495642466276875', '2024-05-29 12:56:47', '2024-05-29 12:56:47'),
(9, 'A Somoza', '42.6760, -8.4865', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(10, 'Agar', '42.7000, -8.4500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(11, 'Aguions', '42.6800, -8.4400', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(15, 'Arnois', '42.7400, -8.4300', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(18, 'Barbude', '42.7200, -8.4200', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(19, 'Berres', '42.7400, -8.4100', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(24, 'Callobre', '42.6900, -8.4500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(33, 'Cereixo', '42.7500, -8.4600', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(36, 'Codeseda', '42.7200, -8.4800', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(37, 'Cora', '42.7300, -8.4700', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(41, 'Curantes', '42.7000, -8.4800', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(45, 'Guimarei', '42.6800, -8.4900', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(48, 'Lagartons', '42.7100, -8.5000', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(49, 'Lagos', '42.7200, -8.5100', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(50, 'Lamas', '42.7300, -8.5200', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(51, 'Liripio', '42.7400, -8.5300', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(52, 'Loimil', '42.7500, -8.5400', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(54, 'Matalobos', '42.7600, -8.5500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(58, 'Montillon', '42.7700, -8.5600', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(59, 'Moreira', '42.7800, -8.5700', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(63, 'Nigoi', '42.7900, -8.5800', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(65, 'Oca', '42.8000, -8.5900', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(66, 'Olives', '42.8100, -8.6000', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(67, 'Orazo', '42.8200, -8.6100', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(70, 'Ouzande', '42.8300, -8.6200', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(71, 'Parada', '42.8400, -8.6300', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(72, 'Paradela', '42.8500, -8.6400', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(73, 'Pardemarin', '42.8600, -8.6500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(76, 'Portela', '42.8700, -8.6600', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(84, 'Remesar', '42.8800, -8.6700', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(87, 'Ribeira', '42.8900, -8.6800', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(89, 'Ribela', '42.9000, -8.6900', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(92, 'Riobó', '42.9100, -8.7000', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(93, 'Rubin', '42.9200, -8.7100', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(94, 'Sabucedo', '42.9300, -8.7200', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(96, 'San Andres de Vea', '42.9400, -8.7300', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(98, 'San Miguel de Barcala', '42.9500, -8.7400', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(99, 'San Miguel de Castro', '42.9600, -8.7500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(102, 'San Pedro de Ancorados', '42.9700, -8.7600', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(104, 'San Tome de Ancorados', '42.9800, -8.7700', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(111, 'Santeles', '42.9900, -8.7800', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(116, 'Souto de Vea', '43.0000, -8.7900', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(117, 'Tabeiros', '43.0100, -8.8000', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(119, 'Teo', '43.0200, -8.8100', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(120, 'Toedo', '43.0300, -8.8200', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(121, 'Toedo Poligono', '43.0400, -8.8300', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(125, 'Vinseiro', '43.0500, -8.8400', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(128, 'Vinseiro-Vis de Correa', '43.0600, -8.8500', '2024-05-29 13:00:00', '2024-05-29 13:00:00'),
(130, 'Xesteiras', '43.0700, -8.8600', '2024-05-29 13:00:00', '2024-05-29 13:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_material_nodos`
--

CREATE TABLE `rel_material_nodos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_material` bigint(20) UNSIGNED NOT NULL,
  `id_nodo` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rel_material_nodos`
--

INSERT INTO `rel_material_nodos` (`id`, `id_material`, `id_nodo`, `ip`, `alias`) VALUES
(8, 2, 2, '192.168.1.2', 'AP1_OU'),
(9, 3, 2, '192.168.1.2', 'AP2_OU'),
(10, 57, 98, '192.16.1.12', 'AP1_SMDB'),
(11, 56, 98, '192.16.1.11', 'AP2_SMDB'),
(12, 21, 33, '192.16.1.11', 'AP2_CEREI'),
(13, 24, 33, '192.16.1.12', 'AP1_CEREI'),
(14, 25, 121, '192.16.1.12', 'AP1_TOEPOLIG'),
(15, 27, 121, '192.16.1.11', 'AP2_TOEPOLIG'),
(16, 28, 48, '192.16.1.12', 'AP1_LAGAR'),
(17, 26, 48, '192.16.1.12', 'AP2_LAGAR'),
(18, 29, 120, '192.16.1.12', 'AP1_TOEDO'),
(19, 30, 120, '192.16.1.12', 'AP2_TOEDO'),
(20, 23, 111, '192.16.1.12', 'AP2_SANTEL'),
(21, 31, 111, '192.16.1.11', 'AP1_SANTEL'),
(22, 33, 102, '192.16.1.12', 'AP2_SANPEANCO'),
(23, 34, 102, '192.16.1.12', 'AP1_SANPEANCO'),
(24, 32, 130, '192.16.1.12', 'AP1_XEST'),
(25, 36, 130, '192.16.1.11', 'AP2_XESTE'),
(26, 54, 37, '192.16.1.12', 'AP1_CORA'),
(27, 38, 37, '192.16.1.11', 'AP2_CORA'),
(28, 58, 116, '192.16.1.12', 'AP2_SOUVEA'),
(29, 40, 116, '192.16.1.12', 'AP1_SOUVEA'),
(30, 37, 45, '192.16.1.12', 'AP2_GUIM'),
(31, 39, 45, '192.16.1.11', 'AP1_GUIM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `font_color` varchar(255) DEFAULT NULL,
  `bg_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `precio`, `font_color`, `bg_color`, `created_at`, `updated_at`) VALUES
(16, '10 MG', 10.00, NULL, NULL, '2024-06-02 13:40:04', '2024-06-02 13:40:04'),
(17, '20 Mg', 20.00, NULL, NULL, '2024-06-02 13:40:12', '2024-06-02 13:40:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CiGMbNnejqG9HfGFiMw91MgWLXNzMVpr9fKcAVDZ', 21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiT3hQSlA2VE9MdGwyTld0RDkyOE9OVUZPR1VWcjdMTENCd1oyalJuVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6MTA6Il9vbGRfaW5wdXQiO31zOjM6Im5ldyI7YTowOnt9fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUyOiJodHRwOi8vbG9jYWxob3N0OjkwMDAvbWFudGVuaW1pZW50by9tb3N0cmFyX21hdGVyaWFsIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzE3MzQzOTY3O31zOjEwOiJfb2xkX2lucHV0IjthOjA6e319', 1717344207),
('EkwzZQ0fnCbOYihmq0IFB9hcGrQn4N1AP5RgBpOk', NULL, '64.176.219.214', 'Mozilla/5.0 (Windows NT 10.0; rv:125.0) Gecko/20100101 Firefox/125.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid29uWTFoZGMxQTdKV3dia0lFOGNQVjZ0N3NGeG1OWk52b0JzOTREbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xNzAuMjUzLjE5LjEwNDo5MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717342051),
('vNggr1sI5n5iIspcklR5hst8umf9vNaHVqjdLrOt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36 Edg/125.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1RXRmREeHdDek5xOWNzTDBob0lodWVpZUNNZnRRYlUyUzVwdkxjMiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6OTAwMC9sb2dpbiI7fX0=', 1717343684);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` varchar(255) NOT NULL DEFAULT 'soporte',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'admin', 'admin@uoc.edu', NULL, '$2y$12$mMNxMl/OqgpFbZbIfbBAGeYh.oLdZZJvpcrgc6coDQni2xJNcRj2u', 'administrador', NULL, '2024-04-29 17:16:58', '2024-06-01 13:02:06'),
(20, 'Soporte', 'soporte@uoc.edu', NULL, '$2y$12$zGojS9X.XG1o6PDJRFCfd.kqfkdvGQXFenOT6o/PsI4DMqHJV61Wy', 'soporte', NULL, '2024-06-02 13:58:14', '2024-06-02 13:58:14'),
(21, 'Mantenimiento', 'mantenimiento@uoc.edu', NULL, '$2y$12$P4nAluWlLhEIQXZR8mG0bOut5cR5IWqIkHj5BXcFaVIF0uczFXmHu', 'mantenimiento', NULL, '2024-06-02 13:58:44', '2024-06-02 13:58:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `altas`
--
ALTER TABLE `altas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `altas_id_cliente_foreign` (`id_cliente`);

--
-- Indices de la tabla `averias`
--
ALTER TABLE `averias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `averias_id_nodo_foreign` (`id_nodo`),
  ADD KEY `averias_susti_a_foreign` (`susti_A`),
  ADD KEY `averias_susti_b_foreign` (`susti_B`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_servicio_id_foreign` (`servicio_id`),
  ADD KEY `clientes_estado_id_foreign` (`estado_id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidencias_id_persona_foreign` (`id_cliente`),
  ADD KEY `incidencias_id_tecnico_foreign` (`id_tecnico`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_nodo_id_foreign` (`nodo_id`);

--
-- Indices de la tabla `material_cliente`
--
ALTER TABLE `material_cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_cliente_material_id_foreign` (`material_id`),
  ADD KEY `material_cliente_cliente_id_foreign` (`cliente_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nodos`
--
ALTER TABLE `nodos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `rel_material_nodos`
--
ALTER TABLE `rel_material_nodos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_material_nodos_id_material_foreign` (`id_material`),
  ADD KEY `rel_material_nodos_id_nodo_foreign` (`id_nodo`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `altas`
--
ALTER TABLE `altas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `averias`
--
ALTER TABLE `averias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `material_cliente`
--
ALTER TABLE `material_cliente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `nodos`
--
ALTER TABLE `nodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `rel_material_nodos`
--
ALTER TABLE `rel_material_nodos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `altas`
--
ALTER TABLE `altas`
  ADD CONSTRAINT `altas_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `averias`
--
ALTER TABLE `averias`
  ADD CONSTRAINT `averias_id_nodo_foreign` FOREIGN KEY (`id_nodo`) REFERENCES `nodos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `averias_susti_a_foreign` FOREIGN KEY (`susti_A`) REFERENCES `material` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `averias_susti_b_foreign` FOREIGN KEY (`susti_B`) REFERENCES `material` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_estado_id_foreign` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `clientes_servicio_id_foreign` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD CONSTRAINT `incidencias_id_persona_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `incidencias_id_tecnico_foreign` FOREIGN KEY (`id_tecnico`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_nodo_id_foreign` FOREIGN KEY (`nodo_id`) REFERENCES `nodos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `material_cliente`
--
ALTER TABLE `material_cliente`
  ADD CONSTRAINT `material_cliente_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `material_cliente_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`);

--
-- Filtros para la tabla `rel_material_nodos`
--
ALTER TABLE `rel_material_nodos`
  ADD CONSTRAINT `rel_material_nodos_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `material` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rel_material_nodos_id_nodo_foreign` FOREIGN KEY (`id_nodo`) REFERENCES `nodos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
