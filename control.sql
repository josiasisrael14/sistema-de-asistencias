-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2022 a las 03:19:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `idasistencia` int(11) NOT NULL,
  `codigo_persona_as` varchar(20) COLLATE utf8_bin NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo` varchar(45) COLLATE utf8_bin NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`idasistencia`, `codigo_persona_as`, `fecha_hora`, `tipo`, `fecha`) VALUES
(143, '789', '2020-09-02 07:06:51', 'Entrada', '2020-01-31'),
(144, '789', '2020-09-02 07:07:10', 'Entrada', '2020-01-31'),
(145, '789', '2020-09-02 07:07:40', 'Entrada', '2020-01-31'),
(146, '123456789', '2020-09-02 07:10:35', 'Entrada', '2020-01-31'),
(147, '444', '2020-09-02 12:10:18', 'Entrada', '2020-01-31'),
(326, '123456789', '2020-09-10 08:13:11', 'salida', '2020-09-09'),
(327, '789', '2020-09-12 06:26:56', 'entrada', '2020-09-11'),
(328, '789', '2020-09-12 06:27:11', 'salida', '2020-09-11'),
(329, '444', '2020-09-12 06:38:38', 'salida', '2020-09-11'),
(330, 'c7uUpi', '2020-09-12 06:48:57', 'entrada', '2020-09-11'),
(331, 'c7uUpi', '2020-09-12 06:49:10', 'salida', '2020-09-11'),
(332, 'oiuu', '2020-09-12 06:52:54', 'entrada', '2020-09-11'),
(333, 'oiuu', '2020-09-12 06:52:57', 'salida', '2020-09-11'),
(334, '444', '2020-09-12 08:02:07', 'entrada', '2020-09-11'),
(335, '444', '2020-09-12 08:02:11', 'salida', '2020-09-11'),
(336, '123', '2020-09-14 04:17:08', 'entrada', '2020-09-13'),
(337, '123', '2020-09-14 04:17:11', 'salida', '2020-09-13'),
(338, '123456789', '2020-09-14 04:18:08', 'entrada', '2020-09-13'),
(339, '123456789', '2020-09-14 04:18:11', 'salida', '2020-09-13'),
(342, 'hhhhhh', '2020-09-14 05:15:46', 'entrada', '2020-09-13'),
(343, 'hhhhhh', '2020-09-14 05:15:48', 'salida', '2020-09-13'),
(344, '4ftWdZ', '2020-09-15 23:37:00', 'entrada', '2020-09-15'),
(345, '4ftWdZ', '2020-09-15 23:37:10', 'salida', '2020-09-15'),
(346, '', '2020-10-06 07:35:47', 'entrada', '2020-10-05'),
(347, '', '2020-10-06 07:35:57', 'salida', '2020-10-05'),
(348, '123', '2020-10-06 07:37:05', 'entrada', '2020-10-05'),
(349, 'T46h2K', '2022-11-14 05:24:30', 'entrada', '2022-11-14'),
(350, 'T46h2K', '2022-11-14 05:37:27', 'entrada', '2022-11-14'),
(351, 'T46h2K', '2022-11-14 05:46:01', 'salida', '2022-11-14'),
(352, 'T46h2K', '2022-11-14 05:49:42', 'entrada', '2022-11-14'),
(353, 'T46h2K', '2022-11-14 05:58:05', 'entrada', '2022-11-14'),
(354, 'T46h2K', '2022-11-14 05:58:20', 'entrada', '2022-11-14'),
(355, 'T46h2K', '2022-11-14 05:59:36', 'entrada', '2022-11-14'),
(356, 'T46h2K', '2022-11-14 06:04:39', 'entrada', '2022-11-14'),
(357, 'T46h2K', '2022-11-14 06:05:34', 'entrada', '2022-11-14'),
(358, 'T46h2K', '2022-11-14 06:10:22', 'entrada', '2022-11-14'),
(359, 'T46h2K', '2022-11-14 06:11:08', 'entrada', '2022-11-14'),
(360, 'T46h2K', '2022-11-14 06:12:38', 'entrada', '2022-11-14'),
(361, 'T46h2K', '2022-11-14 06:12:45', 'entrada', '2022-11-14'),
(362, 'T46h2K', '2022-11-14 06:16:04', 'entrada', '2022-11-14'),
(363, 'T46h2K', '2022-11-14 06:17:55', 'entrada', '2022-11-14'),
(364, 'T46h2K', '2022-11-14 06:18:51', 'entrada', '2022-11-14'),
(365, 'T46h2K', '2022-11-14 06:19:00', 'entrada', '2022-11-14'),
(366, 'T46h2K', '2022-11-14 06:20:22', 'entrada', '2022-11-14'),
(367, 'T46h2K', '2022-11-14 06:22:29', 'entrada', '2022-11-14'),
(368, 'T46h2K', '2022-11-14 06:22:51', 'entrada', '2022-11-14'),
(369, 'T46h2K', '2022-11-14 06:23:50', 'entrada', '2022-11-14'),
(370, 'T46h2K', '2022-11-14 06:30:58', 'salida', '2022-11-14'),
(371, 'T46h2K', '2022-11-14 06:32:17', 'salida', '2022-11-14'),
(372, 'T46h2K', '2022-11-14 06:33:10', 'salida', '2022-11-14'),
(373, 'T46h2K', '2022-11-15 03:01:44', 'entrada', '2022-11-14'),
(374, 'T46h2K', '2022-11-15 03:02:00', 'entrada', '2022-11-14'),
(375, 'T46h2K', '2022-11-15 03:02:13', 'salida', '2022-11-14'),
(376, 'T46h2K', '2022-11-15 03:02:18', 'salida', '2022-11-14'),
(377, 'T46h2K', '2022-11-15 03:02:23', 'salida', '2022-11-14'),
(378, 'T46h2K', '2022-11-15 03:04:16', 'salida', '2022-11-14'),
(379, '4iaJEz', '2022-11-15 03:06:12', 'entrada', '2022-11-14'),
(380, '4iaJEz', '2022-11-15 03:06:43', 'salida', '2022-11-14'),
(381, 'cy3ayQ', '2022-11-15 03:10:46', 'entrada', '2022-11-14'),
(382, 'cy3ayQ', '2022-11-15 03:12:57', 'entrada', '2022-11-14'),
(383, 'T46h2K', '2022-11-15 03:13:10', 'entrada', '2022-11-14'),
(384, 'T46h2K', '2022-11-15 03:13:17', 'entrada', '2022-11-14'),
(385, 'T46h2K', '2022-11-15 03:13:23', 'entrada', '2022-11-14'),
(386, '4iaJEz', '2022-11-15 03:14:11', 'entrada', '2022-11-14'),
(387, '4iaJEz', '2022-11-15 03:14:16', 'entrada', '2022-11-14'),
(388, '4iaJEz', '2022-11-15 03:22:10', 'entrada', '2022-11-14'),
(389, '4iaJEz', '2022-11-15 03:23:35', 'entrada', '2022-11-14'),
(390, '4iaJEz', '2022-11-15 03:28:58', 'entrada', '2022-11-14'),
(391, '4iaJEz', '2022-11-15 03:29:10', 'entrada', '2022-11-14'),
(392, '4iaJEz', '2022-11-15 03:32:05', 'entrada', '2022-11-14'),
(393, 'T46h2K', '2022-11-15 03:32:23', 'entrada', '2022-11-14'),
(394, 'T46h2K', '2022-11-15 03:33:50', 'entrada', '2022-11-14'),
(395, 'hggggff', '2022-11-15 03:34:25', 'entrada', '2022-11-14'),
(396, 'hggggff', '2022-11-15 03:34:38', 'entrada', '2022-11-14'),
(397, 'cy3ayQ', '2022-11-15 03:35:00', 'entrada', '2022-11-14'),
(398, 'cy3ayQ', '2022-11-15 03:35:06', 'entrada', '2022-11-14'),
(399, 'T46h2K', '2022-11-16 20:35:18', 'entrada', '2022-11-16'),
(400, 'T46h2K', '2022-11-16 20:35:43', 'entrada', '2022-11-16'),
(401, '4iaJEz', '2022-11-16 20:36:04', 'entrada', '2022-11-16'),
(402, '4iaJEz', '2022-11-16 20:36:10', 'entrada', '2022-11-16'),
(403, 'hggggff', '2022-11-16 20:37:10', 'entrada', '2022-11-16'),
(404, 'hggggff', '2022-11-16 20:37:11', 'entrada', '2022-11-16'),
(405, 'hggggff', '2022-11-16 20:37:15', 'entrada', '2022-11-16'),
(406, 'T46h2K', '2022-11-16 20:37:31', 'entrada', '2022-11-16'),
(407, '4iaJEz', '2022-11-16 20:39:16', 'entrada', '2022-11-16'),
(408, '4iaJEz', '2022-11-16 20:39:51', 'entrada', '2022-11-16'),
(409, '4iaJEz', '2022-11-16 20:44:24', 'entrada', '2022-11-16'),
(410, '4iaJEz', '2022-11-16 20:44:29', 'entrada', '2022-11-16'),
(411, 'T46h2K', '2022-11-16 20:44:49', 'entrada', '2022-11-16'),
(412, 'T46h2K', '2022-11-17 23:51:19', 'entrada', '2022-11-17'),
(413, 'T46h2K', '2022-11-17 23:51:25', 'entrada', '2022-11-17'),
(414, '4iaJEz', '2022-11-17 23:51:49', 'entrada', '2022-11-17'),
(415, '4iaJEz', '2022-11-17 23:51:58', 'entrada', '2022-11-17'),
(416, 'T46h2K', '2022-11-17 23:53:16', 'entrada', '2022-11-17'),
(417, 'T46h2K', '2022-11-17 23:53:26', 'entrada', '2022-11-17'),
(418, '4iaJEz', '2022-11-17 23:53:39', 'entrada', '2022-11-17'),
(419, '4iaJEz', '2022-11-17 23:53:40', 'entrada', '2022-11-17'),
(420, '4iaJEz', '2022-11-17 23:53:44', 'entrada', '2022-11-17'),
(421, 'T46h2K', '2022-11-18 05:30:54', 'entrada', '2022-11-18'),
(422, 'T46h2K', '2022-11-18 05:31:02', 'entrada', '2022-11-18'),
(423, 'T46h2K', '2022-11-18 05:31:06', 'entrada', '2022-11-18'),
(424, 'T46h2K', '2022-11-18 05:31:39', 'entrada', '2022-11-18'),
(425, 'T46h2K', '2022-11-18 05:31:45', 'entrada', '2022-11-18'),
(426, '4iaJEz', '2022-11-18 05:31:57', 'entrada', '2022-11-18'),
(427, '4iaJEz', '2022-11-18 05:32:03', 'entrada', '2022-11-18'),
(428, 'T46h2K', '2022-11-18 05:32:11', 'entrada', '2022-11-18'),
(429, 'T46h2K', '2022-11-18 05:32:55', 'entrada', '2022-11-18'),
(430, '4iaJEz', '2022-11-18 05:33:15', 'entrada', '2022-11-18'),
(431, 'T46h2K', '2022-11-18 05:33:37', 'entrada', '2022-11-18'),
(432, 'T46h2K', '2022-11-18 05:34:25', 'entrada', '2022-11-18'),
(433, '4iaJEz', '2022-11-18 05:35:28', 'entrada', '2022-11-18'),
(434, '4iaJEz', '2022-11-18 05:36:47', 'entrada', '2022-11-18'),
(435, 'T46h2K', '2022-11-18 05:37:02', 'entrada', '2022-11-18'),
(436, 'T46h2K', '2022-11-20 15:08:31', 'entrada', '2022-11-20'),
(437, 'T46h2K', '2022-11-20 15:12:57', 'entrada', '2022-11-20'),
(438, '4iaJEz', '2022-11-20 15:15:37', 'entrada', '2022-11-20'),
(439, '4iaJEz', '2022-11-20 15:20:43', 'entrada', '2022-11-20'),
(440, 'T46h2K', '2022-11-20 15:20:58', 'entrada', '2022-11-20'),
(441, 'T46h2K', '2022-11-20 15:21:02', 'entrada', '2022-11-20'),
(442, 'T46h2K', '2022-11-20 15:22:01', 'entrada', '2022-11-20'),
(443, 'T46h2K', '2022-11-20 15:22:23', 'entrada', '2022-11-20'),
(444, 'T46h2K', '2022-11-20 15:23:15', 'entrada', '2022-11-20'),
(445, 'cy3ayQ', '2022-11-20 15:30:03', 'entrada', '2022-11-20'),
(446, 'cy3ayQ', '2022-11-20 15:31:17', 'entrada', '2022-11-20'),
(447, '4iaJEz', '2022-11-20 15:31:58', 'entrada', '2022-11-20'),
(448, 'T46h2K', '2022-11-20 15:32:13', 'entrada', '2022-11-20'),
(449, 'cy3ayQ', '2022-11-21 05:08:42', 'entrada', '2022-11-21'),
(450, 'cy3ayQ', '2022-11-21 05:08:53', 'entrada', '2022-11-21'),
(451, 'cy3ayQ', '2022-11-21 05:09:24', 'entrada', '2022-11-21'),
(452, 'T46h2K', '2022-11-21 05:09:40', 'entrada', '2022-11-21'),
(453, '4iaJEz', '2022-11-21 05:12:28', 'entrada', '2022-11-21'),
(454, 'cy3ayQ', '2022-11-21 05:12:48', 'entrada', '2022-11-21'),
(455, 'cy3ayQ', '2022-11-21 05:20:22', 'entrada', '2022-11-21'),
(456, 'cy3ayQ', '2022-11-21 05:20:40', 'entrada', '2022-11-21'),
(457, 'cy3ayQ', '2022-11-21 05:20:47', 'entrada', '2022-11-21'),
(458, '4iaJEz', '2022-11-21 05:21:13', 'entrada', '2022-11-21'),
(459, '4iaJEz', '2022-11-21 05:21:33', 'entrada', '2022-11-21'),
(460, 'cy3ayQ', '2022-11-21 05:32:30', 'entrada', '2022-11-21'),
(461, 'cy3ayQ', '2022-11-21 05:33:35', 'entrada', '2022-11-21'),
(462, 'cy3ayQ', '2022-11-21 05:33:50', 'entrada', '2022-11-21'),
(463, 'cy3ayQ', '2022-11-21 05:36:08', 'entrada', '2022-11-21'),
(464, '4iaJEz', '2022-11-21 05:36:35', 'entrada', '2022-11-21'),
(465, 'T46h2K', '2022-11-21 05:39:55', 'entrada', '2022-11-21'),
(466, 'T46h2K', '2022-11-21 06:05:13', 'entrada', '2022-11-21'),
(467, 'T46h2K', '2022-11-21 06:05:37', 'entrada', '2022-11-21'),
(468, 'T46h2K', '2022-11-21 06:05:46', 'entrada', '2022-11-21'),
(469, '4iaJEz', '2022-11-21 06:06:20', 'entrada', '2022-11-21'),
(470, '4iaJEz', '2022-11-21 06:07:19', 'entrada', '2022-11-21'),
(471, '4iaJEz', '2022-11-21 06:08:34', 'entrada', '2022-11-21'),
(472, '4iaJEz', '2022-11-21 06:28:29', 'entrada', '2022-11-21'),
(473, '4iaJEz', '2022-11-21 06:39:32', 'entrada', '2022-11-21'),
(474, '4iaJEz', '2022-11-21 06:39:42', 'entrada', '2022-11-21'),
(475, '4iaJEz', '2022-11-21 06:40:35', 'entrada', '2022-11-21'),
(476, 'cy3ayQ', '2022-11-21 06:41:53', 'entrada', '2022-11-21'),
(477, 'cy3ayQ', '2022-11-21 06:42:34', 'entrada', '2022-11-21'),
(478, 'cy3ayQ', '2022-11-21 06:42:50', 'entrada', '2022-11-21'),
(479, 'cy3ayQ', '2022-11-21 06:46:25', 'entrada', '2022-11-21'),
(480, 'cy3ayQ', '2022-11-21 06:53:15', 'entrada', '2022-11-21'),
(481, 'T46h2K', '2022-11-21 06:55:49', 'entrada', '2022-11-21'),
(482, 'T46h2K', '2022-11-21 07:12:12', 'entrada', '2022-11-21'),
(483, 'T46h2K', '2022-11-21 07:12:20', 'entrada', '2022-11-21'),
(484, '4iaJEz', '2022-11-21 07:40:36', 'entrada', '2022-11-21'),
(485, '4iaJEz', '2022-11-21 07:42:06', 'entrada', '2022-11-21'),
(486, '4iaJEz', '2022-11-21 07:43:03', 'entrada', '2022-11-21'),
(487, '4iaJEz', '2022-11-21 07:46:14', 'entrada', '2022-11-21'),
(488, '4iaJEz', '2022-11-21 07:51:32', 'entrada', '2022-11-21'),
(489, '4iaJEz', '2022-11-21 07:51:59', 'entrada', '2022-11-21'),
(490, '4iaJEz', '2022-11-21 08:13:17', 'entrada', '2022-11-21'),
(491, '4iaJEz', '2022-11-21 08:13:55', 'entrada', '2022-11-21'),
(492, 'cy3ayQ', '2022-11-21 23:24:19', 'entrada', '2022-11-21'),
(493, 'cy3ayQ', '2022-11-21 23:24:32', 'entrada', '2022-11-21'),
(494, 'cy3ayQ', '2022-11-21 23:57:08', 'entrada', '2022-11-21'),
(495, 'cy3ayQ', '2022-11-21 23:57:49', 'entrada', '2022-11-21'),
(496, 'T46h2K', '2022-11-22 00:00:16', 'entrada', '2022-11-21'),
(497, '4iaJEz', '2022-11-22 00:03:39', 'entrada', '2022-11-21'),
(498, '4iaJEz', '2022-11-22 00:04:04', 'entrada', '2022-11-21'),
(499, 'T46h2K', '2022-11-22 00:08:09', 'entrada', '2022-11-21'),
(500, 'T46h2K', '2022-11-22 00:09:32', 'entrada', '2022-11-21'),
(501, 'T46h2K', '2022-11-22 00:09:45', 'entrada', '2022-11-21'),
(502, 'T46h2K', '2022-11-22 00:10:08', 'entrada', '2022-11-21'),
(503, 'cy3ayQ', '2022-11-22 00:11:55', 'entrada', '2022-11-21'),
(504, 'cy3ayQ', '2022-11-22 00:12:43', 'entrada', '2022-11-21'),
(505, 'T46h2K', '2022-11-22 00:13:30', 'entrada', '2022-11-21'),
(506, '4iaJEz', '2022-11-22 00:17:27', 'entrada', '2022-11-21'),
(507, '4iaJEz', '2022-11-22 00:17:37', 'entrada', '2022-11-21'),
(508, '4iaJEz', '2022-11-22 01:23:42', 'salida', '2022-11-21'),
(509, '4iaJEz', '2022-11-22 01:26:39', 'salida', '2022-11-21'),
(510, 'cy3ayQ', '2022-11-22 01:27:28', 'salida', '2022-11-21'),
(511, 'cy3ayQ', '2022-11-22 01:28:07', 'salida', '2022-11-21'),
(512, 'T46h2K', '2022-11-22 01:31:25', 'entrada', '2022-11-21'),
(513, 'T46h2K', '2022-11-22 01:31:30', 'salida', '2022-11-21'),
(514, '4iaJEz', '2022-11-22 01:31:44', 'salida', '2022-11-21'),
(515, '4iaJEz', '2022-11-22 01:31:50', 'entrada', '2022-11-21'),
(516, 'cy3ayQ', '2022-11-22 01:32:02', 'salida', '2022-11-21'),
(517, 'cy3ayQ', '2022-11-22 01:34:30', 'entrada', '2022-11-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `fechacreada` datetime NOT NULL,
  `idusuario` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `nombre`, `descripcion`, `fechacreada`, `idusuario`) VALUES
(1, 'Analista de créditos  ', 'asesor de ventas', '2020-09-13 22:41:44', '64'),
(2, 'Promotor de ahorro y crédito', 'trabajo de promoción', '2020-01-19 00:15:24', '1'),
(3, 'Gerencia', 'representante legal', '2020-01-28 21:24:52', '1'),
(4, 'Administración', 'encargado de agencia', '2020-01-28 21:25:08', '1'),
(5, 'Recibidor(a)/Pagador(a)', 'encargado de los movimientos de caja', '2020-01-28 21:25:45', '1'),
(6, 'Vigilancia', 'vigilante diurno', '2020-01-28 21:26:14', '1'),
(7, 'Limpieza', 'encargado de la limpieza de oficinas', '2020-01-28 21:26:50', '1'),
(8, 'ingenieria informatico', 'hace genialidades', '2020-08-23 20:47:31', '16'),
(9, 'ingeniero quimico', 'ver los residuos quimicos', '2020-08-23 20:56:40', '16'),
(10, 'bioquimica', 'estudio humano', '2020-08-30 23:43:03', ''),
(11, 'electricidad', 'estudio de atomos', '2020-08-30 23:46:10', '64'),
(12, 'Analista de créditos ', 'asesor de ventass', '2020-09-13 22:17:57', '64'),
(13, 'Analista de créditos ', 'asesor de ventass', '2020-09-13 22:18:12', '64'),
(14, 'Promotor de ahorro y crédito ', 'trabajo de promociónn', '2020-09-13 22:21:00', '64'),
(15, 'Analista de créditos ', 'asesor de ventass', '2020-09-13 22:22:58', '64'),
(16, 'Analista de créditos ', 'asesor de ventasss', '2020-09-13 22:24:23', '64');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idmensaje` int(11) NOT NULL,
  `idusuariomensaje` int(11) NOT NULL,
  `textomensaje` text COLLATE utf8_bin NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fechamensaje` datetime NOT NULL,
  `fechacreada` datetime NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_bin NOT NULL,
  `fechacreada` datetime NOT NULL,
  `idusuario` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`idtipousuario`, `nombre`, `descripcion`, `fechacreada`, `idusuario`) VALUES
(1, 'Administrador', 'Con priviliegios de gestionar todo el sistema', '2020-01-18 00:00:00', '1'),
(2, 'Vendedor', 'vende y promueve los productos', '2020-09-15 11:27:22', '64'),
(3, 'administrador2', 'hace lo mismo que el administrador', '2020-08-23 20:46:07', '16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_bin NOT NULL,
  `login` varchar(45) COLLATE utf8_bin NOT NULL,
  `iddepartamento` int(11) NOT NULL,
  `idtipousuario` int(11) NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `fechacreado` datetime DEFAULT NULL,
  `usuariocreado` varchar(45) COLLATE utf8_bin NOT NULL,
  `codigo_persona` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `idmensaje` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `apellidos`, `login`, `iddepartamento`, `idtipousuario`, `email`, `password`, `imagen`, `estado`, `fechacreado`, `usuariocreado`, `codigo_persona`, `idmensaje`) VALUES
(1, 'admin', 'compartiendocodigos', 'admin', 1, 1, 'info@compartiendocodigos.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'antivirus.jpg', 2, '2020-09-11 13:48:01', 'admin', '444', 1),
(2, 'juan', 'Lopez Torres', 'juan', 1, 2, 'juan@gmail.com', 'ed08c290d7e22f7bb324b15cbadce35b0b348564fd2d5f95752388d86d71bcca', 'computer_pc_PNG17487.png', -1, '2020-09-13 18:16:35', '0', '789', 0),
(14, 'Pedro', 'totocayo', 'coco', 2, 2, 'angelinos257@gmail.com', '4f682b71153ffa91e608445d7ea1257e2076d0d95eab6336cd1aa94b49680f11', 'hoy_amor.jpg', -1, '2020-09-11 13:38:37', 'admin', '', 0),
(16, 'jairo', 'ayllon cardenas', 'genioalgoritmo', 8, 1, 'jairo.josias14@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', 'codigos3.jpg', 2, '2020-09-11 13:38:25', 'jairo', 'c7uUpi', 0),
(17, 'pame', 'avaloss', 'avalospame', 4, 2, 'avalos_pame@hotmail.com', '123456789', 'popular (2).png', 2, '2020-09-11 13:38:14', 'pame', '123456789', 1),
(18, 'josue', 'ayllon', 'josueavalos', 4, 1, 'josueavalos1245@gmail.com', '123456789', 'recuerdos1.jpg', 2, '2020-09-11 13:38:00', 'josue', '123', 1),
(64, 'josiasisrael', 'ayllon', 'josias', 1, 1, 'principe1414@hotmail.com', '123', 'vidrios (2).jpg', 2, '2020-10-01 15:57:09', '', 'oiuu', 0),
(66, 'teresass', 'ayllon cardenas', 'tere', 7, 1, 'teresa@hotmail.com', '123', 'buenas.jpg', 2, '2020-09-11 13:37:14', '', 'hhhhhh', 0),
(68, 'avalos', 'ayllon ', 'avalos15', 11, 1, 'avalos16@hotmail.com', '123654789', '580b57fcd9996e24bc43c543.png', 2, '2020-09-11 12:06:02', '', 'ññññ', 0),
(71, 'karlasj', 'apolaya', 'karla', 7, 2, 'karla@gmail.com', '123', 'oremos.webp', 2, '2020-12-02 18:31:26', '', '4u2aAZ', 0),
(72, 'dinoso', 'torres', 'dinoso', 5, 1, 'dinoso14@gmail.com', '123', 'miercoles.jpg', 2, '2020-09-08 13:25:31', '', 'jjjjjj', 0),
(73, 'carlossal', 'topollillo', 'carlossss', 8, 3, 'yair_5_12@hotmail.com', '321456', 'wiffi.jpg', 2, '2020-09-11 13:05:40', '', 'loikjn', 0),
(74, 'jouse', 'ayllon cardenas', 'josueeeee', 1, 3, 'josueeeee@hotmail.com', '31456', 'cargador.png', 2, '2020-09-08 13:28:36', '', 'loikk', 0),
(75, 'yonisss', 'mateo', 'yoni', 3, 2, 'yonis@gmail.com', '123', 'cargador.png', 2, '2020-09-11 13:06:16', '', 'yyy', 0),
(76, 'keysi amira', 'ayllon', 'keysi', 8, 1, 'keysi15@gmail.com', '123', 'keysi (2).png', 2, '2020-09-11 13:11:22', '', 'keysi', 0),
(85, 'sara', 'matias', 'saras', 9, 2, 'sara14@gmail.com', '123', 'cable1.jpg', 2, '2020-09-11 13:39:15', '', 'saraa', 0),
(87, 'mana', 'mana', 'mana20', 5, 1, 'mana21@gmail.com', '123456', 'buenas.jpg', 2, '2020-09-11 13:39:30', '', 'manaaa', 0),
(88, 'abigail', 'avalos', 'abigail', 3, 1, 'abigail@hotmail.com', '123456', 'usb.jpg', -1, '2020-09-13 18:49:03', '', 'abababa', 0),
(89, 'manuelito', 'saravias', 'manuel', 7, 2, 'manuel@gmail.com', '123654', 'office.jpg', 2, '2020-09-11 20:26:03', '', 'manuell', 0),
(90, 'topollillo', 'darnell', 'topo', 10, 2, 'topo15@gmail.com', '123', 'amor_manos.webp', 2, '2020-09-11 16:37:21', '', 'hggggff', 0),
(91, 'katy', 'tasayco oracupasa', 'katy', 11, 2, 'katy15@gmail.com', '123', 'antivirus.jpg', -1, '2020-09-15 13:22:56', '', '4ftWdZ', 0),
(92, 'cristoll', 'manass', 'cristol', 11, 2, 'cristol15@gmail.com', '123', 'wasap1.png', 2, '2020-10-03 14:08:54', '', 'cy3ayQ', 0),
(93, 'genio', 'ayllon cardenas', 'genio', 3, 1, 'josias_rey_12@hotmail.com', '123', 'mi_publicidad.jpg', 2, '2020-12-18 01:25:56', '', '4iaJEz', 0),
(94, 'elena', 'ayllon', 'elena', 3, 1, 'jairo.josias14@gmail.com', '123', 'html.png', 2, '2022-11-14 00:23:39', '', 'T46h2K', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`idasistencia`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `codigo_persona` (`codigo_persona`),
  ADD KEY `fk_departamento` (`iddepartamento`),
  ADD KEY `fk_tiposusario` (`idtipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `idasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=518;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idmensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`iddepartamento`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
