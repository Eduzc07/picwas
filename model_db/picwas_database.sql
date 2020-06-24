-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2020 a las 01:21:01
-- Versión del servidor: 10.4.12-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `picwas`
--
CREATE DATABASE IF NOT EXISTS `picwas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `picwas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_time` date DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` enum('Deporte','Danzas','Lugares Turísticos','Otros') COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_public` tinyint(1) NOT NULL DEFAULT 1,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cover.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albums_photos`
--

CREATE TABLE `albums_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `items` int(11) NOT NULL,
  `total` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_details`
--

CREATE TABLE `cart_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `album_id` bigint(20) UNSIGNED DEFAULT NULL,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha_2_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `alpha_2_code`, `created_at`, `updated_at`) VALUES
(1, 'Afganistán', 'AF', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(2, 'Albania', 'AL', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(3, 'Alemania', 'DE', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(4, 'Andorra', 'AD', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(5, 'Angola', 'AO', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(6, 'Anguila', 'AI', '2020-06-04 05:19:56', '2020-06-04 05:19:56'),
(7, 'Antártida', 'AQ', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(8, 'Antigua y Barbuda', 'AG', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(9, 'Antillas holandesas', 'AN', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(10, 'Arabia Saudí', 'SA', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(11, 'Argelia', 'DZ', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(12, 'Argentina', 'AR', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(13, 'Armenia', 'AM', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(14, 'Aruba', 'AW', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(15, 'Australia', 'AU', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(16, 'Austria', 'AT', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(17, 'Azerbaiyán', 'AZ', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(18, 'Bahamas', 'BS', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(19, 'Bahrein', 'BH', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(20, 'Bangladesh', 'BD', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(21, 'Barbados', 'BB', '2020-06-04 05:19:57', '2020-06-04 05:19:57'),
(22, 'Bélgica', 'BE', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(23, 'Belice', 'BZ', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(24, 'Benín', 'BJ', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(25, 'Bermudas', 'BM', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(26, 'Bhután', 'BT', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(27, 'Bielorrusia', 'BY', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(28, 'Birmania', 'MM', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(29, 'Bolivia', 'BO', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(30, 'Bosnia y Herzegovina', 'BA', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(31, 'Botsuana', 'BW', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(32, 'Brasil', 'BR', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(33, 'Brunei', 'BN', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(34, 'Bulgaria', 'BG', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(35, 'Burkina Faso', 'BF', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(36, 'Burundi', 'BI', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(37, 'Cabo Verde', 'CV', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(38, 'Camboya', 'KH', '2020-06-04 05:19:58', '2020-06-04 05:19:58'),
(39, 'Camerún', 'CM', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(40, 'Canadá', 'CA', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(41, 'Chad', 'TD', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(42, 'Chile', 'CL', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(43, 'China', 'CN', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(44, 'Chipre', 'CY', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(45, 'Ciudad estado del Vaticano', 'VA', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(46, 'Colombia', 'CO', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(47, 'Comores', 'KM', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(48, 'Congo', 'CG', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(49, 'Corea', 'KR', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(50, 'Corea del Norte', 'KP', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(51, 'Costa del Marfíl', 'CI', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(52, 'Costa Rica', 'CR', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(53, 'Croacia', 'HR', '2020-06-04 05:19:59', '2020-06-04 05:19:59'),
(54, 'Cuba', 'CU', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(55, 'Dinamarca', 'DK', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(56, 'Djibouri', 'DJ', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(57, 'Dominica', 'DM', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(58, 'Ecuador', 'EC', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(59, 'Egipto', 'EG', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(60, 'El Salvador', 'SV', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(61, 'Emiratos Arabes Unidos', 'AE', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(62, 'Eritrea', 'ER', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(63, 'Eslovaquia', 'SK', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(64, 'Eslovenia', 'SI', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(65, 'España', 'ES', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(66, 'Estados Unidos', 'US', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(67, 'Estonia', 'EE', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(68, 'Etiopía', 'ET', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(69, 'Ex-República Yugoslava de Macedonia', 'MK', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(70, 'Filipinas', 'PH', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(71, 'Finlandia', 'FI', '2020-06-04 05:20:00', '2020-06-04 05:20:00'),
(72, 'Francia', 'FR', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(73, 'Gabón', 'GA', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(74, 'Gambia', 'GM', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(75, 'Georgia', 'GE', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(76, 'Georgia del Sur y las islas Sandwich del Sur', 'GS', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(77, 'Ghana', 'GH', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(78, 'Gibraltar', 'GI', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(79, 'Granada', 'GD', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(80, 'Grecia', 'GR', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(81, 'Groenlandia', 'GL', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(82, 'Guadalupe', 'GP', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(83, 'Guam', 'GU', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(84, 'Guatemala', 'GT', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(85, 'Guayana', 'GY', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(86, 'Guayana francesa', 'GF', '2020-06-04 05:20:01', '2020-06-04 05:20:01'),
(87, 'Guinea', 'GN', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(88, 'Guinea Ecuatorial', 'GQ', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(89, 'Guinea-Bissau', 'GW', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(90, 'Haití', 'HT', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(91, 'Holanda', 'NL', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(92, 'Honduras', 'HN', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(93, 'Hong Kong R. A. E', 'HK', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(94, 'Hungría', 'HU', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(95, 'India', 'IN', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(96, 'Indonesia', 'ID', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(97, 'Irak', 'IQ', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(98, 'Irán', 'IR', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(99, 'Irlanda', 'IE', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(100, 'Isla Bouvet', 'BV', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(101, 'Isla Christmas', 'CX', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(102, 'Isla Heard e Islas McDonald', 'HM', '2020-06-04 05:20:02', '2020-06-04 05:20:02'),
(103, 'Islandia', 'IS', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(104, 'Islas Caimán', 'KY', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(105, 'Islas Cook', 'CK', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(106, 'Islas de Cocos o Keeling', 'CC', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(107, 'Islas Faroe', 'FO', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(108, 'Islas Fiyi', 'FJ', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(109, 'Islas Malvinas Islas Falkland', 'FK', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(110, 'Islas Marianas del norte', 'MP', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(111, 'Islas Marshall', 'MH', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(112, 'Islas menores de Estados Unidos', 'UM', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(113, 'Islas Palau', 'PW', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(114, 'Islas Salomón', 'SB', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(115, 'Islas Tokelau', 'TK', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(116, 'Islas Turks y Caicos', 'TC', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(117, 'Islas Vírgenes EE.UU.', 'VI', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(118, 'Islas Vírgenes Reino Unido', 'VG', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(119, 'Israel', 'IL', '2020-06-04 05:20:03', '2020-06-04 05:20:03'),
(120, 'Italia', 'IT', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(121, 'Jamaica', 'JM', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(122, 'Japón', 'JP', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(123, 'Jordania', 'JO', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(124, 'Kazajistán', 'KZ', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(125, 'Kenia', 'KE', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(126, 'Kirguizistán', 'KG', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(127, 'Kiribati', 'KI', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(128, 'Kuwait', 'KW', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(129, 'Laos', 'LA', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(130, 'Lesoto', 'LS', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(131, 'Letonia', 'LV', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(132, 'Líbano', 'LB', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(133, 'Liberia', 'LR', '2020-06-04 05:20:04', '2020-06-04 05:20:04'),
(134, 'Libia', 'LY', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(135, 'Liechtenstein', 'LI', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(136, 'Lituania', 'LT', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(137, 'Luxemburgo', 'LU', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(138, 'Macao R. A. E', 'MO', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(139, 'Madagascar', 'MG', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(140, 'Malasia', 'MY', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(141, 'Malawi', 'MW', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(142, 'Maldivas', 'MV', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(143, 'Malí', 'ML', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(144, 'Malta', 'MT', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(145, 'Marruecos', 'MA', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(146, 'Martinica', 'MQ', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(147, 'Mauricio', 'MU', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(148, 'Mauritania', 'MR', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(149, 'Mayotte', 'YT', '2020-06-04 05:20:05', '2020-06-04 05:20:05'),
(150, 'México', 'MX', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(151, 'Micronesia', 'FM', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(152, 'Moldavia', 'MD', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(153, 'Mónaco', 'MC', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(154, 'Mongolia', 'MN', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(155, 'Montserrat', 'MS', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(156, 'Mozambique', 'MZ', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(157, 'Namibia', 'NA', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(158, 'Nauru', 'NR', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(159, 'Nepal', 'NP', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(160, 'Nicaragua', 'NI', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(161, 'Níger', 'NE', '2020-06-04 05:20:06', '2020-06-04 05:20:06'),
(162, 'Nigeria', 'NG', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(163, 'Niue', 'NU', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(164, 'Norfolk', 'NF', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(165, 'Noruega', 'NO', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(166, 'Nueva Caledonia', 'NC', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(167, 'Nueva Zelanda', 'NZ', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(168, 'Omán', 'OM', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(169, 'Panamá', 'PA', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(170, 'Papua Nueva Guinea', 'PG', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(171, 'Paquistán', 'PK', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(172, 'Paraguay', 'PY', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(173, 'Perú', 'PE', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(174, 'Pitcairn', 'PN', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(175, 'Polinesia francesa', 'PF', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(176, 'Polonia', 'PL', '2020-06-04 05:20:07', '2020-06-04 05:20:07'),
(177, 'Portugal', 'PT', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(178, 'Puerto Rico', 'PR', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(179, 'Qatar', 'QA', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(180, 'Reino Unido', 'UK', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(181, 'República Centroafricana', 'CF', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(182, 'República Checa', 'CZ', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(183, 'República de Sudáfrica', 'ZA', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(184, 'República Democrática del Congo Zaire', 'CD', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(185, 'República Dominicana', 'DO', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(186, 'Reunión', 'RE', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(187, 'Ruanda', 'RW', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(188, 'Rumania', 'RO', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(189, 'Rusia', 'RU', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(190, 'Samoa', 'WS', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(191, 'Samoa occidental', 'AS', '2020-06-04 05:20:08', '2020-06-04 05:20:08'),
(192, 'San Kitts y Nevis', 'KN', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(193, 'San Marino', 'SM', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(194, 'San Pierre y Miquelon', 'PM', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(195, 'San Vicente e Islas Granadinas', 'VC', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(196, 'Santa Helena', 'SH', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(197, 'Santa Lucía', 'LC', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(198, 'Santo Tomé y Príncipe', 'ST', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(199, 'Senegal', 'SN', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(200, 'Serbia y Montenegro', 'YU', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(201, 'Sychelles', 'SC', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(202, 'Sierra Leona', 'SL', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(203, 'Singapur', 'SG', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(204, 'Siria', 'SY', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(205, 'Somalia', 'SO', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(206, 'Sri Lanka', 'LK', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(207, 'Suazilandia', 'SZ', '2020-06-04 05:20:09', '2020-06-04 05:20:09'),
(208, 'Sudán', 'SD', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(209, 'Suecia', 'SE', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(210, 'Suiza', 'CH', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(211, 'Surinam', 'SR', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(212, 'Svalbard', 'SJ', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(213, 'Tailandia', 'TH', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(214, 'Taiwán', 'TW', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(215, 'Tanzania', 'TZ', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(216, 'Tayikistán', 'TJ', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(217, 'Territorios británicos del océano Indico', 'IO', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(218, 'Territorios franceses del sur', 'TF', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(219, 'Timor Oriental', 'TP', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(220, 'Togo', 'TG', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(221, 'Tonga', 'TO', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(222, 'Trinidad y Tobago', 'TT', '2020-06-04 05:20:10', '2020-06-04 05:20:10'),
(223, 'Túnez', 'TN', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(224, 'Turkmenistán', 'TM', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(225, 'Turquía', 'TR', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(226, 'Tuvalu', 'TV', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(227, 'Ucrania', 'UA', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(228, 'Uganda', 'UG', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(229, 'Uruguay', 'UY', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(230, 'Uzbekistán', 'UZ', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(231, 'Vanuatu', 'VU', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(232, 'Venezuela', 'VE', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(233, 'Vietnam', 'VN', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(234, 'Wallis y Futuna', 'WF', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(235, 'Yemen', 'YE', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(236, 'Zambia', 'ZM', '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(237, 'Zimbabue', 'ZW', '2020-06-04 05:20:11', '2020-06-04 05:20:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_08_19_000000_create_failed_jobs_table', 1),
(25, '2020_04_16_032317_add_profile_data_to_users_table', 1),
(26, '2020_04_16_192040_create_table_countries', 1),
(27, '2020_04_16_203239_modify_country_column_to_users_table', 1),
(28, '2020_04_23_175115_add_signin_alert_and_privacy_status_to_users_table', 1),
(29, '2020_04_25_044728_create_photos_table', 1),
(30, '2020_04_25_070138_create_albums_table', 1),
(31, '2020_04_25_165132_create_albums_photos_table', 1),
(32, '2020_05_11_060820_create_cart_table', 1),
(33, '2020_05_11_062044_create_cart_details_table', 1),
(34, '2020_05_12_021612_add_album_id_to_cart_details_table', 1),
(35, '2020_05_15_202115_create_roles_table', 1),
(36, '2020_05_15_214224_add_role_to_users_table', 1),
(37, '2020_05_20_052252_add_best_to_photos_table', 1),
(38, '2020_05_20_235025_add_category_to_albums_table', 1),
(39, '2020_05_28_043638_create_purchased_photos_table', 1),
(40, '2020_05_29_194142_add_balance_to_users_table', 1),
(41, '2020_05_30_055359_add_payer_info_to_users_table', 1),
(42, '2020_06_01_021432_add_last_ip_login_to_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `original_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `best` tinyint(1) NOT NULL DEFAULT 0,
  `privacy_public` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchased_photos`
--

CREATE TABLE `purchased_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) NOT NULL,
  `original_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'photographer', 1, '2020-06-04 05:20:11', '2020-06-04 05:20:11'),
(2, 'customer', 2, '2020-06-04 05:20:11', '2020-06-04 05:20:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL DEFAULT 66,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sign_in_alert` tinyint(1) NOT NULL DEFAULT 0,
  `account_visibility_public` tinyint(1) NOT NULL DEFAULT 1,
  `balance` double(15,2) NOT NULL DEFAULT 0.00,
  `identification_type` enum('DNI','C.E','RUC','Otro') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_name` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `withdrawal_method` enum('Banco de Crédito del Peru','Banco Interbank','Banco Scotiabank','Banco BBVA Continental','Mercadopago') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdrawal_account` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_ip_login` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `albums_photos`
--
ALTER TABLE `albums_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_photos_album_id_foreign` (`album_id`),
  ADD KEY `albums_photos_photo_id_foreign` (`photo_id`);

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_details_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_details_photo_id_foreign` (`photo_id`),
  ADD KEY `cart_details_album_id_foreign` (`album_id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `purchased_photos`
--
ALTER TABLE `purchased_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchased_photos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `albums_photos`
--
ALTER TABLE `albums_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `purchased_photos`
--
ALTER TABLE `purchased_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `albums_photos`
--
ALTER TABLE `albums_photos`
  ADD CONSTRAINT `albums_photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  ADD CONSTRAINT `albums_photos_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`);

--
-- Filtros para la tabla `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_details_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_details_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `purchased_photos`
--
ALTER TABLE `purchased_photos`
  ADD CONSTRAINT `purchased_photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
