--
-- Table structure for table `book_contents`
--
DROP TABLE IF EXISTS `book_contents`;
CREATE TABLE `book_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `left_id` int(11) unsigned NOT NULL,
  `right_id` int(11) unsigned NOT NULL,
  `tree_id` int(11) unsigned NOT NULL,
  `perms_id` int(11)  DEFAULT NULL COMMENT 'Accon permissions',
  `slug_id` int(11) DEFAULT NULL COMMENT 'スラッグID',
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT 'ステータス',
  `public_at` int(11) DEFAULT NULL COMMENT '公開日時',
  `title` varchar(255) DEFAULT NULL COMMENT 'タイトル',
  `content` text NOT NULL COMMENT '内容',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `left_id` (`left_id`), -- optional, might speed up certain lookups
  KEY `right_id` (`right_id`) -- optional, might speed up certain lookups
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Table structure for table `slug`
--
DROP TABLE IF EXISTS `book_slug`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- data for table `slug`
--
LOCK TABLES `book_slug` WRITE;
INSERT INTO book_slug (sort, code, name, user_id, created_at, updated_at) VALUES (0, 'Standard', '標準', 2, 0, 0);
INSERT INTO book_slug (sort, code, name, user_id, created_at, updated_at) VALUES (1, 'Manual', 'マニュアル', 2, 0, 0);
INSERT INTO book_slug (sort, code, name, user_id, created_at, updated_at) VALUES (2, 'Help', 'ヘルプ', 2, 0, 0);
UNLOCK TABLES;



