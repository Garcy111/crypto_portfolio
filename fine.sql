-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 26 2016 г., 05:26
-- Версия сервера: 5.5.50-log
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fine`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='Uploaded images from admin panel for ImageManager';

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(22, '53277918.jpg'),
(23, '46788069.jpg'),
(24, '31855361.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `link`, `url`) VALUES
(5, 'О компании', 'about', 'about'),
(6, 'Цены', 'prices', 'prices'),
(7, 'Онлайн заявка', 'online', 'online'),
(8, 'Наши услуги', 'services', 'services'),
(9, 'Наши работы', 'works', 'works');

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `content` text,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `link`, `content`, `updated_at`) VALUES
(4, 'О компании', 'about', '<p>Тут что то о компании</p>', NULL),
(5, 'Цены', 'prices', '<p>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Это жизни имеет себя, сих выйти заманивший, города дал речью правилами даль эта рыбного семантика, единственное мир парадигматическая пунктуация не.</p>\r\n<p>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Это жизни имеет себя, сих выйти заманивший, города дал речью правилами даль эта рыбного семантика, единственное мир парадигматическая пунктуация не.</p>', NULL),
(6, 'Онлайн заявка', 'online', '<p>Онлайн заявка</p>', NULL),
(7, 'Наши услуги', 'services', '<p>Тут наши услуги</p>', NULL),
(8, 'Наши работы', 'works', '<p>Тут работы</p>', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `authKey`, `recovery`, `activation`, `soc`, `access`, `date`) VALUES
(1, 'Admin', '$2y$13$1TBZ1wubM7G5rX8vwRoKQ.x8W.Q61uFM.iN9P/fYDCqjBo9dwmBG6', 'Garcy999@yandex.ru', '/uploads/avatar/MvnCePR7kLU.jpg', 'VfXlNEbMCZGZ1ChSNtXuy038d6zjDoNH', NULL, NULL, NULL, 2, 1460988211);

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `img`, `title`, `description`) VALUES
(1, '/uploads/31855361.jpg', 'Gold Dining Room', 'Image project with lightbox.2'),
(2, '/uploads/46788069.jpg,/uploads/53277918.jpg', 'Brown Living Room', 'Gallery project with slider and lightbox.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
