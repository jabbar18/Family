/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.1.36-MariaDB : Database - family
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`family` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `family`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

insert  into `admin`(`admin_id`,`user_name`,`password`) values (1,'admin','12345');

/*Table structure for table `birthday` */

DROP TABLE IF EXISTS `birthday`;

CREATE TABLE `birthday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `BirthdayMessage` text,
  `WishDateTime` datetime DEFAULT NULL,
  `BirthdayMemberId` int(11) DEFAULT NULL,
  `MemberWisherId` int(11) DEFAULT NULL,
  `Status` int(3) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `birthday` */

insert  into `birthday`(`id`,`BirthdayMessage`,`WishDateTime`,`BirthdayMemberId`,`MemberWisherId`,`Status`) values (1,'happy Birthday day May Allah Bless you','2018-10-21 02:59:59',18,14,1),(2,'happy birthay day','2018-10-21 03:06:35',29,14,1),(3,'janam din mubarak','2018-10-21 03:08:13',18,14,1),(4,'happy','2018-12-02 09:35:44',21,41,1);

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `comments` */

/*Table structure for table `event_members` */

DROP TABLE IF EXISTS `event_members`;

CREATE TABLE `event_members` (
  `EventId` int(11) DEFAULT NULL,
  `MemberId` int(11) DEFAULT NULL,
  KEY `MemberId` (`MemberId`),
  KEY `EventId` (`EventId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `event_members` */

