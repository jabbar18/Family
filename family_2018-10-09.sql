# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.21)
# Database: family
# Generation Time: 2018-10-09 06:52:48 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  `AccountBalance` varchar(255) DEFAULT NULL,
  `MotherId` int(11) DEFAULT NULL,
  `FatherId` int(11) DEFAULT NULL,
  PRIMARY KEY (`MemberId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`MemberId`, `UserName`, `Password`, `MemberName`, `Qualification`, `ContactNumber`, `CNIC`, `Email`, `Gender`, `DateOfBirth`, `SchoolName`, `SchoolFees`, `SchoolContactNumber`, `SchoolLatitude`, `SchoolLongitude`, `SchoolAddress`, `MonthlyPocketMoney`, `AccountBalance`, `MotherId`, `FatherId`)
VALUES
	(1,'admin','admin','Abdul Jabbar Memon ','','033630840774','234234','jabbarmemon02@gmail.com','0','2018-09-08','','','','234324','234','Qasimabad Hyderabad','',NULL,NULL,NULL),
	(14,'admin','admin','test','','23','','','on','2018-10-12','','','','','e3','','',NULL,NULL,NULL),
	(15,'1234','1234','test 2','','3232','','','1','2018-10-09','','','','','','','','234234',14,1),
	(16,'admin','admin','raheel','','234','','','0','2018-10-09','','','','','','','','23',15,1);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
