-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.21 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных php_5sem
CREATE DATABASE IF NOT EXISTS `php_5sem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `php_5sem`;

-- Дамп структуры для таблица php_5sem.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы php_5sem.admins: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`user_id`, `created_at`) VALUES
	(3, '2021-01-30 06:30:15');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Дамп структуры для таблица php_5sem.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` char(255) DEFAULT NULL,
  `author_id` int DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы php_5sem.article: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `name`, `author_id`, `description`) VALUES
	(1, 'hello warudo', 2, 'this is mah home, brotha'),
	(2, 'why so few', 5, 'daz it even work?'),
	(3, 'rticle', 3, 'ifgvbo;adfigfodugvbufdoahb'),
	(4, 'another post', 4, 'HEHEEHEHEHehehehehheheHEHEHEHHe'),
	(5, 'OH MY GOOOOOD', 3, 'ORORORORORORANDANDANDANDANDANDAND'),
	(6, 'aaand last one', 28, 'yeaaaaaaaaaaaaa');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Дамп структуры для таблица php_5sem.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы php_5sem.users: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
	(1, 'aaa', '$2y$10$0Jo1dsuwRoOjv.LfYziv9uZlty3hWVg69h9mgQi3d4qK4vL0tsX.i', '2020-12-19 14:34:00'),
	(2, 'hey', '$2y$10$BE7MCUTQShK8Um0HYktrlukzxOdH8z7uIYLY7Cs2THGac3RmU1k0y', '2021-01-30 03:23:24'),
	(3, 'admin', '$2y$10$VU9tbBZOeB6GgCov1wKA3unIKTFjxkROxURWV.CIdwkUS.yCko39y', '2021-01-30 06:30:37'),
	(6, 'delete_me', '$2y$10$o4Ex9ny//sWfuhHgmeR84O.ihdb57C7mLTe5UTPOKba9C3kFuUxvu', '2021-01-30 08:57:46'),
	(8, 'destroy_me', '$2y$10$HnOC77zheiKJPE6zG6ipVOyj.XGKX7uxyx4ETGLgnzrV8iTF19zHi', '2021-01-30 08:57:59'),
	(9, 'hahaha', '$2y$10$7S/paP5YiBxZuJn9n9TAFuT3iS2bzBeqtAemZxq6JpVLrDu3vbxLW', '2021-01-30 12:34:59'),
	(10, '123545', '$2y$10$NT5NFxSFbyzNHD72GPdcKuTDzN7R3J.9cFSK/yGGwNqr8OeqYTPQW', '2021-01-30 14:55:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