/*Table structure for table `events` */

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `EventId` int(11) NOT NULL AUTO_INCREMENT,
  `EventName` varchar(255) DEFAULT NULL,
  `Description` text,
  `DateTime` datetime DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `EventOrganizorId` int(11) NOT NULL,
  PRIMARY KEY (`EventId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `events` */

insert  into `events`(`EventId`,`EventName`,`Description`,`DateTime`,`Location`,`EventOrganizorId`) values (2,'event new',NULL,'2018-10-09 04:44:00','hyderabd',1),(5,'React KHI','react native kaarachio ','2018-10-10 02:02:00','sukkur',14),(6,'test','test','2018-10-15 15:33:00','asdadf',14),(7,'beg','asdasd','2018-10-16 02:22:00','Karachi',15);

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `ExpenseId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MemberId` int(11) NOT NULL,
  `Amount` double(12,2) DEFAULT '0.00',
  `DateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ExpenseId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `expenses` */

insert  into `expenses`(`ExpenseId`,`MemberId`,`Amount`,`DateTime`) values (2,1,234.00,'2018-11-03 00:00:00'),(3,18,200000.00,'2018-11-03 00:00:00'),(4,21,121212.00,'2018-12-02 00:00:00');

/*Table structure for table `expenses_items` */

DROP TABLE IF EXISTS `expenses_items`;

CREATE TABLE `expenses_items` (
  `ExpenceItemsId` int(11) NOT NULL AUTO_INCREMENT,
  `ExpenseId` int(11) DEFAULT NULL,
  `Amount` int(11) NOT NULL,
  `Item` varchar(199) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ExpenceItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `expenses_items` */

insert  into `expenses_items`(`ExpenceItemsId`,`ExpenseId`,`Amount`,`Item`) values (1,1,243,'dscf'),(2,2,234,'234'),(3,3,200000,'test'),(4,4,121212,'asdsa');

/*Table structure for table `grocery` */

DROP TABLE IF EXISTS `grocery`;

CREATE TABLE `grocery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `grocery` */

/*Table structure for table `grocery_items` */

DROP TABLE IF EXISTS `grocery_items`;

CREATE TABLE `grocery_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `grocery_items` */

/*Table structure for table `member_detail` */

DROP TABLE IF EXISTS `member_detail`;

CREATE TABLE `member_detail` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `member_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `member_detail` */

insert  into `member_detail`(`member_id`,`parent_id`,`first_name`,`last_name`,`member_img`) values (1,NULL,'AAA','AA','159'),(2,1,'BB','AAA','123'),(3,1,'CC','AAA','1597'),(4,2,'DD','BB',''),(5,2,'EE','BB',''),(6,2,'FF','BB',''),(7,3,'HH','CC',''),(8,3,'WW','CC','1596'),(9,4,'II','DD','dd'),(10,6,'KK','FF',''),(11,6,'KB','FF',''),(12,5,'LL','EE',''),(13,5,'MM','EE',''),(14,4,'JJ','JJ',''),(15,7,'OO','HH','456'),(16,8,'JI','WW','519'),(17,12,'PP','LL','789'),(18,10,'RK','KK',NULL),(19,10,'VK','KK',''),(20,8,'YY','BB',''),(21,18,'RJ','LL',''),(22,2,'GG','BB',''),(23,21,'RT','RJ','159');

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `MemberId` int(11) NOT NULL AUTO_INCREMENT,
  `Admin` int(11) DEFAULT '0',
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `MemberName` varchar(255) DEFAULT '',
  `Photo` varchar(255) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

/*Data for the table `members` */

insert  into `members`(`MemberId`,`Admin`,`UserName`,`Password`,`MemberName`,`Photo`,`Qualification`,`ContactNumber`,`CNIC`,`Email`,`Gender`,`SchoolName`,`SchoolFees`,`SchoolContactNumber`,`SchoolLatitude`,`SchoolLongitude`,`SchoolAddress`,`MonthlyPocketMoney`,`AccountBalance`,`MotherId`,`FatherId`,`DateOfBirth`) values (1,1,'admin','admin','Abdul Jabbar Memon',NULL,'','23','3423423','jabbarmemon02@gmail.com','0','','','','','e3','','',NULL,15,18,NULL),(18,0,'jabbar','jabbar','Abdul Jabbar',NULL,'BA','23423','234','jabbarmemon02@gmail.com','0','BFC','1234134','03363084077','12313','13212','Qasimabad Hyderabad','2000','0',15,0,'2018-10-21'),(21,0,'admin3','admin3','testing',NULL,'sdfsd','03363084077','43535','jabbarmemon02@gmail.com','1','f','','','','','Qasimabad Hyderabad','23423','23302209',16,1,'2018-12-02'),(41,0,'test','test','test','25157.png','','','','','0','','','','','','','','',0,0,'2018-12-20');

/*Table structure for table `monthly_income` */

DROP TABLE IF EXISTS `monthly_income`;

CREATE TABLE `monthly_income` (
  `MonthlyIncomeId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MemberId` int(11) DEFAULT NULL,
  `Income` double DEFAULT NULL,
  `MonthlyIncomeAddedOn` datetime DEFAULT NULL,
  `MonthlyIncomeAddedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`MonthlyIncomeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `monthly_income` */

/*Table structure for table `places` */

DROP TABLE IF EXISTS `places`;

CREATE TABLE `places` (
  `PlaceId` int(11) NOT NULL AUTO_INCREMENT,
  `PlaceName` varchar(255) DEFAULT NULL,
  `MemberId` int(11) DEFAULT NULL,
  `Latitude` double DEFAULT NULL,
  `Longitude` double DEFAULT NULL,
  PRIMARY KEY (`PlaceId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `places` */

insert  into `places`(`PlaceId`,`PlaceName`,`MemberId`,`Latitude`,`Longitude`) values (1,'Karachi',1,12313,123123),(2,'adfaf',18,23423,23423);

/*Table structure for table `places_members` */

DROP TABLE IF EXISTS `places_members`;

CREATE TABLE `places_members` (
  `PlaceId` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  PRIMARY KEY (`PlaceId`,`MemberId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `places_members` */

insert  into `places_members`(`PlaceId`,`MemberId`) values (1,18),(1,21),(1,41),(2,18),(2,21),(2,41);

/*Table structure for table `polls` */

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
  PRIMARY KEY (`PollId`),
  KEY `PollAddedBy` (`PollAddedBy`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `polls` */

insert  into `polls`(`PollId`,`Question`,`Answer1`,`Answer2`,`Answer3`,`Answer4`,`Answer5`,`Answer6`,`PollStartDateTime`,`PollEndDateTime`,`Status`,`StatusUpdates`,`Notes`,`PollAddedOn`,`PollAddedBy`) values (2,'test','a','b','1','d',NULL,NULL,'2018-10-28 11:11:00','2018-10-29 11:11:00',1,NULL,'ads','2018-10-28 00:00:00',1),(3,'hello','1','2','41','4',NULL,NULL,'2018-12-02 14:33:00','2018-12-19 00:12:00',1,NULL,'asd','2018-12-02 00:00:00',41);

/*Table structure for table `polls_answers` */

DROP TABLE IF EXISTS `polls_answers`;

CREATE TABLE `polls_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `QuestionId` int(3) DEFAULT NULL,
  `AnswerId` int(3) DEFAULT NULL,
  `MemberId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `QuestionId` (`QuestionId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `polls_answers` */

insert  into `polls_answers`(`id`,`QuestionId`,`AnswerId`,`MemberId`) values (1,1,3,1),(2,1,1,1),(3,1,2,1),(4,1,3,1),(5,1,2,1),(6,1,2,1),(33,2,3,14),(34,2,2,1),(35,1,1,18),(36,1,2,16),(37,2,2,16),(38,3,1,41),(39,3,1,21);

/*Table structure for table `polls_members` */

DROP TABLE IF EXISTS `polls_members`;

CREATE TABLE `polls_members` (
  `MemberId` int(11) DEFAULT NULL,
  `PollId` int(11) DEFAULT NULL,
  `Answer` int(11) DEFAULT '0',
  KEY `MemberId` (`MemberId`),
  KEY `PollId` (`PollId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `polls_members` */

insert  into `polls_members`(`MemberId`,`PollId`,`Answer`) values (1,1,NULL),(15,1,NULL),(16,1,NULL),(18,1,NULL),(1,2,0),(16,2,0),(1,3,0),(18,3,0),(21,3,0),(41,3,0);

/*Table structure for table `todo` */

DROP TABLE IF EXISTS `todo`;

CREATE TABLE `todo` (
  `TodoId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text,
  `TodoDate` date DEFAULT NULL,
  `TodoMemberId` int(11) DEFAULT NULL,
  `DeadlineDate` date DEFAULT NULL,
  PRIMARY KEY (`TodoId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `todo` */

insert  into `todo`(`TodoId`,`Title`,`Description`,`TodoDate`,`TodoMemberId`,`DeadlineDate`) values (1,'tes','asd','2018-10-04',1,'2018-12-01'),(6,'mantance database','here','2018-07-01',18,'2018-12-01'),(7,'test','testdgvfg','2018-10-28',1,'2018-10-28'),(8,'asdasd','adsads','2018-11-04',1,'2018-11-06'),(9,'','','0000-00-00',1,'0000-00-00'),(10,'jabbar','adsasd','2018-10-04',1,'2018-10-04'),(11,'asd','qwe','2018-11-04',1,'2018-11-04'),(12,'test','dsfd','2018-12-20',41,'2018-12-28'),(13,'as','asd','2018-12-02',21,'2018-12-02');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
