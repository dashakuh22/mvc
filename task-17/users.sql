-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Авг 02 2022 г., 10:21
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(16) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `created_date`) VALUES
(1, 'dashakuh@gmail.com', 'Dasha', 'Kukhnovets', '$2y$10$8heB283CDU2/yYJrZ5jJqOByFSEMCA2pscbwiLtGZ1HOutZv2VJCO', '2022-07-31 14:44:46'),
(6, 'mashakuh@gmail.com', 'Masha', 'Kukhnovets', '$2y$10$95IqSQARak8eIkmbkdIdoOBuZYjV7MUR.Wi/tLCgfljqezSgndl7S', '2022-07-31 21:05:19'),
(14, 'sashakuh@gmail.com', 'Sasha', 'Kukhnovets', '$2y$10$e.Rbq5fpAkrxNKbzRguXqOhOHb7QU4IcvOGuKQYGUdGrkcWl.1/Me', '2022-08-01 09:24:47'),
(23, 'pashakuh@gmail.com', 'Pasha', 'Kukhnovets', '$2y$10$DKIriQu0CIEC4ZfyzTit2.hnfYcThLwjqLYh3.Aft7/sKB2vEsoLW', '2022-08-01 10:27:38');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(16) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
