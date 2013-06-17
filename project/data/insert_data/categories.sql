-- --------------------------------------------------------
-- Хост:                         192.168.146.177
-- Версия сервера:               5.5.31-0ubuntu0.12.10.1 - (Ubuntu)
-- ОС Сервера:                   debian-linux-gnu
-- HeidiSQL Версия:              8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Дамп данных таблицы megafon.categories: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `parent`) VALUES
	(1, 'Спорт', NULL),
	(2, 'Политика', NULL),
	(3, 'Музыка', NULL),
	(4, 'Футбол', 1),
	(6, 'В мире', NULL),
	(7, 'Общество', NULL),
	(8, 'Экономика', NULL),
	(9, 'Происшествия', NULL),
	(10, 'Культура', NULL),
	(12, 'Наука', NULL),
	(13, 'Hi-Tech', NULL),
	(14, 'Интернет', NULL),
	(15, 'Авто', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
