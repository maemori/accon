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
  `saved_as` varchar(100) NOT NULL COMMENT '保存ファイル名',
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download`
--

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
/*!40000 ALTER TABLE `download` ENABLE KEYS */;
UNLOCK TABLES;

---
--- Initial data
---

INSERT INTO service_db.users_permissions (id, area, permission, description, actions, user_id, created_at, updated_at) VALUES (16, '/download', 'download', 'Downloadページ', 'a:3:{i:0;s:5:"index";i:1;s:4:"view";i:2;s:3:"get";}', 4, 1427757885, 1427757885);
INSERT INTO service_db.users_permissions (id, area, permission, description, actions, user_id, created_at, updated_at) VALUES (17, '/download', 'admin', 'Download管理', 'a:5:{i:0;s:5:"index";i:1;s:4:"edit";i:2;s:4:"view";i:3;s:6:"create";i:4;s:6:"delete";}', 4, 1427757925, 1427757925);

INSERT INTO service_db.users_role_permissions (id, role_id, perms_id, actions) VALUES (20, 2, 16, 'a:3:{s:5:"index";i:0;s:4:"view";i:1;s:3:"get";i:2;}');
INSERT INTO service_db.users_role_permissions (id, role_id, perms_id, actions) VALUES (23, 3, 17, 'a:5:{s:5:"index";i:0;s:4:"edit";i:1;s:4:"view";i:2;s:6:"create";i:3;s:6:"delete";i:4;}');
