-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 02 2017 г., 15:37
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test-nsign`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fname` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='01.07.2017 18:08';

--
-- Дамп данных таблицы `dish`
--

INSERT INTO `dish` (`id`, `name`, `description`, `fname`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Смузи с бананом, киви и грушей', 'Для коктейля нам понадобятся спелый банан, киви и сочная груша. Фрукты очистите и крупно порежьте.\r\nИз фруктов сделайте однородное пюре с помощью блендера.\r\nВ пюре добавьте сахарную пудру и сок, чтобы получилась более жидкая консистенция. Если не добавлять сок, будет вкусное фруктовое пюре, которое можно есть ложкой.\r\nПри подаче украсьте коктейль тертым шоколадом или корицей.\r\nИсточник - http://www.prelest.com/nyam/napitki/smuzi-10-luchshih-receptov-prigotovleniya', 'smuzi_4.jpg', 1, 1498999357, 1499000943),
(2, 'Венский кофе', '100 мл кофе\r\n1 шарик ванильного мороженого\r\nпо желанию — ванильный ароматизированный сироп (по вкусу)\r\nНалейте немного ванильного ароматизированного сиропа в стакан конической формы.\r\nСформируйте из ванильного мороженого шарик и тоже положите в стакан.\r\nПоставьте стакан под дозатор кофе.\r\nПусть кофе течет в чашку прямо через край стакана.\r\n\r\nПо желанию украсьте венский кофе глясе шоколадной стружкой.\r\nhttps://ru.jura.com/ru/about-coffee/coffee-recipes/viennese-coffee', 'wiener-kaffee.jpg', 1, 1499002535, 1499002610);

-- --------------------------------------------------------

--
-- Структура таблицы `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='01.07.2017 18:03';

--
-- Дамп данных таблицы `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `fname`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Бананы', '', 1, 1498999058, 1498999058),
(2, 'Груши ', '', 1, 1498999105, 1498999105),
(3, 'Киви ', '', 1, 1498999119, 1498999119),
(4, 'Сахарная пудра', '', 1, 1498999159, 1498999159),
(5, 'Персиково-яблочный сок', '', 1, 1498999176, 1498999176),
(6, 'Персиково-яблочный сок', '', 1, 1498999180, 1498999180),
(7, 'Кофе', '', 1, 1499002562, 1499002562),
(8, 'Мороженое', '', 1, 1499002577, 1499002577);

-- --------------------------------------------------------

--
-- Структура таблицы `ingredient_dish`
--

CREATE TABLE IF NOT EXISTS `ingredient_dish` (
`id` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `id_dish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='02.07.2017 00:45';

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'gbWQAZWUs9jUwm6Q3l7FYmWbPtwxata2', '$2y$13$HCNPvh/HnVb9AD6o2qzSIOdGCFCR0u6.4w1Iada.bQ8JA6FAhmCZC', NULL, 'igor90riv@gmail.com', 5, 10, 1485512005, 1485512005);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='01.07.2017 18:19';

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`id`, `id_role`, `name`) VALUES
(1, 1, 'user'),
(2, 5, 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dish`
--
ALTER TABLE `dish`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ingredient`
--
ALTER TABLE `ingredient`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `ingredient_dish`
--
ALTER TABLE `ingredient_dish`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dish`
--
ALTER TABLE `dish`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `ingredient`
--
ALTER TABLE `ingredient`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `ingredient_dish`
--
ALTER TABLE `ingredient_dish`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
