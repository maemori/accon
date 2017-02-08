USE service_db;

--
-- Table structure for table `menu_items`
--
DROP TABLE IF EXISTS `menus_contents`;
CREATE TABLE `menus_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Accon nested',
  `left_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `right_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `tree_id` int(11) unsigned NOT NULL COMMENT 'Accon nested',
  `perms_id` int(11)  DEFAULT NULL COMMENT 'Accon permissions',
  `menu_id` int(11)  DEFAULT NULL ,
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT 'ステータス',
  `public_at` int(11) DEFAULT NULL COMMENT '公開日時',
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `url` varchar(500) DEFAULT NULL COMMENT 'URL',
  `description` text DEFAULT NULL COMMENT '説明',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `left_id` (`left_id`), -- optional, might speed up certain lookup
  KEY `right_id` (`right_id`) -- optional, might speed up certain lookup
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Table structure for table `menu_tree`
--
DROP TABLE IF EXISTS `menus_menu`;
CREATE TABLE `menus_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT NULL COMMENT '表示順',
  `top_display_flag` tinyint(1) DEFAULT '0' COMMENT 'TOP表示フラグ',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8

