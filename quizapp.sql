-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                5.6.21 - MySQL Community Server (GPL)
-- Sunucu İşletim Sistemi:       Win32
-- HeidiSQL Sürüm:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- quizapp için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `quizapp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `quizapp`;

-- tablo yapısı dökülüyor quizapp.answer_options
CREATE TABLE IF NOT EXISTS `answer_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_type` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `option` longtext NOT NULL,
  `is_option_true` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_type` (`quiz_type`),
  KEY `question` (`question`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- quizapp.answer_options: ~14 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `answer_options` DISABLE KEYS */;
REPLACE INTO `answer_options` (`id`, `quiz_type`, `question`, `option`, `is_option_true`) VALUES
	(1, 1, 1, '3', 0),
	(2, 1, 1, '4', 1),
	(3, 1, 1, '5', 0),
	(4, 1, 1, '6', 0),
	(5, 1, 2, '1998', 0),
	(6, 1, 2, '1999', 0),
	(7, 1, 2, '2000', 1),
	(8, 1, 2, '2001', 0),
	(9, 1, 3, 'Guy Pearce', 1),
	(10, 1, 3, 'Brad Pitt', 0),
	(11, 1, 3, 'Rober Downey Jr.', 0),
	(12, 1, 3, 'Nicholas Cage', 0),
	(13, 1, 4, 'Martin Sheen', 0),
	(14, 1, 4, 'Harrison Ford', 0),
	(15, 1, 4, 'Marlon Brando', 1),
	(16, 1, 4, 'Robert Duvall', 0),
	(17, 1, 5, 'Uganda', 0),
	(18, 1, 5, 'Tanzania', 1),
	(19, 1, 5, 'Kenya', 0),
	(20, 1, 5, 'Zimbabwe', 0),
	(21, 2, 6, 'Norway', 1),
	(22, 2, 6, 'Ireland', 0),
	(23, 2, 6, 'Spain', 0),
	(24, 2, 6, 'United Kingdom', 0),
	(25, 2, 7, 'AC/DC - Back in Black', 0),
	(26, 2, 7, 'Michael Jackson - Thriller', 1),
	(27, 2, 7, 'Pink Floyd - Dark Side of the Moon', 0),
	(28, 2, 7, 'Meat Loaf - Bat Out of Hell', 0),
	(29, 2, 8, 'Pathetique', 0),
	(30, 2, 8, 'Funeral March', 0),
	(31, 2, 8, 'Cuckoo', 0),
	(32, 2, 8, 'Requiem', 1),
	(33, 2, 9, 'Deep Purple', 0),
	(34, 2, 9, 'Black Sabbath', 1),
	(35, 2, 9, 'Whitesnake', 0),
	(36, 2, 9, 'Iron Maiden', 0),
	(37, 2, 10, 'Brian May', 0),
	(38, 2, 10, 'Freddie Mercury', 1),
	(39, 2, 10, 'David Bowie', 0),
	(40, 2, 10, 'Jim Hutton', 0),
	(41, 2, 11, 'El Cascabel', 1),
	(42, 2, 11, 'Be My Baby', 0),
	(43, 2, 11, 'Space Oddity', 0),
	(44, 2, 11, 'Telstar', 0),
	(45, 3, 12, 'Nile', 0),
	(46, 3, 12, 'Amazon', 1),
	(47, 3, 12, 'Yangtze', 0),
	(48, 3, 12, 'Mississippi', 0),
	(49, 3, 13, 'Israel', 0),
	(50, 3, 13, 'South Africa', 1),
	(51, 3, 13, 'Bolivia', 0),
	(52, 3, 13, 'Netherlands', 0),
	(53, 3, 14, 'Asia', 1),
	(54, 3, 14, 'Europe', 0),
	(55, 3, 14, 'Africa', 0),
	(56, 3, 14, 'North America', 0),
	(57, 3, 15, 'Monaco', 0),
	(58, 3, 15, 'San Marino', 0),
	(59, 3, 15, 'Nauru', 0),
	(60, 3, 15, 'Vatican City', 1),
	(61, 3, 16, 'K2', 0),
	(62, 3, 16, 'Matterhorn', 0),
	(63, 3, 16, 'Kilimanjaro', 0),
	(64, 3, 16, 'Everest', 1),
	(65, 3, 17, 'Canada', 1),
	(66, 3, 17, 'Indonesia', 0),
	(67, 3, 17, 'Russia', 0),
	(68, 3, 17, 'Australia', 0),
	(69, 3, 18, 'Arctic', 0),
	(70, 3, 18, 'Pacific', 1),
	(71, 3, 18, 'Atlantic', 0),
	(72, 3, 18, 'Indian', 0),
	(73, 4, 19, 'Carrot', 0),
	(74, 4, 19, 'Spinach', 1),
	(75, 4, 19, 'Tomato', 0),
	(76, 4, 19, 'Pepper', 0),
	(77, 4, 20, 'Spain', 0),
	(78, 4, 20, 'Portugal', 0),
	(79, 4, 20, 'Mexico', 1),
	(80, 4, 20, 'Brazil', 0),
	(81, 4, 21, 'Italy', 1),
	(82, 4, 21, 'Norway', 0),
	(83, 4, 21, 'Germany', 0),
	(84, 4, 21, 'Ukraine', 0),
	(85, 4, 22, 'Portugal', 1),
	(86, 4, 22, 'France', 0),
	(87, 4, 22, 'Belgium', 0),
	(88, 4, 22, 'Italy', 0),
	(89, 4, 23, 'A traditional Serbian patty', 1),
	(90, 4, 23, 'A traditional Russian Soup', 0),
	(91, 4, 23, 'A local drink from Latvia', 0),
	(92, 4, 23, 'A traditional Macedonian Soup', 0),
	(93, 4, 24, 'Coffee', 0),
	(94, 4, 24, 'Wine', 1),
	(95, 4, 24, 'Cheese', 0),
	(96, 4, 24, 'Bread', 0),
	(97, 4, 25, 'France', 0),
	(98, 4, 25, 'England', 1),
	(99, 4, 25, 'Italy', 0),
	(100, 4, 25, 'Netherlands', 0),
	(101, 4, 26, 'Miami', 0),
	(102, 4, 26, 'New York', 0),
	(103, 4, 26, 'Seattle', 1),
	(104, 4, 26, 'Boston', 0);
/*!40000 ALTER TABLE `answer_options` ENABLE KEYS */;

-- tablo yapısı dökülüyor quizapp.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_type` int(11) NOT NULL,
  `question` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_type` (`quiz_type`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- quizapp.questions: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
REPLACE INTO `questions` (`id`, `quiz_type`, `question`) VALUES
	(1, 1, 'How many movies are there in \'Rambo\' series?'),
	(2, 1, 'Which year \'Amores Perros\' released?'),
	(3, 1, 'Who was the lead actor of  \'Memento\'?'),
	(4, 1, 'Who played \'Kurtz\' in \'Apocalypse Now\'?'),
	(5, 1, 'What African country inspired the landscapes for the movie \'Lion King\'?'),
	(6, 2, 'Which country was the winner of Eurovision Song Contest in 1995?'),
	(7, 2, 'Which one of the following is the most sold album worldwide?'),
	(8, 2, 'Which composition is not belong to Ludwig van Beethoven?'),
	(9, 2, 'Which legendary rock band played their last ever show in February, 2017?'),
	(10, 2, 'Who wrote the \'Bohemian Rhapsody\'?'),
	(11, 2, 'Which song was sent to outer space with Voyager in 1977?'),
	(12, 3, 'Which one is the longest river on earth?'),
	(13, 3, 'Which of these countries have three national capitals?'),
	(14, 3, 'Which is Earth\'s longest continent by population?'),
	(15, 3, 'Which is the smallest independent country on Earth by area?'),
	(16, 3, 'Which is the highest mountain on Earth?'),
	(17, 3, 'Which country has the longest coastline in the world?'),
	(18, 3, 'Which is Earth\'s longest ocean by surface size?'),
	(19, 4, 'Which vegetable is served with \'Eggs Florentine\'?'),
	(20, 4, 'Tequila is a drink originating from which country?'),
	(21, 4, 'From which country does the bread called \'Ciabatta\' originate?'),
	(22, 4, 'Which country produces the wine \'Vinho Verde\'?'),
	(23, 4, 'What does \'Pljeskavica\' mean?'),
	(24, 4, '\'Malbec\', \'Sangiouese\', and \'Syrah\' are all a type of what?'),
	(25, 4, 'In which country did \'Cheddar Cheese\' originate?'),
	(26, 4, 'The original Starbucks was established in 1971 in what US city?');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

-- tablo yapısı dökülüyor quizapp.quiz_types
CREATE TABLE IF NOT EXISTS `quiz_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- quizapp.quiz_types: ~2 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `quiz_types` DISABLE KEYS */;
REPLACE INTO `quiz_types` (`id`, `quiz_type`) VALUES
	(1, 'Movies'),
	(2, 'Music'),
	(3, 'Geography'),
	(4, 'Food & Drink');
/*!40000 ALTER TABLE `quiz_types` ENABLE KEYS */;

-- tablo yapısı dökülüyor quizapp.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `quiz_type` int(11) NOT NULL,
  `result` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quiz_type` (`quiz_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- quizapp.user: ~0 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- tablo yapısı dökülüyor quizapp.user_activity
CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quiz_type` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer_option` int(11) NOT NULL,
  `is_answer_true` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_type` (`quiz_type`),
  KEY `question` (`question`),
  KEY `answer_option` (`answer_option`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- quizapp.user_activity: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `user_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activity` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

