-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 07 2020 г., 19:13
-- Версия сервера: 5.7.23-24
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u1057757_default`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin_visits`
--

CREATE TABLE `admin_visits` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `name` varchar(1000) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `album` varchar(30) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `post_liked`
--

CREATE TABLE `post_liked` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL,
  `post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subs`
--

CREATE TABLE `subs` (
  `id` int(11) NOT NULL,
  `friend1` int(11) NOT NULL,
  `friend2` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `verification` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `text_banned` varchar(500) DEFAULT NULL,
  `date_registration` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `sex` varchar(10) DEFAULT NULL,
  `happy` varchar(100) DEFAULT NULL,
  `category` varchar(15) NOT NULL DEFAULT 'user',
  `avatar` varchar(600) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL,
  `family_state` int(11) NOT NULL DEFAULT '0',
  `site` varchar(300) DEFAULT NULL,
  `vk` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `country` varchar(11) NOT NULL DEFAULT 'none',
  `sity` varchar(11) NOT NULL DEFAULT 'by0',
  `phone` varchar(100) DEFAULT NULL,
  `vkey` varchar(100) DEFAULT NULL,
  `vemail` tinyint(1) NOT NULL DEFAULT '0',
  `online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_chats`
--

CREATE TABLE `user_chats` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_messages`
--

CREATE TABLE `user_messages` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `message` varchar(400) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `device` varchar(20) DEFAULT 'pc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `message` varchar(1200) DEFAULT NULL,
  `creator` int(11) NOT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `publishing` int(11) NOT NULL,
  `device` varchar(100) NOT NULL DEFAULT 'pc',
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `repost` tinyint(1) NOT NULL DEFAULT '0',
  `original_post` int(11) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin_visits`
--
ALTER TABLE `admin_visits`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `post_liked`
--
ALTER TABLE `post_liked`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subs`
--
ALTER TABLE `subs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_chats`
--
ALTER TABLE `user_chats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin_visits`
--
ALTER TABLE `admin_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `post_liked`
--
ALTER TABLE `post_liked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `subs`
--
ALTER TABLE `subs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_chats`
--
ALTER TABLE `user_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
