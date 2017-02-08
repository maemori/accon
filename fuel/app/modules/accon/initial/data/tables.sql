USE accon;
-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: service_db
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_contents`
--

DROP TABLE IF EXISTS `book_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `left_id` int(11) unsigned NOT NULL,
  `right_id` int(11) unsigned NOT NULL,
  `tree_id` int(11) unsigned NOT NULL,
  `perms_id` int(11) DEFAULT NULL COMMENT 'Accon permissions',
  `slug_id` int(11) DEFAULT NULL COMMENT 'スラッグID',
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT 'ステータス',
  `public_at` int(11) DEFAULT NULL COMMENT '公開日時',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル',
  `content` text NOT NULL COMMENT '内容',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `left_id` (`left_id`),
  KEY `right_id` (`right_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_contents`
--

LOCK TABLES `book_contents` WRITE;
/*!40000 ALTER TABLE `book_contents` DISABLE KEYS */;
INSERT INTO `book_contents` VALUES (45,1,10,1,69,3,'public',1435372080,'ネステッドコンテンツのサンプル','## 木構造のコンテンツサンプル\r\n\r\n  Markdown形式で記入します',2,1435372168,0),(46,2,3,1,NULL,NULL,'public',1435372200,'起承転結の起','## ネステッドコンテンツの管理は、管理メニューのBooksから行うことができます。\r\n',2,1435372358,0),(47,4,5,1,NULL,NULL,'public',1435372320,'起承転結の承','### Books機能は簡単に木構造の文章を作成・管理することができます。',2,1435372447,0),(48,6,7,1,NULL,NULL,'public',1435372440,'起承転結の転','## コーポレートサイト・マニュアル・FAQ・論文・本など、文書構造が存在するが存在するコンテンツに向いています。\r\n\r\n  Blogは時系列のコンテンツです。こちらはTOPの連絡に記載されてるACCONの実装サンプルを参照してください。',2,1435372720,0),(49,8,9,1,NULL,NULL,'public',1435372740,'起承転結の結','ACCONでは、このネステッドコンテンツ機能を使用したWebアプリケーションを驚くほど簡単に作成することができます。\r\n\r\nメニューやこの文章管理機能もACCONの機能を使用して作成されているます。\r\n\r\n詳しい内容は、ACCONの[マニュアル](https://kurobuta.jp/books/book/manual/accon/ \"マニュアル\")をご参照ください。',2,1435373043,0);
/*!40000 ALTER TABLE `book_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_slug`
--

DROP TABLE IF EXISTS `book_slug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_slug` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) unsigned NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_slug`
--

LOCK TABLES `book_slug` WRITE;
/*!40000 ALTER TABLE `book_slug` DISABLE KEYS */;
INSERT INTO `book_slug` VALUES (3,0,'Standard','標準',2,0,0);
/*!40000 ALTER TABLE `book_slug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `download`
--

DROP TABLE IF EXISTS `download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `pass` varchar(255) NOT NULL COMMENT 'パス',
  `saved_as` varchar(100) DEFAULT NULL,
  `name` varchar(100) NOT NULL COMMENT 'ファイル名',
  `status` varchar(45) DEFAULT NULL COMMENT 'ステータス',
  `public_at` int(11) DEFAULT NULL COMMENT '公開日時',
  `description` text NOT NULL COMMENT '説明',
  `impressions` int(11) DEFAULT NULL COMMENT '表示回数',
  `get_number` int(11) DEFAULT NULL COMMENT '取得回数',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`pass`,`saved_as`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download`
--

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
/*!40000 ALTER TABLE `download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_contents`
--

DROP TABLE IF EXISTS `menus_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Accon nested',
  `left_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `right_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `tree_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `perms_id` int(11) DEFAULT NULL COMMENT 'Accon permissions',
  `menu_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT 'ステータス',
  `public_at` int(11) DEFAULT NULL COMMENT '公開日時',
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `url` varchar(500) DEFAULT NULL COMMENT 'URL',
  `description` text COMMENT '説明',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `left_id` (`left_id`),
  KEY `right_id` (`right_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_contents`
--

LOCK TABLES `menus_contents` WRITE;
/*!40000 ALTER TABLE `menus_contents` DISABLE KEYS */;
INSERT INTO `menus_contents` VALUES (14,1,46,1,61,12,'public',1430715840,'管理',NULL,'管理メニュー',2,1430715942,1430911683),(16,1,4,2,62,13,'public',1430722980,'メニュー',NULL,'フロントメニュー',2,1430723053,1430911720),(17,2,27,1,1,NULL,'public',1430723040,'Accon管理','','Acconモジュール（アクセス制御機能）管理メニュー',2,1430723116,1430869854),(18,28,31,1,0,NULL,'public',1430723100,'Menu管理','','',2,1430723176,1430871969),(19,19,26,1,0,NULL,'public',1430724480,'ユーザ管理','','ユーザの管理、ユーザのパーミッションとロールを管理',2,1430724562,1430946739),(20,20,21,1,3,NULL,'public',1430724540,'ユーザ・マスタ','','ユーザマスターの閲覧・作成・更新・削除',2,1430724629,1430724629),(21,22,23,1,10,NULL,'public',1430724660,'ユーザ・パーミッション','','ユーザのパーミッションを管理',2,1430724663,1430724663),(22,24,25,1,11,NULL,'public',1430724660,'ユーザ・ロール','','ユーザのロールを管理',2,1430724702,1430724702),(23,1,4,3,63,14,'public',1430725140,'マニュアル',NULL,'Books利用サンプル\r\nネステッド（木構造）形式のコンテンツ管理',2,1430725160,1435370763),(25,3,4,1,5,NULL,'public',1430725440,'パーミッション管理','','パーミッションの管理',2,1430725474,1430725478),(26,32,37,1,0,NULL,'public',1430770620,'Books管理','','',2,1430770662,1430871981),(27,33,34,1,19,NULL,'public',1430770620,'Slug','','本の分類を管理',2,1430770692,1434952559),(28,35,36,1,18,NULL,'public',1430770740,'Maker','','本の作成・変更・削除・公開',2,1430770759,1434952583),(29,29,30,1,24,NULL,'public',0,'Maker','','メニューの作成・変更・削除・公開',2,1430770870,1434952543),(30,11,18,1,0,NULL,'public',1430773620,'グループ管理','','グループの管理',2,1430773645,1430773645),(31,12,13,1,6,NULL,'public',0,'グループ・マスタ','','グループの管理',2,1430773672,1430773674),(32,14,15,1,7,NULL,'public',1430773680,'グループ・パーミッション','','グループ・パーミッションの管理',2,1430773710,1430773714),(33,16,17,1,8,NULL,'public',1430773680,'グループ・ロール','','グループ・ロールの管理',2,1430773737,1430773739),(34,5,10,1,0,NULL,'public',1430870160,'ロール管理','','',2,1430870221,1430870226),(35,6,7,1,4,NULL,'public',1430870220,'ロール・マスタ','','ロールの管理',2,1430870266,1430870266),(36,8,9,1,9,NULL,'public',1430870220,'ロール・パーミッション','','ロールのパーミッション管理',2,1430870291,1430870291),(46,38,39,1,17,NULL,'public',1430872020,'Download管理','','公開用ファイルのアップロード・公開管理',2,1430872073,1430872073),(47,40,45,1,0,NULL,'public',1430872320,'Blog管理','','',2,1430872334,1430872334),(48,41,42,1,13,NULL,'public',1430872320,'Slug','','Blogのスラッグを管理',2,1430872387,1430872387),(49,43,44,1,12,NULL,'public',1430872440,'Post','','ブログの記事を管理',2,1430872462,1430872462),(50,2,3,2,14,NULL,'public',1430872680,'Blog','','WebでLogる\r\n時系列コンテンツ管理\r\n ACCON実装サンプル',2,1430872727,1435370505),(56,2,3,3,69,NULL,'public',1435373160,'Books機能のサンプル','','ネステッドコンテンツの利用サンプルです',2,1435373210,0);
/*!40000 ALTER TABLE `menus_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_menu`
--

DROP TABLE IF EXISTS `menus_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL COMMENT '表示順',
  `top_display_flag` tinyint(1) DEFAULT '0' COMMENT 'TOP表示フラグ',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_menu`
--

LOCK TABLES `menus_menu` WRITE;
/*!40000 ALTER TABLE `menus_menu` DISABLE KEYS */;
INSERT INTO `menus_menu` VALUES (12,100,0,2,1430715942,1430909267),(13,10,0,2,1430723053,1430909298),(14,20,0,2,1430725160,1435370763);
/*!40000 ALTER TABLE `menus_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `type` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `migration` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('package','auth','001_auth_create_usertables'),('package','auth','002_auth_create_grouptables'),('package','auth','003_auth_create_roletables'),('package','auth','004_auth_create_permissiontables'),('package','auth','005_auth_create_authdefaults'),('package','auth','006_auth_add_authactions'),('package','auth','007_auth_add_permissionsfilter'),('package','auth','008_auth_create_providers'),('package','auth','009_auth_create_oauth2tables'),('package','auth','010_auth_fix_jointables'),('app','default','006_create_users_groups');
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug_id` int(11) NOT NULL,
  `post_status` varchar(45) DEFAULT NULL,
  `public_at` int(11) DEFAULT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (10,'ようこそ',1,'public',1435370940,'<h2 style=\"border: 1px solid rgb(204, 204, 204); padding: 5px 10px; background: rgb(238, 238, 238);\"><span style=\"color:#000080\">ACCONが正常に機能しています</span></h2>\r\n','<h2>シンプルなBlog機能（<span style=\"background-color:#F0FFFF\">ACCON利用した実装サンプル</span>）</h2>\r\n\r\n<ol>\r\n	<li>管理機能</li>\r\n</ol>\r\n\r\n<ul style=\"margin-left: 40px;\">\r\n	<li>View\r\n	<ul>\r\n		<li>&nbsp;</li>\r\n	</ul>\r\n	</li>\r\n	<li>Model</li>\r\n	<li>Controller</li>\r\n</ul>\r\n',2,1435371547,NULL),(11,'初期ユーザについて',1,'public',1435374120,'<h3>ユーザID/パスワード（グループ）</h3>\r\n\r\n<p>&nbsp;* Ushi/password (Banned)<br />\r\n&nbsp;* Guest/password (Guests)<br />\r\n&nbsp;* Inu/password (Users)<br />\r\n&nbsp;* Uma/password (Moderators)<br />\r\n&nbsp;* Kuroneko/password (Tester)<br />\r\n&nbsp;* Kurobuta/password (Developers)<br />\r\n&nbsp;* Yagi/password (Operators)<br />\r\n&nbsp;* Admin/password (Administrators)<br />\r\n&nbsp;* Accon/password (Super Admins)</p>\r\n\r\n<h3>アカウントの<span style=\"color:#B22222\"><span style=\"background-color:#FFF0F5\">パスワードは必ず変更</span></span>してください。また、不要なアカウントは削除し新規に作成することを推奨します。</h3>\r\n\r\n<p>Guestユーザはシステムで使用しているため削除できません。（ログインしていないユーザは全てGuestユーザとして機能します）</p>\r\n','<h2>アクセス制御の管理は、管理メニューから行えます。</h2>\r\n\r\n<p>アクセス制御に関する情報は<span style=\"background-color:#FFA07A\">キャッシュ化されている</span>ため、変更した内容を反映するためには<span style=\"color:#FFA07A\">アカウントメニュー</span>の<span style=\"background-color:#FFA07A\">キャッシュクリア</span>を実行する必要があります。</p>\r\n\r\n<p>&nbsp;* キュアッシュのクリアはDevelop以上の権限が必要です。（初期値）</p>\r\n\r\n<p>&nbsp;</p>\r\n',2,1435374602,1435375708);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slug`
--

DROP TABLE IF EXISTS `slug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slug`
--

LOCK TABLES `slug` WRITE;
/*!40000 ALTER TABLE `slug` DISABLE KEYS */;
INSERT INTO `slug` VALUES (1,'News',4,1427149571,1427149571),(2,'Blog',4,1427149580,1427149580);
/*!40000 ALTER TABLE `slug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `last_login` varchar(25) NOT NULL,
  `previous_login` varchar(25) NOT NULL DEFAULT '0',
  `login_hash` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`username`),
  UNIQUE KEY `UNIQUE2` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'Guest','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',1,'guest@accon.jp','0','0','',2,1419896560,1435362682),(1,'Admin','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',7,'admin@accon.jp','1433708234','1433707837','1aa8bdaf020630d902aab9e7c1da86400d28cda0',2,1419896560,1435362673),(2,'Kurobuta','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',5,'kurobuta@accon.jp','1435362154','1435316422','a239c901ecb9f6e04d25609c8127b603c596cc69',2,1425712557,1435362701),(3,'Kuroneko','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',4,'kuroneko@accon.jp','0','0','',2,1425518782,1435362711),(4,'Inu','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',2,'inu@accon.jp','1434019032','1433979211','7916fa5d4079f1ac05095814af186bd7a13cfbb6',2,1426545474,1435362692),(5,'Uma','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',3,'uma@accon.jp','0','0','',2,1425712557,1435362721),(6,'Ushi','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',0,'ushi@accon.jp','0','0','',2,1426545474,1435362738),(7,'Yagi','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',6,'yagi@accon.jp','0','0','',2,1426545474,1435362756),(8,'Accon','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',8,'accon@accon.jp','0','0','',2,1426545474,1435362327);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_clients`
--

DROP TABLE IF EXISTS `users_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `client_secret` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `auto_approve` tinyint(1) NOT NULL DEFAULT '0',
  `autonomous` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('development','pending','approved','rejected') NOT NULL DEFAULT 'development',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_clients`
--

LOCK TABLES `users_clients` WRITE;
/*!40000 ALTER TABLE `users_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_group_permissions`
--

DROP TABLE IF EXISTS `users_group_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `perms_id` int(11) NOT NULL,
  `actions` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`group_id`,`perms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_group_permissions`
--

LOCK TABLES `users_group_permissions` WRITE;
/*!40000 ALTER TABLE `users_group_permissions` DISABLE KEYS */;
INSERT INTO `users_group_permissions` VALUES (1,1,3,'a:1:{s:8:\"register\";i:6;}'),(2,5,3,'a:8:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:8:\"password\";i:5;s:8:\"register\";i:6;s:6:\"modify\";i:7;}'),(3,5,4,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(4,5,5,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(5,5,6,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(6,5,7,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(7,5,8,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(8,5,9,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(9,5,10,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(10,5,11,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}');
/*!40000 ALTER TABLE `users_group_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_group_roles`
--

DROP TABLE IF EXISTS `users_group_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_group_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`group_id`,`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_group_roles`
--

LOCK TABLES `users_group_roles` WRITE;
/*!40000 ALTER TABLE `users_group_roles` DISABLE KEYS */;
INSERT INTO `users_group_roles` VALUES (1,0,1),(28,1,2),(3,2,2),(4,2,3),(5,3,2),(6,3,3),(7,3,4),(8,4,2),(9,4,3),(10,4,4),(11,5,2),(12,5,3),(13,5,4),(14,5,5),(15,6,2),(16,6,3),(17,6,4),(18,7,2),(19,7,3),(20,7,4),(21,7,5),(22,7,6),(23,8,7);
/*!40000 ALTER TABLE `users_group_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (0,'Banned',1,0,0),(1,'Guests',1,0,0),(2,'Users',1,0,0),(3,'Moderators',1,0,0),(4,'Tester',1,0,0),(5,'Developers',1,0,0),(6,'Operators',1,0,0),(7,'Administrators',1,0,0),(8,'Super Admins',1,0,0);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_metadata`
--

DROP TABLE IF EXISTS `users_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(20) NOT NULL,
  `value` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_metadata`
--

LOCK TABLES `users_metadata` WRITE;
/*!40000 ALTER TABLE `users_metadata` DISABLE KEYS */;
INSERT INTO `users_metadata` VALUES (1,1,'fullname','System administrator',0,1419896560,0),(2,0,'fullname','Guest',0,0,0);
/*!40000 ALTER TABLE `users_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_permissions`
--

DROP TABLE IF EXISTS `users_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `area` varchar(25) NOT NULL,
  `permission` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `actions` text,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission` (`area`,`permission`),
  UNIQUE KEY `UNIQUE` (`area`,`permission`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
INSERT INTO `users_permissions` VALUES (1,'/accon','admin','サービス一覧','a:1:{i:0;s:5:\"index\";}',4,1425668227,1427601715),(2,'Service','Cache','サーバーのキャッシュ全削除','a:1:{i:0;s:6:\"delete\";}',4,1425669669,1425669669),(3,'/accon/admin','user','ユーザ管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:8:\"password\";i:6;s:8:\"register\";i:7;s:6:\"modify\";i:8;s:15:\"modify_password\";}',4,1425670497,1428122727),(4,'/accon/admin','role','ロール管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713296,1427601452),(5,'/accon/admin','permission','パーミッション管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713332,1427601470),(6,'/accon/admin','group','グループ管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713359,1427601517),(7,'/accon/admin/group','permission','グループ権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713393,1427601539),(8,'/accon/admin/group','role','グループとロールを関連付け','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713422,1427601614),(9,'/accon/admin/role','permission','ロール権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713454,1427601635),(10,'/accon/admin/user','permission','ユーザ権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713490,1427601675),(11,'/accon/admin/user','role','ユーザとロールの関連付け','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713516,1427601693),(12,'/blog','post','Blog 記事投稿','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1426806491,1427601733),(13,'/blog','slug','Blog 投稿分類','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1427149497,1427601745),(14,'/blog','front','Blog （一般公開）','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1427153070,1430891983),(15,'/','welcome','TOPページ','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1427622290,1427622290),(17,'/download','admin','Download管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1427757925,1427757925),(18,'/books','maker','Bookの管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',2,1428280602,1434952475),(19,'/books','slug','Books slug 管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1428282623,1428282623),(20,'/books','contents','Book コンテンツ管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:6:\"parent\";i:6;s:5:\"child\";i:7;s:2:\"up\";i:8;s:4:\"down\";}',4,1428290682,1428314374),(21,'/books','book','Bookの一覧','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',4,1428933247,1430699052),(22,'/books','books','Book閲覧','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1428934543,1428934780),(23,'/menus','menus','メニュー管理','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1428943139,1428943435),(24,'/menus','maker','メニュー管理機能','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',2,1428943523,1434952490),(25,'/menus','contents','メニューの構成管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:6:\"parent\";i:6;s:5:\"child\";i:7;s:2:\"up\";i:8;s:4:\"down\";}',4,1429136945,1429136969),(28,'/accon/ajax/admin','permission','Ajax permission list','a:1:{i:0;s:6:\"action\";}',4,1429184596,1429184596),(30,'/books/ajax','slug','SlugからURLを取得','a:1:{i:0;s:4:\"area\";}',2,1429299869,1429299939),(60,'/menus/ajax','menu','メニューリスト','a:4:{i:0;s:4:\"list\";i:1;s:5:\"items\";i:2;s:10:\"breadcrumb\";i:3;s:6:\"return\";}',2,1430715553,1430768243),(61,'/menus/menu','admin','管理','a:1:{i:0;s:5:\"index\";}',2,1430715942,1435100980),(62,'/menus/menu','front','メニュー','a:1:{i:0;s:5:\"index\";}',2,1430723053,1435100986),(63,'/menus/menu','manual','マニュアル','a:1:{i:0;s:5:\"index\";}',2,1430725160,1435370763),(69,'/books/book/standard','tree-structure-sample','ネステッドコンテンツのサンプル','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1435372168,0);
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_providers`
--

DROP TABLE IF EXISTS `users_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `provider` varchar(50) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `expires` int(12) DEFAULT '0',
  `refresh_token` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_providers`
--

LOCK TABLES `users_providers` WRITE;
/*!40000 ALTER TABLE `users_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_role_permissions`
--

DROP TABLE IF EXISTS `users_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_role_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `perms_id` int(11) NOT NULL,
  `actions` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`role_id`,`perms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_role_permissions`
--

LOCK TABLES `users_role_permissions` WRITE;
/*!40000 ALTER TABLE `users_role_permissions` DISABLE KEYS */;
INSERT INTO `users_role_permissions` VALUES (1,3,3,'a:2:{s:6:\"modify\";i:7;s:15:\"modify_password\";i:8;}'),(2,3,4,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(3,3,5,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(4,3,6,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(5,3,7,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(6,3,8,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(7,3,9,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(10,3,1,'a:1:{s:5:\"index\";i:0;}'),(11,2,15,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(12,2,14,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(14,3,12,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(15,3,13,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(16,3,17,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(18,3,19,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(19,3,18,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(20,3,20,'a:9:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:6:\"parent\";i:5;s:5:\"child\";i:6;s:2:\"up\";i:7;s:4:\"down\";i:8;}'),(21,2,21,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(22,2,22,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(23,3,23,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(24,3,24,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(25,3,25,'a:9:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:6:\"parent\";i:5;s:5:\"child\";i:6;s:2:\"up\";i:7;s:4:\"down\";i:8;}'),(26,3,28,'a:1:{s:6:\"action\";i:0;}'),(27,5,2,'a:1:{s:6:\"delete\";i:0;}'),(28,3,30,'a:1:{s:4:\"area\";i:0;}'),(38,2,60,'a:4:{s:4:\"list\";i:0;s:5:\"items\";i:1;s:10:\"breadcrumb\";i:2;s:6:\"return\";i:3;}'),(43,5,3,'a:6:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:8:\"password\";i:5;}'),(44,5,11,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(45,5,10,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(46,2,63,'a:1:{s:5:\"index\";i:0;}'),(47,3,61,'a:1:{s:5:\"index\";i:0;}'),(48,2,62,'a:1:{s:5:\"index\";i:0;}'),(51,2,69,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}');
/*!40000 ALTER TABLE `users_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_roles`
--

DROP TABLE IF EXISTS `users_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `filter` enum('','A','D','R') NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,'0.banned','D',1,0,1425712837),(2,'1.public','',1,0,1425712846),(3,'2.user','',1,0,1429252353),(4,'3.moderator','',1,0,1429252360),(5,'4.develop','',1,1429249151,1429252368),(6,'5.administrator','',1,0,1429252376),(7,'6.superadmin','A',1,0,1429252383);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_scopes`
--

DROP TABLE IF EXISTS `users_scopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `scope` (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_scopes`
--

LOCK TABLES `users_scopes` WRITE;
/*!40000 ALTER TABLE `users_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_scopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_sessions`
--

DROP TABLE IF EXISTS `users_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) NOT NULL DEFAULT '',
  `redirect_uri` varchar(255) NOT NULL DEFAULT '',
  `type_id` varchar(64) NOT NULL,
  `type` enum('user','auto') NOT NULL DEFAULT 'user',
  `code` text NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `stage` enum('request','granted') NOT NULL DEFAULT 'request',
  `first_requested` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL,
  `limited_access` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `oauth_sessions_ibfk_1` (`client_id`),
  CONSTRAINT `oauth_sessions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users_clients` (`client_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_sessions`
--

LOCK TABLES `users_sessions` WRITE;
/*!40000 ALTER TABLE `users_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_sessionscopes`
--

DROP TABLE IF EXISTS `users_sessionscopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_sessionscopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `access_token` varchar(50) NOT NULL DEFAULT '',
  `scope` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `session_id` (`session_id`),
  KEY `access_token` (`access_token`),
  KEY `scope` (`scope`),
  CONSTRAINT `oauth_sessionscopes_ibfk_1` FOREIGN KEY (`scope`) REFERENCES `users_scopes` (`scope`),
  CONSTRAINT `oauth_sessionscopes_ibfk_2` FOREIGN KEY (`session_id`) REFERENCES `users_sessions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_sessionscopes`
--

LOCK TABLES `users_sessionscopes` WRITE;
/*!40000 ALTER TABLE `users_sessionscopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_sessionscopes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_user_permissions`
--

DROP TABLE IF EXISTS `users_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `perms_id` int(11) NOT NULL,
  `actions` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`user_id`,`perms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_user_permissions`
--

LOCK TABLES `users_user_permissions` WRITE;
/*!40000 ALTER TABLE `users_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_user_roles`
--

DROP TABLE IF EXISTS `users_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_user_roles`
--

LOCK TABLES `users_user_roles` WRITE;
/*!40000 ALTER TABLE `users_user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_user_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-27 13:52:43
