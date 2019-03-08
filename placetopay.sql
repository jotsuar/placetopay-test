-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-03-2019 a las 01:51:57
-- Versión del servidor: 10.3.13-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id8897311_conect_placetopay`
--
CREATE DATABASE IF NOT EXISTS `id8897311_conect_placetopay` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id8897311_conect_placetopay`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `state` varchar(255) COLLATE utf8_bin NOT NULL,
  `response` text COLLATE utf8_bin NOT NULL,
  `reference` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `internalReference` int(11) NOT NULL,
  `paymentMethod` varchar(255) COLLATE utf8_bin NOT NULL,
  `paymentMethodName` varchar(255) COLLATE utf8_bin NOT NULL,
  `issuerName` varchar(255) COLLATE utf8_bin NOT NULL,
  `receipt` varchar(255) COLLATE utf8_bin NOT NULL,
  `franchise` varchar(255) COLLATE utf8_bin NOT NULL,
  `authorization` varchar(255) COLLATE utf8_bin NOT NULL,
  `amount_from` float NOT NULL,
  `date_payment` datetime NOT NULL,
  `amount_to` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request_id` int(255) NOT NULL,
  `request_initial` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `documentType` varchar(255) COLLATE utf8_bin NOT NULL,
  `document` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `surname` varchar(255) COLLATE utf8_bin NOT NULL,
  `company` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `mobile` varchar(255) COLLATE utf8_bin NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
