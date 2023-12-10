-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 26 2023 г., 09:10
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `snt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bills`
--

CREATE TABLE `bills` (
  `id` int(11) UNSIGNED NOT NULL,
  `land_lord` int(11) UNSIGNED NOT NULL,
  `payedFee` tinyint(1) NOT NULL DEFAULT 0,
  `type_payment` enum('cash','clearing') NOT NULL,
  `sum` decimal(10,0) NOT NULL,
  `land` varchar(30) NOT NULL COMMENT 'кадастровый номер'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `bills_info`
--

CREATE TABLE `bills_info` (
  `id` varchar(30) NOT NULL COMMENT 'кадастровый номер',
  `taxLand` enum('payed','not payed') NOT NULL,
  `taxProperty` enum('payed','not payed') NOT NULL,
  `water` enum('payed','not payed') NOT NULL,
  `electricity` enum('payed','not payed') NOT NULL,
  `gas` enum('payed','not payed') NOT NULL,
  `receiptImage` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `land`
--

CREATE TABLE `land` (
  `id` varchar(30) NOT NULL COMMENT 'кадастровый номер',
  `landLord` int(11) UNSIGNED NOT NULL,
  `adress` mediumtext NOT NULL,
  `electricity` tinyint(1) NOT NULL,
  `water-pipe` tinyint(1) NOT NULL,
  `gas` tinyint(1) NOT NULL,
  `area` decimal(10,0) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `land_lord`
--

CREATE TABLE `land_lord` (
  `id` int(11) UNSIGNED NOT NULL,
  `full_name` tinytext NOT NULL,
  `address` text NOT NULL,
  `phone_number` tinytext NOT NULL,
  `e-mail` tinytext NOT NULL,
  `consent_pd` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`) VALUES
(1, 'login1', 'password1'),
(2, 'login2', 'password2'),
(3, 'login3', 'password3'),
(4, 'login4', 'password4'),
(5, 'login5', 'password5'),
(6, 'login6', 'password6'),
(7, 'login7', 'password7'),
(8, 'login8', 'password8'),
(9, 'login9', 'password9'),
(10, 'login10', 'password10'),
(11, 'login11', 'password11'),
(12, 'login12', 'password12'),
(13, 'login13', 'password13'),
(14, 'login14', 'password14'),
(15, 'login15', 'password15'),
(16, 'login16', 'password16'),
(17, 'login17', 'password17'),
(18, 'login18', 'password18'),
(19, 'login19', 'password19'),
(20, 'login20', 'password20');


-- Структура таблицы `admins`
--

CREATE TABLE `snt`.`admins` 
(`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
 `login` VARCHAR(30) NOT NULL , 
 `password` VARCHAR(30) NOT NULL ,
  PRIMARY KEY (`id`)) 
  ENGINE = InnoDB;

--дамп админа
INSERT INTO `admins` (`id`, `login`, `password`) VALUES (NULL, 'admin', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `land_lord_2` (`land_lord`),
  ADD KEY `land` (`land`),
  ADD KEY `land_lord` (`land_lord`);

--
-- Индексы таблицы `bills_info`
--
ALTER TABLE `bills_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `land`
--
ALTER TABLE `land`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `landLord` (`landLord`);

--
-- Индексы таблицы `land_lord`
--
ALTER TABLE `land_lord`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

-- Индексы таблицы `admins`
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `land_lord`
--
ALTER TABLE `land_lord`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--AUTO_INCREMENT для таблицы `admin`
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`land`) REFERENCES `land` (`id`);

--
-- Ограничения внешнего ключа таблицы `bills_info`
--
ALTER TABLE `bills_info`
  ADD CONSTRAINT `bills_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `land` (`id`);

--
-- Ограничения внешнего ключа таблицы `land`
--
ALTER TABLE `land`
  ADD CONSTRAINT `land_ibfk_1` FOREIGN KEY (`id`) REFERENCES `bills` (`land`),
  ADD CONSTRAINT `land_ibfk_2` FOREIGN KEY (`landLord`) REFERENCES `land_lord` (`id`);

--
-- Ограничения внешнего ключа таблицы `land_lord`
--
ALTER TABLE `land_lord`
  ADD CONSTRAINT `land_lord_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
