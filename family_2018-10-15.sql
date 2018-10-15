# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: family
# Generation Time: 2018-10-15 16:52:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`admin_id`, `user_name`, `password`)
VALUES
	(1,'admin','12345');

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table charity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `charity`;

CREATE TABLE `charity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table department
# ------------------------------------------------------------

DROP TABLE IF EXISTS `department`;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table discussions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `discussions`;

CREATE TABLE `discussions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `EventId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) DEFAULT NULL,
  `Description` text,
  `DateTime` datetime DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `EventOrganizorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`EventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`EventId`, `EventName`, `Description`, `DateTime`, `Location`, `EventOrganizorId`)
VALUES
	(2,'event new',NULL,'2018-10-09 04:44:00','hyderabd',1),
	(5,'React KHI','react native kaarachio ','2018-10-10 02:02:00','sukkur',14);

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events_members`;

CREATE TABLE `events_members` (
  `EventId` int(11) DEFAULT NULL,
  `MemberId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table expenses_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses_items`;

CREATE TABLE `expenses_items` (
  `ExpenceItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Item` varchar(199) NOT NULL,
  PRIMARY KEY (`ExpenceItemsId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `expenses_items` WRITE;
/*!40000 ALTER TABLE `expenses_items` DISABLE KEYS */;

INSERT INTO `expenses_items` (`ExpenceItemsId`, `ExpenseId`, `Amount`, `Item`)
VALUES
	(1,1,2234,'234'),
	(2,1,1234,'tewst'),
	(3,6,5678,'test 2'),
	(4,7,1000,'test 1'),
	(5,7,500,'test 2');

/*!40000 ALTER TABLE `expenses_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `ExpenseId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MemberId` int(11) DEFAULT NULL,
  `Amount` double(12,2) DEFAULT '0.00',
  `DateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ExpenseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;

INSERT INTO `expenses` (`ExpenseId`, `MemberId`, `Amount`, `DateTime`)
VALUES
	(1,18,234234.00,'2018-10-07 00:00:00'),
	(3,13,11.00,'2018-10-07 00:00:00'),
	(4,13,11.00,'2018-10-07 00:00:00'),
	(5,1,2234.00,'2018-10-09 00:00:00'),
	(6,16,6912.00,'2018-10-14 00:00:00'),
	(7,15,1500.00,'2018-10-15 00:00:00');

/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table grocery
# ------------------------------------------------------------

DROP TABLE IF EXISTS `grocery`;

CREATE TABLE `grocery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table grocery_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `grocery_items`;

CREATE TABLE `grocery_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `MemberId` int(11) NOT NULL AUTO_INCREMENT,
  `Admin` int(11) DEFAULT '0',
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `MemberName` varchar(255) DEFAULT '',
  `Qualification` varchar(255) DEFAULT '',
  `ContactNumber` varchar(255) DEFAULT '',
  `CNIC` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `SchoolName` varchar(255) DEFAULT NULL,
  `SchoolFees` varchar(255) DEFAULT NULL,
  `SchoolContactNumber` varchar(255) DEFAULT NULL,
  `SchoolLatitude` varchar(255) DEFAULT NULL,
  `SchoolLongitude` varchar(255) DEFAULT NULL,
  `SchoolAddress` varchar(255) DEFAULT NULL,
  `MonthlyPocketMoney` varchar(255) DEFAULT NULL,
  `AccountBalance` varchar(255) DEFAULT NULL,
  `MotherId` int(11) DEFAULT NULL,
  `FatherId` int(11) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  PRIMARY KEY (`MemberId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`MemberId`, `Admin`, `UserName`, `Password`, `MemberName`, `Qualification`, `ContactNumber`, `CNIC`, `Email`, `Gender`, `SchoolName`, `SchoolFees`, `SchoolContactNumber`, `SchoolLatitude`, `SchoolLongitude`, `SchoolAddress`, `MonthlyPocketMoney`, `AccountBalance`, `MotherId`, `FatherId`, `DateOfBirth`)
VALUES
	(14,1,'admin','admin','Abdul Jabbar Memon','','23','3423423','jabbarmemon02@gmail.com','0','','','','','e3','','',NULL,15,16,NULL),
	(15,0,'1234','1234','test 2','','3232','','','1','','','','','','','','234234',14,1,NULL),
	(16,0,'admin','admin','raheel','','234','','','0','','','','','','','','23',15,1,NULL),
	(18,0,'jabbarmemon','12345','Abdul Jabbar','BA','23423','234','jabbarmemon02@gmail.com','0','BFC','1234134','03363084077','12313','13212','Qasimabad Hyderabad','2000','200000',15,16,NULL);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table monthly_income
# ------------------------------------------------------------

DROP TABLE IF EXISTS `monthly_income`;

CREATE TABLE `monthly_income` (
  `MonthlyIncomeId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MemberId` int(11) DEFAULT NULL,
  `Income` double DEFAULT NULL,
  `MonthlyIncomeAddedOn` datetime DEFAULT NULL,
  `MonthlyIncomeAddedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`MonthlyIncomeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table polls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `polls`;

CREATE TABLE `polls` (
  `PollId` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text CHARACTER SET utf8,
  `Answer1` text CHARACTER SET utf8,
  `Answer2` text CHARACTER SET utf8,
  `Answer3` text CHARACTER SET utf8,
  `Answer4` text CHARACTER SET utf8,
  `Answer5` text CHARACTER SET utf8,
  `Answer6` text CHARACTER SET utf8,
  `PollStartDateTime` datetime DEFAULT NULL,
  `PollEndDateTime` datetime DEFAULT NULL,
  `Status` tinyint(3) DEFAULT '1',
  `StatusUpdates` text CHARACTER SET utf8,
  `Notes` text CHARACTER SET utf8,
  `PollAddedOn` datetime DEFAULT NULL,
  `PollAddedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`PollId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table polls_answers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `polls_answers`;

CREATE TABLE `polls_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table reminders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reminders`;

CREATE TABLE `reminders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table todo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `todo`;

CREATE TABLE `todo` (
  `TodoId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text,
  `TodoDate` date DEFAULT NULL,
  `TodoMemberId` int(11) DEFAULT NULL,
  PRIMARY KEY (`TodoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `todo` WRITE;
/*!40000 ALTER TABLE `todo` DISABLE KEYS */;

INSERT INTO `todo` (`TodoId`, `Title`, `Description`, `TodoDate`, `TodoMemberId`)
VALUES
	(1,'tes','asd','2018-10-04',1);

/*!40000 ALTER TABLE `todo` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
