--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE addresses (
  `add_id` int(11) NOT NULL AUTO_INCREMENT,
  `street_no` varchar(100) NOT NULL,
  `town` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`add_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

LOCK TABLES addresses WRITE;
INSERT INTO `addresses` VALUES (1,'Shaheen Bagh, Abul Fazal Enclave Part - II','Okhla','New Delhi','Delhi'),(2,'Shaheen Bagh, Abul Fazal Enclave Part - II','Okhla','New Delhi','Delhi'),(7,'K-97','Okhla','NEW DELHI','Delhi'),(8,'Shaheen Bagh, Abul Fazal Enclave Part - II','Okhla','New Delhi','Delhi');
UNLOCK TABLES;

--
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS feeds;

CREATE TABLE feeds (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `email` varchar(500) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `ftype` varchar(50) NOT NULL DEFAULT 'General Feedback',
  `msg` text NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feeds`
--

LOCK TABLES feeds WRITE;

UNLOCK TABLES;

--
-- Table structure for table `post_requirement`
--

DROP TABLE IF EXISTS `post_requirement`;

CREATE TABLE `post_requirement` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `bhk` int(11) NOT NULL,
  `bath` int(11) NOT NULL,
  `area` varchar(100) NOT NULL,
  `budget` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  KEY `c_fkey` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_requirement`
--

LOCK TABLES `post_requirement` WRITE;

INSERT INTO `post_requirement` VALUES (18,1,'Residential House','ewrr','wer',435,345,'1200-4000','50-268','2018-07-01 14:56:09','2018-07-01 15:42:53'),(19,6,'Residential House','Hahaha','Delhi',122,11,'100-10000','1-1000','2018-07-01 15:43:47',NULL);

UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;

CREATE TABLE `properties` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `add_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'Residential',
  `sid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `availability` tinyint(1) NOT NULL DEFAULT '0',
  `t_type` varchar(32) NOT NULL DEFAULT 'New',
  `title` varchar(64) NOT NULL,
  `bhk` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `furnished` tinyint(1) NOT NULL DEFAULT '0',
  `area` int(11) NOT NULL,
  `l_area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `d_price` tinyint(1) NOT NULL DEFAULT '1',
  `tnc` text,
  `b_desc` text,
  `edit` timestamp NULL DEFAULT NULL,
  `hospital` int(11) NOT NULL,
  `school` int(11) NOT NULL,
  `rail` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `floor` int(11) DEFAULT NULL,
  `t_floors` int(11) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `add_id` (`add_id`),
  KEY `s_fkey` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `properties`
--

LOCK TABLES `properties` WRITE;

INSERT INTO `properties` VALUES (1,2,'Residential',1,'2018-03-02 10:53:39',0,'New','Fatima Manzil',2,1,18,0,100,100,100000000,1,'','',NULL,1,1,3,1,-5,3),(2,7,'Residential',5,'2018-06-15 18:02:03',0,'New','Verna Kya ???',3,1,4,0,100,100,300000,1,'Hehehehe','Hahahaha','2018-06-26 12:10:05',1,1,3,1,2,5);

UNLOCK TABLES;

--
-- Table structure for table `property_amenities`
--

DROP TABLE IF EXISTS `property_amenities`;

CREATE TABLE `property_amenities` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `amenity` varchar(30) NOT NULL,
  PRIMARY KEY (`pa_id`),
  KEY `p_fkey` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_amenities`
--

LOCK TABLES `property_amenities` WRITE;
INSERT INTO `property_amenities` VALUES (1,1,'net'),(2,1,'ro'),(3,1,'gas'),(4,1,'water'),(7,2,'net'),(8,2,'ro'),(9,2,'gas'),(10,2,'water');
UNLOCK TABLES;

--
-- Table structure for table `property_images`
--

DROP TABLE IF EXISTS `property_images`;

CREATE TABLE `property_images` (
  `piid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `src` varchar(512) NOT NULL,
  PRIMARY KEY (`piid`),
  KEY `pid_fkey` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_images`
--

LOCK TABLES `property_images` WRITE;
INSERT INTO `property_images` VALUES (8,2,'resources/uploads/props/car_down50.png'),(9,2,'resources/uploads/props/car_left73.png'),(10,2,'resources/uploads/props/car_right12.png'),(11,2,'resources/uploads/props/car_up99.png'),(12,1,'resources/uploads/props/maxresdefault78.jpg'),(13,1,'resources/uploads/props/maxresdefault (1)84.jpg'),(14,1,'resources/uploads/props/Craftsmen28.jpg');
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(512) NOT NULL,
  `password` varchar(32) NOT NULL,
  `gender` varchar(16) NOT NULL,
  `contact` varchar(16) NOT NULL,
  `add_id` int(11) NOT NULL,
  `auth` tinyint(4) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `src` varchar(128) NOT NULL DEFAULT 'resources/uploads/users/temp.png',
  PRIMARY KEY (`user_id`),
  KEY `add_id` (`add_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
INSERT INTO `users` VALUES (1,'Rizwan','Raza','rizwan.raza987@gmail.com','123456789','Male','9718666289',1,2,'2018-03-02 10:17:42','resources/uploads/users/admins/favicon_big.png'),(6,'Jin','Kazama','mars.jinkazama@gmail.com','123456789','Male','9718666289',8,1,'2018-06-26 15:51:38','resources/uploads/users/temp.png');
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`wid`),
  KEY `cid` (`cid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
INSERT INTO `wishlist` VALUES (1,5,1,'2018-05-11 15:23:46');
UNLOCK TABLES;
