-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 27 2017 г., 02:45
-- Версия сервера: 5.6.35
-- Версия PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crypto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `coins`
--

CREATE TABLE `coins` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `quan` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `coins`
--

INSERT INTO `coins` (`id`, `icon`, `name`, `quan`, `color`) VALUES
(1, '/uploads/8170414.png', 'bitcoin', '0', '#DD7825'),
(2, '/uploads/95033305.png', 'ethereum', '3.45', '#7e8395'),
(4, '/uploads/79634285.png', 'qtum', '0', '#2ba5d7'),
(3, '/uploads/56679600.png', 'omisego', '15', '#4661F6'),
(5, '/uploads/15403563.png', 'red-pulse', '4716', '#ac3d00'),
(6, '/uploads/48668172.png', 'aion', '118', '#1d8e8e'),
(7, '/uploads/14411787.png', 'icon', '1500', '#61b6b9'),
(8, '/uploads/9192473.png', 'quantstamp', '4000', '#000000'),
(9, '/uploads/72302716.png', 'raiden-network-token', '114.5', '#5e5e5e'),
(10, '/uploads/69451550.png', 'eos', '25', '#a01e4e'),
(11, '/uploads/21390557.png', 'iota', '100.7', '#aaaaaa'),
(12, '/uploads/75019121.png', '0x', '0', '#fee4a8'),
(13, '/uploads/25139620.png', 'cindicator', '5000', '#00b480'),
(14, '/uploads/28632790.png', 'nem', '24', '#fefb40'),
(15, '/uploads/21225513.png', 'waves', '2', '#00fcff'),
(16, '/uploads/46881462.png', 'binance-coin', '8.8', '#feca3e'),
(17, '/uploads/79641856.png', 'tezos', '0', '#000000'),
(18, '/uploads/45640776.png', 'electroneum', '820', '#00c6fc'),
(19, '/uploads/35757338.png', 'nebulas-token', '78.18', '#74a7fe');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Uploaded images from admin panel for ImageManager';

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(25, '48668172.png'),
(26, '75019121.png'),
(27, '57086909.png'),
(28, '46881462.png'),
(29, '8170414.png'),
(30, '10152451.png'),
(31, '65451136.png'),
(32, '12531199.png'),
(33, '25139620.png'),
(34, '35914392.png'),
(35, '69451550.png'),
(36, '95033305.png'),
(37, '9916242.png'),
(38, '14411787.png'),
(39, '21390557.png'),
(40, '65293663.png'),
(41, '44673815.png'),
(42, '111371106.png'),
(43, '46136495.png'),
(44, '44670787.png'),
(45, '28632790.png'),
(46, '50560874.png'),
(47, '56679600.png'),
(48, '79634285.png'),
(49, '9192473.png'),
(50, '72302716.png'),
(51, '15403563.png'),
(52, '21043814.png'),
(53, '79641856.png'),
(54, '21225513.png'),
(55, '45640776.png'),
(56, '35757338.png');

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notification`
--

INSERT INTO `notification` (`id`, `name`, `link`, `active`, `date`) VALUES
(3, 'Новый пользователь: Soble', '/admin/users/view/?id=5', 0, '15/06/2016, 08:24'),
(4, 'Новый пользователь: dsd', '/admin/users/view/?id=6', 0, '16/06/2016, 03:11'),
(5, 'Новый пользователь: hjfdf', '/admin/users/view/?id=8', 0, '16/06/2016, 17:07'),
(6, 'Новый заказ: 87821039', '/admin/orders/view/?id=5', 0, '16/06/2016, 06:51');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `authKey` varchar(32) NOT NULL,
  `recovery` varchar(60) DEFAULT NULL COMMENT 'Временный пароль при восстановлении',
  `activation` varchar(32) DEFAULT NULL,
  `soc` varchar(100) DEFAULT NULL,
  `access` int(11) DEFAULT '0' COMMENT '0 - ожидает подтверждения, 1 - доступ открыт, 2 - доступ закрыт',
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `authKey`, `recovery`, `activation`, `soc`, `access`, `date`) VALUES
(1, 'Admin', '$2y$13$I9lKxZRovHH5nYt.Occvre7VcLw1yRVnFLveS2DdMWD4XbYBU.gCG', 'Garcy999@yandex.ru', '/uploads/avatar/MvnCePR7kLU.jpg', 'VfXlNEbMCZGZ1ChSNtXuy038d6zjDoNH', NULL, NULL, NULL, 2, 1460988211);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `coins`
--
ALTER TABLE `coins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT для таблицы `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
