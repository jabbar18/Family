# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: family
# Generation Time: 2018-10-09 06:33:43 +0000
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `DateTime` datetime DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `EventOrganizorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`EventId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`EventId`, `EventName`, `DateTime`, `Location`, `EventOrganizorId`)
VALUES
	(1,' test','2018-10-07 11:01:00',' Karachi Test',1);

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events_members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events_members`;

CREATE TABLE `events_members` (
  `EventMemberId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `EventId` int(11) DEFAULT NULL,
  PRIMARY KEY (`EventMemberId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table expence_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expence_items`;

CREATE TABLE `expence_items` (
  `ExpenceItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `Item` varchar(199) NOT NULL,
  PRIMARY KEY (`ExpenceItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `expence_items` WRITE;
/*!40000 ALTER TABLE `expence_items` DISABLE KEYS */;

INSERT INTO `expence_items` (`ExpenceItemsId`, `ExpenseId`, `Amount`, `Item`)
VALUES
	(1,5,2234,'234');

/*!40000 ALTER TABLE `expence_items` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;

INSERT INTO `expenses` (`ExpenseId`, `MemberId`, `Amount`, `DateTime`)
VALUES
	(1,NULL,0.00,NULL),
	(2,13,33.00,'2018-10-07 00:00:00'),
	(3,13,11.00,'2018-10-07 00:00:00'),
	(4,13,11.00,'2018-10-07 00:00:00'),
	(5,1,2234.00,'2018-10-09 00:00:00');

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
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `MemberName` varchar(255) DEFAULT '',
  `Qualification` varchar(255) DEFAULT '',
  `ContactNumber` varchar(255) DEFAULT '',
  `CNIC` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `DateOfBirth` varchar(255) DEFAULT NULL,
  `SchoolName` varchar(255) DEFAULT NULL,
  `SchoolFees` varchar(255) DEFAULT NULL,
  `SchoolContactNumber` varchar(255) DEFAULT NULL,
  `SchoolLatitude` varchar(255) DEFAULT NULL,
  `SchoolLongitude` varchar(255) DEFAULT NULL,
  `SchoolAddress` varchar(255) DEFAULT NULL,
  `MonthlyPocketMoney` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MemberId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`MemberId`, `UserName`, `Password`, `MemberName`, `Qualification`, `ContactNumber`, `CNIC`, `Email`, `Gender`, `DateOfBirth`, `SchoolName`, `SchoolFees`, `SchoolContactNumber`, `SchoolLatitude`, `SchoolLongitude`, `SchoolAddress`, `MonthlyPocketMoney`)
VALUES
	(1,'admin','admin','Abdul Jabbar Memon ','','033630840774','234234','jabbarmemon02@gmail.com','on','2018-09-08','','','','234324','234','Qasimabad Hyderabad',''),
	(14,'admin','admin','test','','23','','','on','2018-10-12','','','','','e3','','');

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table members_qualifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members_qualifications`;

CREATE TABLE `members_qualifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
