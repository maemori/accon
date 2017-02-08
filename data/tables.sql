-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: service_db
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_contents`
--

LOCK TABLES `book_contents` WRITE;
/*!40000 ALTER TABLE `book_contents` DISABLE KEYS */;
INSERT INTO `book_contents` VALUES (8,1,20,1,49,4,'public',1429316160,'本のタイトル','## 本のテスト\r\n\r\n### あああああ\r\n\r\n  あああああああああああああああああああああああああああああああああああああ\r\n\r\n### いいいい\r\n\r\n  いいいいいいいいいいいいいいいいいいい  \r\n  ううううううううううううううううううううううううううううううううううううううううううううううう  \r\n  えええええええええええええ\r\n',2,1429316238,1486511177),(9,2,11,1,NULL,NULL,'public',1486552620,'起承転結の起','## ああああああああああああ\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n\r\n\r\nあああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ\r\n',2,1429316551,1486517526),(10,12,15,1,NULL,NULL,'public',1429316520,'起承転結の承','ああああああああああああ',2,1429316574,1431423741),(12,16,17,1,NULL,NULL,'close',1429316700,'起承転結の転','',2,1429316716,1429316731),(13,18,19,1,NULL,NULL,'public',1429316760,'起承転結の結','あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ あああああああああああああああああ ',2,1429316759,1429316789),(14,3,8,1,NULL,NULL,'public',0,'ああああああああああ','あああああああああああ\r\nあああああああ\r\nあああああああ\r\nあああああああああああああああああ\r\nああああああああ',2,1429401994,1429402018),(15,13,14,1,NULL,NULL,'public',0,'いいい','いいいいいいいいいいいいいいい\r\nいいいいい',2,1429402037,1429402044),(16,4,5,1,NULL,NULL,'public',1429402080,'うううううううう','ううううううう\r\nうう\r\nうううううううううううううううううううううううううううううううううううううううううううううううう',2,1429402089,1429402092),(17,6,7,1,NULL,NULL,'public',1429402080,'ええええええええええ','ええええええええええええええええええええええ\r\nえええええええええええ\r\nええええええええええええええええ',2,1429402109,1429402109),(18,9,10,1,NULL,NULL,'public',1430441520,'たたたたたたたたたたたた','たたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたたた\r\nたたたたたたたたたたたた',2,1430441566,1430441872),(19,1,74,3,65,4,'public',1431243540,'ACCON','![Accon](https://lh3.googleusercontent.com/ejIuVtUVzl9rWVP2BPDr3-1pgNPqJp9RdqvwfFzFIg=w1929-h768-no \"Accon\")\r\n\r\n# ACCONのマニュアル\r\n\r\n## アクセス制御機能をはじめ、Webアプリケーションに必要な機能をオール・イン・ワン化された開発・実行基盤です。当マニュアルは、そのACCONの概要・利用方法・およびアプリケーションの開発方法を説明します。\r\n',2,1431243720,1486513446),(20,2,45,3,NULL,NULL,'public',1431243720,'概要','## ACCONは、アクセス制御が必要なWebアプリケーションを「適切なQCD」(*1)で実現することを目的に構築されたWebアプリケーションの開発・実行基盤です。\r\n\r\n### 1.ACCONの構成要素\r\n\r\n#### ACCONはWebアプリケーションの開発に掛かる不要なコストや手間を削減することを目的に大きく二つの要素で構成されています。\r\n\r\n * プラットフォーム層：仮想マシンとしてWebアプリケーションの開発・実行に必要なプロダクトがすぐ稼働できる状態で提供します。（環境構築に掛かる時間は5分）\r\n * Webアプリケーション層：WebアプリケーションのフレームワークであるACCON（Powerd by FuelPHP）と、その実装サンプル。（要件がフィットすれば従来の開発に掛かる工数を90%以上カット可能）\r\n\r\n### 2.Webアプリケーションの構築\r\n\r\n#### ACCONを利用してWebアプリケーションを作成すると、そのサービスの機能要件に特化して作成することができ、可視性/保守性/妥当性確認容易性がともに高いシステムが構築効能です。（非機能要件はACCON側で吸収）\r\n\r\n### 3.ACCONの拡張\r\n\r\n#### モジュール（メニュー管理、ブログ管理、ツリー構造のコンテンツ管理、お問い合せ、FAQ、電子商取引など）を組み込むことで、Webアプリケーションを拡張することができます。モジュールは、ACCONを利用して構築されており、導入することで有機的にWebアプリケーションが機能します。（モジュールは順次リリースを予定）\r\n\r\n * * *\r\n### *1「適切なQCD」とは\r\n\r\n * 高い品質(High-Quality)：  \r\n  個々のサービスの土台となる機能は共通化されたものを使用するため、指数的に広がるシステムが内包する問題を極小化されます。また、作るべきサービスをソースコードに置き換えた場合、そのコードには非機能が隠蔽されているため可視性が高いものとなります。  \r\n\r\n * 短納期(Quick-Delivery)：  \r\n  作るべきサービスの実現にのみ注力して開発が可能になるめ不要な作業をカットできます。  \r\n\r\n * 最適な価格(Best-Cost)：  \r\n  価格 ＝ 品質(High-Quality) × 納期(Quick-Delivery) − 非機能要件構築費\r\n',9,1431243880,1437080019),(21,46,61,3,NULL,NULL,'public',1431243840,'インストール方法','Acconのインストール方法を説明\r\n\r\n## インストール要件\r\n\r\n* PHP : 5.5\r\n* MySQL : 5.5\r\n* Webサーバー： Apache or Nginx\r\n',2,1431243910,1431299432),(22,1,2,4,66,4,'public',1431244560,'Menus','メニュー管理アプリケーション「Menus」のマニュアル',2,1431244613,1431244613),(23,1,2,5,67,4,'public',1431244620,'Tree books','ツリー構造のコンテンツを管理するアプリケーション「Books」のマニュアル',2,1431244691,1486507852),(24,1,2,6,70,4,'public',1431244680,'Download','ダウンロードサービスを管理するアプリケーション「Download」のマニュアル',2,1431244738,1486520623),(25,52,53,3,NULL,NULL,'public',1436872500,'FuelPHPのインストール','要所々々でsudoコマンドを使用しています。sudoの設定、および初回のログインユーザのパスワードの入力が必要です。\r\n\r\n## FuelPHPのインストール準備\r\n\r\n1.インストール先のデイレクトリを作成\r\n\r\n  例：「/develop/sample」  ディレクトリに導入 （インストール対象のマシンで下のコマンドを実行）  \r\n\r\nインストール先の環境に合わせて変更してください。（既存のディレクトリにインストールする場合、そのディレクトリが書き込みできる状態に変更し、そのディレクトリに移動してください）\r\n\r\n* install_dir：インストール先のディレクトリ\r\n\r\n* permissions_group：インストール先ディレクトリのパーミッション（グループ）\r\n\r\n* permissions_user：インストール先ディレクトリのパーミッション（ユーザ）\r\n\r\n### 実行コマンド（コピペで実行）\r\n\r\n```sh\r\n# ★環境に合わせて値を変更\r\ninstall_dir=/develop/sample\r\npermissions_group=develop\r\npermissions_user=develop\r\n# ディレクトリの作成\r\nif [ ! -d $install_dir ]; then\r\n    sudo mkdir -p $install_dir\r\n    sudo chown $permissions_group:$permissions_user $install_dir\r\n    sudo chmod g+w $install_dir\r\nfi\r\ncd $install_dir\r\n```\r\n\r\n## FuelPHPのインストール\r\n\r\n### FuelPHPクイックインストール\r\n\r\nFuelPHPのインストールの詳細、および手動のインストール方法は [公式サイト](http://fuelphp.jp/docs/1.7/installation/instructions.html)を参照してください。\r\n\r\n#### 実行コマンド（コピペで実行）\r\n\r\n```sh\r\n# ★環境に合わせて値を変更\r\ninstall_dir=/develop/sample\r\n# クイックインストール\r\ncd $install_dir\r\ncurl get.fuelphp.com/oil | sh\r\n```\r\n\r\n### FuelPHPプロジェクトの作成\r\n\r\nFuelPHPのプロジェクトを作成します。プロジェクト名を任意の名前に設定して実行してください。\r\n\r\n#### 実行コマンド（コピペで実行）\r\n\r\n```sh\r\n# ★環境に合わせて値を変更\r\ninstall_dir=/develop/sample\r\nproject=test\r\n# プロジェクトの作成\r\ncd $install_dir\r\noil create $project\r\n```\r\n\r\n### ブラウザからFuelPHPプロジェクトへのアクセス\r\n\r\n#### WEBサーバーのドキュメントルートにFuelPHPプロジェクトのpublicディレクトリのシンボリックリンクを作成\r\n\r\n##### 実行コマンド（コピペで実行）\r\n\r\n```sh\r\n# ★環境に合わせて値を変更\r\ninstall_dir=/develop/sample\r\nproject=test\r\ndocument_root=/var/www/html\r\n# シンボリックリンクの作成\r\ncd $document_root\r\nln -s $install_dir\'/\'$project\'/public\' $project\r\n```\r\n\r\n#### ブラウザからアクセス\r\n\r\n「http://[ドメイン]/[プロジェクト名]/」にブラウザからアクセス。（例：http://localhost/test/）  \r\n 下の画面が表示されれば、正常にインストールが完了しています。\r\n\r\n![プロジェクトのURLにアクセス](http://kurobuta.jp/images/201505/localhost_2015-05-10_19-55-41.png \"ブラウザ\")  ',9,1431290173,1436840756),(26,54,55,3,NULL,NULL,'public',1436872500,'Acconのインストール','## Acconのダウンロードと設置\r\n\r\n### Acconのダウンロード\r\n\r\n[ダウンロードページ](https://kurobuta.jp/download/view/6)にアクセスしてファイルを取得\r\n\r\n### 設置\r\n\r\nダウンロードしたファイルをFuelPHPに設置（「fuel/app/modules」ディレクトリ）\r\n\r\n### 実行コマンド（コピペで実行）\r\n\r\n```sh\r\n# ★環境に合わせて値を変更\r\ninstall_dir=/develop/sample\r\nproject=test\r\npermissions_group=develop\r\npermissions_user=develop\r\ndownload_dir=~/Downloads/\r\n# ダウンロードファイルの展開\r\ncd $download_dir\r\nsudo unzip accon_*.zip\r\n# ファイルの設置\r\nsudo mv -f accon  $install_dir\'/\'$project\'/fuel/app/modules/\'\r\nsudo chown -R $permissions_group:$permissions_user $install_dir\'/\'$project\'/fuel/app/modules/\'\r\n```',9,1431292656,1436840757),(27,3,4,3,NULL,NULL,'public',1431260700,'コンセプト','## Frameworkのコンセプトは【No. So standard.（無いよ。それ、標準）】(*1) 。Core層（FuelPHP）とApplication層の間に『Foundation』と言う名前の層を設け、Webアプリケーションが必要な機能を必要な時にFoundationが提供します。（アプリケーション側で定義されていない内容を要求された場合、標準の機能がその振る舞いを肩代わりします。もちろんアプリケーション側で拡張も可能）\r\n\r\n#### 代表的な機能として\r\n\r\n * 「アクセス制御」\r\n * 「CRUDモデルサポート」\r\n * 「NESTEDモデルサポート」\r\nの３つがあり、それらを支えるための仕組み（画面部品、セキュリティ機能、キャッシュ機能）が色々存在します。\r\n\r\n#### ACCON上で動作するWebアプリケーションの部品を順次リリースしていきます。現在公開されているものは、\r\n\r\n * メニュー管理機能 ⇒ Menusモジュール\r\n * 木構造のコンテンツを管理・公開（Markdown形式）⇒ Booksモジュール\r\n * ファイルの配布管理 ⇒ Downloadモジュール\r\n\r\nの３つがあります。（新しいモジュールを順次公開していく予定です）\r\n\r\n* * *\r\n\r\n*1\r\n\r\n * フレームワークを利用してアプリケーションを作成する場合、生成のツール等を利用して、アプリケーションを生成するケースがあります。この場合、ファイルが大量に作成され維持コストに悪影響をあたえます。（生成されるコードは、その時点の生成ツールに依存してしまい基礎をバージョンアップした場合、ツールを改善し再生性、そして過去のソースとマージ作業。もしくは過去の人の手で過去に生成されたソースをメンテナンスする必要がありました）（標準的な機能しか使用していなく、ファイル名は違うが中身は粗同じ様なファイル数が複数存在し管理する手間としても悪影響）\r\n * 『No. So standard.』の原則では、実行時に機能や画面・画面部品が存在しない場合、それは標準の機能を使用して動作するものと判断し、『Foundation』層に予め標準機能として定義されているものを使用して機能します。（例えば、画面のレイアウトは標準で良いがヘッダーは替えたい場合、アプリケーションのディレクトリにヘッダーのレイアウトファイルのみ設置する。また、新規作成・変更・削除の処理が標準的な処理であれば実装不要など）アプリケーションの基盤が進化しても、実際のソースコードへの影響を最小限（もしくは無し）で食い止めることが可能です。\r\n\r\n* QualityとCostの観点で必要なものは自動生成の対象外としています。',9,1431379640,1437080176),(28,18,25,3,NULL,NULL,'public',1437131700,'アクセス制御とは','## アクセス制御の定義\r\n\r\n[引用：Wikipedia](http://ja.wikipedia.org/wiki/%E3%82%A2%E3%82%AF%E3%82%BB%E3%82%B9%E5%88%B6%E5%BE%A1 \"wikipedia\")\r\n \r\n> コンピュータセキュリティによるアクセス制御は、認証 (authentication)、認可 (authorization)、監査 (audit) からなる。それらは、物理的機器による手段としてバイオメトリクス、金属錠、デジタル署名、暗号化、社会的障壁、人間や自動化システムによる監視などを含む。認可は、ロールベースアクセス制御、アクセス制御リスト、XACMLのようなポリシー言語などで実装される。\r\n> アクセス制御システムは、基本サービスとして、識別と認証 (identification & authentication、I&A)、認可 (authorization)、説明可能性 (accountability) を提供する。識別と認証はシステムにログインできる者を決定し、認可は認証された者ができることを決定し、説明可能性はそのユーザーが何をしたかを特定する。',9,1431380559,1437080530),(29,19,20,3,NULL,NULL,'public',1431261840,'アクセス制御の実現','## 提供する機能\r\n\r\n* 認証 (authentication)：［ログイン/ログアウト/ユーザ作成/ユーザ情報変更/管理］機能を提供\r\n* 認可 (authorization)：機能とアクション単位に許可の設定が可能。許可の設定は、［ロール/ユーザ/グループ］を基本として設定出来る他、ユーザが所属するロール、グループが所属するロールなど柔軟に設定が可能でありいかなるニーズにも対応します（全権限の付与、権限の剥奪も簡単に設定が可能）。また、アクセス制御は、通常のWebアプリケーション以外にAjaxもサポートしています。\r\n* 監査 (audit)：操作した記録として、オペレーション用ログが出力され、内容は、［いつ・だれが・どこから・何を行った］が自動で記録されます。\r\n\r\nこれらのアクセス制御の基本となる3機能は、『Foundation』に組込済みであり、アプリケーション側で実装は不要です。\r\nまた、これらの動作を管理するための管理画面も提供されます。※アクセス制御に必要な情報はメモリー上でキャッシされており非常に高速に稼働します。\r\n',9,1431380627,1437080722),(30,56,57,3,NULL,NULL,'public',1436872500,'設定','（準備中）\r\n\r\n## 設定\r\n\r\n## 初期データの投入',9,1431385370,1436841046),(31,27,30,3,NULL,NULL,'public',1434021300,'主な機能','（準備中）',2,1431385440,1434013103),(32,28,29,3,NULL,NULL,'public',1436872500,'機能一覧','（準備中）',9,1431385466,1436840944),(33,5,26,3,NULL,NULL,'public',1431266760,'概念','# ACCONの基本的な構造や機能の概念を説明\r\n\r\nシステムの構成、静的構造（ACCONのクラス構造）、アクセス制御について説明します。',9,1431385497,1437080411),(34,9,12,3,NULL,NULL,'public',1436526900,'ACCON クラス図','## ACCONのクラス図です。\r\n\r\n![クラス図](https://lh3.googleusercontent.com/o_XW3fwGxMhFZXTtZ-gmcCdfpZRJXz-uhD9QyB5WVg=w2514-h1778-no \"クラス図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipMgqrArK-LVCUTvKI3iBqffuIdSTQwDEbDj9kwWWJfHPS4lCXnLz9AD-E7G34qe_Q/photo/AF1QipOl4RH4ueeFFgNYyw1tOzdrOs2Pltqrb3Ej3L9F?key=T01qbzltMm5lbkJWUmhJRzQ5dXlzOHc3MVd0S19n \"ACCON Class図\")\r\n\r\n※コア（FuelPHP）層とアプリケーション層を除く\r\n',2,1431385514,1486269058),(35,23,24,3,NULL,NULL,'public',1437131700,'ER図','![論理ER図](https://lh3.googleusercontent.com/welCAv71QG-hyhygtvwTuQhSniurL7Lj-Wsym7YqJ5g=w2444-h1730-no \"論理ER図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipPLA6xYhb8Hyg4MDJ41M6hW63vhxjUc5tZC1lJchwSwATk9noD0xYb0iLYuUl36zw/photo/AF1QipORGgzr97GO8c1h2JnN3-VByhkeW2hUCaOsgpq1?key=N002OTQ5RnlHc1NGNldUWFFiX2RXcjd4VmpKdWpn \"論理ER図\")\r\n',9,1431385529,1437080596),(37,59,60,3,NULL,NULL,'public',1436872500,'動作確認（サンプルアプリケーション）','（準備中）',9,1431385609,1436840782),(38,62,69,3,NULL,NULL,'public',1431266880,'アプリケーションの実装方法','（準備中）',9,1431385659,1436840998),(39,63,64,3,NULL,NULL,'public',1431266940,'モデル','（準備中）',2,1431385691,1431385691),(40,65,66,3,NULL,NULL,'public',1431266940,'コントローラー','（準備中）',2,1431385707,1431385707),(41,67,68,3,NULL,NULL,'public',1431266940,'モデル','（準備中）',2,1431385720,1431385720),(43,21,22,3,NULL,NULL,'public',1437131700,'概念モデル','![アクセス制御概念モデル](https://lh3.googleusercontent.com/rwjxO70YGMBlCU4Z0K-jihUGMT6xO3m4h1b-9IKlrig=w2444-h1730-no \"アクセス制御概念モデル\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipMSjyqB0_NSFcjJxxYk5LyCSCXC_n8fJ2EOfhqTHTwc1c5NTV1H7wMP0u80TqWlTA/photo/AF1QipPIeINXRbg1vZ5oKOMT8NGVgVdNb-qVc4qDPKJj?key=WHYzQS05ZVBGbFdRMkZILUhWdEhrRjJJUGpjWkpB \"アクセス制御概念モデル\")\r\n',9,1433975067,1437080593),(45,8,17,3,NULL,NULL,'public',1436526900,'クラス図','# ACCONの静的構造\r\n\r\nACCON、FuelPHPとの関連、アプリケーションとの関連をクラス図で示します。',9,1436477974,1436478000),(46,13,14,3,NULL,NULL,'public',1436478060,'FuelPHPの拡張ポイント','## FuelPHPとACCONの関連\r\n\r\n![クラス図](https://lh3.googleusercontent.com/-am8LYrAdnd5XS0UgsKeK_2xzH3CMMUBi0yWphbvqQ=w2346-h1660-no \"クラス図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipOclhzl3JLsmGphqQBPgueQmbE3MM6_CwxXzmZXyZ1F2ApYSY_hPsrS2KGHdxe3rA/photo/AF1QipNhWdVUyyhHBuLMlzo17P2u-m6V-kNVifj6Jw2g?key=Q2J6VHNoNkxNaDZHUlRmQVByYV9YUXQxbVY2S1hn \"ACCON Class図\")\r\n\r\n※アプリケーション層を除く\r\n',9,1436478244,1436527871),(47,6,7,3,NULL,NULL,'public',1437131700,'システム構成','![システム構成図](https://lh3.googleusercontent.com/cZgHYr6smJLGodWm_Iw2akgQbhHhSj3uioBcAL3S3aM=w566-h400-no \"システム構成図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipOCZF2S__FVwOT2AxgX89vbCqGN9xngPBpQc8NRAfgJaaYplVi84T1Ok0F_X3i4gQ/photo/AF1QipNDKt1koHKTkx7ohKxcddNvZhW7MiVHBQdcGlfv?key=bHdVVjA3bVltUHVnUFUxVElKTkUwb3dOdE1HT25n \"システム構成図\")\r\n\r\n* [accon/fuelphp-accon](https://registry.hub.docker.com/u/accon/fuelphp-accon/)  \r\n  Webアプリケーション開発・実行環境\r\n\r\n* [ACCON](https://kurobuta.jp/books/book/manual/accon/)  \r\n  Webアプリケーション開発・実行基盤\r\n\r\n* Blog  \r\n  ACCONを利用したサンプル（ブログの管理機能と公開機能）\r\n\r\n* Service module  \r\n  ACCON上で動作するWebアプリケーションサービス\r\n\r\n* [accon/ubuntu-nginx-phpfpm-redis-mysql](https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/)  \r\n  Webアプリケーション開発サーバー\r\n',9,1436741669,1437080333),(48,48,49,3,NULL,NULL,'public',1436872500,'FuelPHP+ACCON：フル・インストール方法','## 1.KITEMATICのインストール\r\n### 1.1.KITEMATICのダウンロード\r\n  ※すでにDockerを導入済みの場合「2.FuelPHP+ACCONのインストール  」へおすすみください  \r\n  DockerのGUIであるKITEMATICをダウンロード\r\n[https://kitematic.com/](https://kitematic.com/)にアクセスしてKITEMATICをダウンロード  \r\n![KITEMATIC](https://lh3.googleusercontent.com/zSb-hoGhnZys67lMFO6K-bOayXXVDtGxdqGN0dQA1yg=w525-h400-no)  \r\n\r\n### 1.2.KITEMATICのインストール\r\nダウンロードしたファイルの実行  （Dockerを利用するために必要なソフトウェアが自動でインストールされます）  \r\n  ![KITEMATIC](https://lh3.googleusercontent.com/KWaC-HdrL64XQmdVhlj7ProMPqeyLrv87Svh4QHJrRA=w800-h571-no)    \r\n\r\nDocker Hubのログインをスキップ（後ほどいつでもログインできます）  \r\n  ![KITEMATIC](https://lh3.googleusercontent.com/xg_0PODzbpAiTXaSmNN7Ni_hG0lQVx-8uh5Y6-npVvI=w794-h597-no)    \r\n\r\n  KITEMATICのインストールが完了  \r\n\r\n## 2.FuelPHP+ACCONのインストール  \r\n  FuelPHP+ACCONの内容はこちらをご参照ください→[システム構成図](https://kurobuta.jp/books/book/manual/accon//?id=47)  \r\n\r\n### 2.1.FuelPHP+ACCONのコンテナイメージ（仮想マシン）の取得\r\n  「DOCKER CLI」をクリックしコンソールを開きます\r\n  ![DOCKER CLI](https://lh3.googleusercontent.com/prjVJp2yghUMXPNOaQgj5woosh0FsJMAarz-t9jQ76A=w798-h596-no)    \r\n\r\n  次のコマンドを入力して「FuelPHP+ACCONのコンテナイメージ」を取得・・・（Windos/Mac）\r\n\r\n``` bash\r\ndocker pull accon/fuelphp-accon\r\n```\r\n\r\n  ![DOCKER pull](https://lh3.googleusercontent.com/BDmByQTbvJRBxHMbPuDDbTvbUYItNZQD2f-n-nqrJ-o=w855-h537-no)    \r\n\r\n```bash\r\nStatus: Downloaded newer image for accon/fuelphp-accon:latest  \r\n```\r\n実行後、このメッセージが表示された場合、正しく取得できています\r\n\r\n### 2.2.仮想サーバーとの共有ディレクトリを作成  \r\n  「FuelPHP+ACCONのコンテナイメージ」を起動すると実行される開発サーバーとファイルを共有するため２つのディレクトリを作成  \r\n\r\n * ~/develop/data-volume/workspace：FuelPHPのプロジェクトが設置されます\r\n * ~/develop/data-volume/data：MySQLのデータベースとテーブル、初期データ作成用のスクリプトが設置されます\r\n\r\n  初期状態は空ですが、初回実行時にこれからの開発で使用するファイルたちが自動設置されます\r\n\r\n* Windowsの場合\r\n\r\n```bash\r\nmkdir ~/develop/data-volume/workspace\r\nmkdir ~/develop/data-volume/data\r\n```\r\n\r\n* Macの場合\r\n\r\n```bash\r\nmkdir -p ~/develop/data-volume/workspace\r\nmkdir -p ~/develop/data-volume/data\r\n```\r\n\r\n  ![Mkdir](https://lh3.googleusercontent.com/ytnmMY8brUB1xH9T8kh43NhrsP8QxYFNnKqNPss4dXE=w861-h546-no)    \r\n\r\n### 2.1.FuelPHP+ACCONのコンテナ（開発サーバー）の起動\r\n  下のコマンドを実行しコンテナ（開発サーバー）を起動します\r\n\r\n* Windowsの場合\r\n\r\n```bash\r\ndocker run -d -v /c/Users/[ユーザID]/develop/data-volume/data:/develop/data:rw -v /c/Users/[ユーザID]/develop/data-volume/workspace:/develop/workspace:rw -p 80:80 -p 443:443 -p 3306:3306 -t -i -h project-server-01 --name project-server-01 accon/fuelphp-accon\r\n```\r\n\r\n  ※[ユーザID]は適宜変更してください\r\n\r\n* Macの場合\r\n\r\n```bash\r\ndocker run -d \\\r\n -v ~/develop/data-volume/data:/develop/data:rw \\\r\n -v ~/develop/data-volume/workspace:/develop/workspace:rw \\\r\n -p 80:80 \\\r\n -p 443:443 \\\r\n -p 3306:3306 \\\r\n -t -i \\\r\n -h project-server-01 \\\r\n --name project-server-01 \\\r\n accon/fuelphp-accon\r\n```\r\n\r\n起動できた場合、コンテナのIDが表示されます\r\n  ![docker run](https://lh3.googleusercontent.com/FZ1rvhR7g3A8XYZmrvF13BU_E0QlWt3GGbk5ZZUcb8E=w856-h542-no)    \r\n\r\n### 2.2.FuelPHP+ACCONのコンテナイメージ（仮想マシン）の起動確認\r\n\r\n#### 2.2.1.KITEMATICを表示してコンテナが起動していることを確認します\r\n  正常に起動できていた場合、「project-server-01」と言うサーバー名の左に緑色の起動中マークが付きます\r\n  サーバー名を開き、状態を開きます\r\n  ![docker run](https://lh3.googleusercontent.com/NolvGYoEvQ8kwVci5hwR2IyEcxq5v1eESFjdxF3gpQ8=w800-h596-no)    \r\n\r\n#### 2.2.2.コンテナのWebプレビューをクリックしブラウザで開発サーバーにアクセスします  \r\n  ※TCPの次のポートを開く必要があります ファイアーウォールの設定を行ってください 80(HTTP)、443(HTTPS)、3306(Mysql)、9001(Xdebug)\r\n  ![docker run](https://lh3.googleusercontent.com/qlmFRdBU-53fv0SrXG7ywRRWrXMG-WDm9gr8kQ8-Pdk=w798-h597-no)    \r\n  ※HTTPSは事故証明書を使用しているためブラウザに警告が表示されますが開発には問題ありません 許可をお願いします\r\n\r\n  下のようにブラウザにアプリケーション画面が表示されると正常に起動しています\r\n  ![docker run](https://lh3.googleusercontent.com/qzg8Svjx1Fmq1PQTJhfQspEI6-0PIXXYFfUoHRG9rNw=w1608-h1078-no)    \r\n\r\n#### 各種ミドルウェア（WWWサーバーやデータベースサーバー）が起動しており、サンプルアプリケーションが動作している状態です  \r\nデータベース（MySQL）に初期データが投入された状態で起動しています\r\n\r\n* サンプル・アプリケーションのトップページに書かれているユーザID、パスワードでログイン可能です\r\n* 権限があるユーザでログインを行うと、上部に［管理］メニューが出現します（アクセス制御の管理画面など操作可能です）',9,1436824219,1436912440),(49,47,50,3,NULL,NULL,'public',1436872500,'クイックスタート','まっさらなな状態から、5分～10分程度でマシンにACCONの開発サーバーを導入する方法を説明します。  \r\n導入後は、各ミドルウェアが起動された状態で開発サーバーが利用可能で、その場からWebアプリケーションの開発が可能です。',9,1436840712,1436857363),(50,51,58,3,NULL,NULL,'public',1436872500,'個別インストール','ACCONシリーズを個別に導入する方法を説明します。',9,1436840748,1436857399),(51,70,73,3,NULL,NULL,'public',1436828400,'デプロイ方法','（準備中）',9,1436840805,1436841061),(52,71,72,3,NULL,NULL,'public',1436828400,'AWSにデプロイ','（準備中）',9,1436840820,1436841071),(53,15,16,3,NULL,NULL,'public',1436828400,'アプリケーション層について','（準備中）',9,1436840978,1436841017),(54,31,44,3,NULL,NULL,'public',1437299580,'利用方法','## ACCONを使用した開発方法について\r\n\r\nACCONに同封されているACCONを使用した実装サンプルのブログ管理・フロント機能を使い、利用方法の概要を説明します。',9,1437299777,0),(55,33,34,3,NULL,NULL,'public',1437390900,'ブログ管理機能の画面遷移図','## ACCONを使用して実装されたブログ管理機能の画面遷移図です。\r\n\r\n![ブログ管理機能の画面遷移図](https://lh3.googleusercontent.com/7QtOSMLhGjY__x5MejtbMHFuVsaIKs_SB3ndEiVAhus=w1394-h1978-no \"ブログ管理機能の画面遷移図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipPlhrzWO4ciUpXv8ywcQBUFzt37BVelsIO5NXHm49m0PTzD8QXB_tuF_VfDQD4nNA/photo/AF1QipNNfMi0udKLnxBnkgBymmfdGYaEebz9QV2rXPUY?key=UmdfRlk1ZmRSUFNKOEVZWWJiZGJjVDNNS0FKSTVR \"ブログ管理機能の画面遷移図\")',9,1437299873,1437693157),(56,32,43,3,NULL,NULL,'public',1437385680,'実装サンプル','ACCONの利用方法を同封されている実装サンプルのブログ機能を使用して説明いたします。',9,1437385685,1437385885),(57,35,36,3,NULL,NULL,'public',1437385740,'ブログ公開（フロント）機能の画面遷移図','## ACCONを使用して実装されたブログ公開（フロント）機能の画面遷移図です。\r\n\r\n![ブログ公開機能の画面遷移図](https://lh3.googleusercontent.com/efPt8TKzP2UIlZTBhxhBfcJ75Clwj85-irSfjOHHVt4=w1366-h1930-no \"ブログ公開機能の画面遷移図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipO6kUq8Qq7_gcFbm_kZ3d7SgZQC_2RdaNbY3LAcQ7tUd6Gp0uEfKRDpFeDnUKYoVA/photo/AF1QipNdwM7cGRE2cmeCVTDcNaBRDvUIuInltEcPOR39?key=Z0lfMkpGSFdHSTJwblAtS2MyQ2pmMVhiZkE0d2dn \"ブログ公開機能の画面遷移図\")',9,1437385823,1437431196),(58,37,38,3,NULL,NULL,'public',1437434520,'Blog機能のデータ構造','## Blog機能のデータ構造です。\r\n\r\n### ER図\r\n\r\n![ER図](https://lh3.googleusercontent.com/cX1aHATKX1kUaEc4ctwJ5oGVPfveDSn9cmAY8M25NJA=w2730-h1930-no \"ER図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipPtsUA4siCPP1FRfUacNsKPkkeQFoaG4An1BLMiwjJn9uWvvYRJ0f35J2hdE4KpuA/photo/AF1QipPzhNPgaOPuQph0g4fWQ1jgcwtz2Bzqd5R-1Pgi?key=RnZXMklxdFg5SjlJMkRzeUFPYl9pREJwOEpJR013 \"ER図\")\r\n\r\n### SQL\r\n\r\n#### slugテーブル\r\n\r\n```sql\r\nCREATE TABLE `slug` (\r\n  `id` int(11) NOT NULL AUTO_INCREMENT,\r\n  `name` varchar(255) NOT NULL,\r\n  `user_id` int(11) NOT NULL DEFAULT \'0\',\r\n  `created_at` int(11) NOT NULL DEFAULT \'0\',\r\n  `updated_at` int(11) NOT NULL DEFAULT \'0\',\r\n  PRIMARY KEY (`id`),\r\n  UNIQUE KEY `UNIQUE` (`name`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8\r\n```\r\n\r\n#### postsテーブル\r\n\r\n```sql\r\nCREATE TABLE `posts` (\r\n  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,\r\n  `title` varchar(255) NOT NULL,\r\n  `slug_id` int(11) NOT NULL,\r\n  `post_status` varchar(45) DEFAULT NULL,\r\n  `public_at` int(11) DEFAULT NULL,\r\n  `summary` text NOT NULL,\r\n  `body` text NOT NULL,\r\n  `user_id` int(11) NOT NULL,\r\n  `created_at` int(11) DEFAULT NULL,\r\n  `updated_at` int(11) DEFAULT NULL,\r\n  PRIMARY KEY (`id`)\r\n) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8\r\n```',9,1437434530,1437804838),(59,39,42,3,NULL,NULL,'public',1437693240,'画面とソースコードの関係','## 画面と実装例を示します\r\n\r\n[ブログ管理機能・画面遷移図](https://kurobuta.jp/books/book/manual/accon/?id=55 \"画面とソースコードの関係\")で登場したブログの投稿種類を管理するSlug機能（投稿種類のマスターメンテナンス機能）の実装内容です。\r\n機能は、投稿種類マスターの検索、一覧、詳細、追加、変更、削除、各バリデーション。\r\n他に、アクセス制御（上の機能単位に実行権限の設定が可能）、画面遷移、パジネーション（ページング）、検索履歴、セキュリティ、操作履歴などは実装不要。（フレームワーク側が機能提供）\r\nコントローラーはモデルの宣言のみでＯＫ。\r\n\r\n![画面とソースコードの関係](https://lh3.googleusercontent.com/nknejckpcFCYAEsrCoOoLu7Oi7caX-oQTpaby-UMGqo=w984-h1978-no \"画面とソースコードの関係\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipNf8-scArZe8QFYD2FMJBz6-tjIy7ztq1bGu_GJT5x88zrqbApesE6hes_WrlxeUQ/photo/AF1QipPCyBVY2eNKsNR8vKC9S3o5xzVNVG0IXur4aPaJ?key=enZIT2dmSDBka2R3U3k2Q3RxbkxaWWlVclk3QnVn \"画面とソースコードの関係\")\r\n',9,1437693297,1437805644),(60,40,41,3,NULL,NULL,'public',1437802020,'Slug機能のソースコード','### Controller\r\n\r\n#### app/classes/controller/blog/slug.php\r\n\r\n```php\r\n<?php\r\n\r\n/**\r\n * Class Controller_Blog_slug\r\n */\r\nclass Controller_Blog_Slug extends \\Accon\\Foundation\\Controller_Physical_Crud\r\n{\r\n	// サービスの説明\r\n	const SERVICE_TITLE = \'Slug\';\r\n	// モデルクラス\r\n	const MODEL = Model\\Slug::class;\r\n\r\n}\r\n```\r\n\r\n### Model\r\n\r\n#### app/classes/model/slug.php\r\n\r\n```php\r\n<?php\r\n\r\nnamespace Model;\r\n\r\n/**\r\n * Class User\r\n * @package Model\\Service\\Admin\r\n */\r\nclass Slug extends \\Accon\\Foundation\\Model_Crud\r\n{\r\n	/**\r\n	 * table name to overwrite assumption\r\n	 *\r\n	 * @var  string\r\n	 */\r\n	protected static $_table_name = \'slug\';\r\n\r\n	/**\r\n	 * belongs to relationships\r\n	 *\r\n	 * @var array\r\n	 */\r\n	protected static $_belongs_to = array(\r\n		\'user\' => array(\r\n			\'model_to\' => \'Accon\\Model\\User\',\r\n			\'key_from\' => \'user_id\',\r\n			\'key_to\' => \'id\',\r\n			\'cascade_save\' => false,\r\n			\'cascade_delete\' => false,\r\n		),\r\n	);\r\n\r\n	/**\r\n	 * validate\r\n	 *\r\n	 * @param $factory\r\n	 * @return \\Fuel\\Core\\Validation\r\n	 */\r\n	public static function validate($factory)\r\n	{\r\n		$val = \\Validation::forge($factory);\r\n		$val->add_field(\'name\', \'Name\', \'required|max_length[255]\');\r\n		return $val;\r\n	}\r\n\r\n	/**\r\n	 * 前処理 追加\r\n	 */\r\n	protected function _before_insert()\r\n	{\r\n		// assign the user id that lasted updated this record\r\n		$this->user_id = ($this->user_id = \\Auth::get_user_id()) ? $this->user_id[1] : 0;\r\n	}\r\n\r\n	/**\r\n	 * 前処理 更新\r\n	 */\r\n	protected function _before_update()\r\n	{\r\n		$this->_before_insert();\r\n	}\r\n\r\n}\r\n```\r\n\r\n### View\r\n\r\n#### app/views/blog/slug/_form.php\r\n\r\n```php\r\n<fieldset>\r\n	<div class=\"form-group <?php echo !$val->error(\'name\') ?: \'has-error\' ?>\">\r\n		<?php echo Form::label(\'名前\', \'name\', array(\'class\' => \'control-label\')); ?>\r\n		<?php echo Form::input(\'name\', Input::post(\'name\', isset($model) ? $model->name : \'\'),\r\n			array(\'class\' => \'col-md-4 form-control\', \'placeholder\' => \'name\',\r\n				$this->data[ACTION_EDIT] ? \'\' : \'disabled\')); ?>\r\n		<?php if ($val->error(\'name\')): ?>\r\n			<span class=\"control-label\"><?php echo $val->error(\'name\')->get_message(); ?></span>\r\n		<?php endif; ?>\r\n	</div>\r\n	<?php echo render(\'admin/user/_get_username\', array(ACTION_EDIT => $this->data[ACTION_EDIT])); ?>\r\n</fieldset>\r\n```\r\n\r\n#### app/views/blog/slug/index.php\r\n\r\n```php\r\n<?php echo render(FOUNDATION_VIEW_INDEX_HEADER); // 検索VIEWの標準ヘッダー ?>\r\n<div class=\"row\">\r\n	<div class=\"col-md-12\">\r\n		<?php echo Form::open(array(\"id\" => \"search-condition-form\", \"class\" => \"form-inline\")); ?>\r\n		<?php echo Form::csrf(); // CSRF 保護 ?>\r\n		<div id=\"search-condition\" class=\"row search-condition-area\">\r\n			<div class=\"col-md-8 search-condition-input-box\">\r\n				<div class=\"col-md-12\">\r\n					<?php echo render(FOUNDATION_VIEW_SEARCH_DISPLAY_COUNTS); // 表示件数制御標準部品 ?>\r\n				</div>\r\n				<div class=\"col-md-12\">\r\n					<span class=\"input-group search-condition-input search-condition-input-end\">\r\n						<span class=\"input-group-addon\">名前</span>\r\n						<?php echo Form::input(\'name\', isset($view_search[\'name\']) ? $view_search[\'name\'] : \'\', array(\'class\' => \'form-control\')); ?>\r\n					</span>\r\n				</div>\r\n			</div>\r\n			<div class=\"col-md-4\">\r\n				<?php echo render(FOUNDATION_VIEW_SEARCH_ACTION); // 検索実行標準部品 ?>\r\n			</div>\r\n		</div>\r\n		<?php echo Form::close(); ?>\r\n	</div>\r\n</div>\r\n<div class=\"row\">\r\n	<div class=\"col-md-12\">\r\n		<?php if ($model): ?>\r\n			<table class=\"table table-striped table-hover table-condensed\" id=\"data_table\">\r\n				<thead>\r\n				<tr>\r\n					<th class=\"nowrap\">名前 <span class=\"badge\">ID</span></th>\r\n					<th class=\"nowrap\">更新者</th>\r\n					<th class=\"nowrap\"> </th>\r\n				</tr>\r\n				</thead>\r\n				<tbody>\r\n				<?php foreach ($model as $item): ?>\r\n					<tr id=\"search-result\">\r\n						<td class=\"nowrap\"><?php echo $item->name.\' <span class=\"badge\">\'.$item->id.\'</span>\'; ?></td>\r\n						<td class=\"nowrap\"><?php echo $item->user->username.\' <span class=\"badge\">\'.$item->user_id.\'</span>\'; ?></td>\r\n						<td class=\"nowrap\"><?php echo render(\'Accon::\'.FOUNDATION_VIEW_MODEL_ACTIONS, array(VIEW_ACTION_KEY => $item->id)); // 検索結果モデルアクション標準部品 ?></td>\r\n					</tr>\r\n				<?php endforeach; ?>\r\n				</tbody>\r\n			</table>\r\n		<?php endif; ?>\r\n	</div>\r\n</div>\r\n<?php echo render(FOUNDATION_VIEW_INDEX_FOOTER); // 検索VIEWの標準フッター ?>\r\n<script>\r\n	/**\r\n	 * データテーブルの設定\r\n	 */\r\n	$(\'#data_table\').dataTable({\r\n		\"paging\": false, // ページング停止\r\n		\"info\": false,\r\n		\"bFilter\": false, // 検索機能停止\r\n		\"aoColumnDefs\": [{\"bSortable\": false, \"aTargets\": [2]}] // ソート除外\r\n	});\r\n</script>\r\n```',9,1437802043,1437803063),(61,10,11,3,NULL,NULL,'public',1437948420,'クラスの概要','## 1. クラス図（全体）\r\n\r\n![クラス図](https://lh3.googleusercontent.com/jVFfBJmyv3fJX66T7_iQOIZBO_zT9eHHIELiKPGzAGc=w2732-h1930-no \"クラス図\")\r\n\r\n[拡大](https://photos.google.com/share/AF1QipPv1-eH7ac7KWg3uk1PVhTN6GRyCTWgMfWTl2bW327s_n6GKRqIfpJbkea4LWeytg/photo/AF1QipPfEAduBP9uYh0V1RBZS8DQqBtqki4vNyEQpdfg?key=WXVGLUNpWXlIZ1l4c3ZwcmJOR2dUdGJia09BSEpR \"ACCON Class図\")\r\n\r\n## 2. 制御：Foundation/Controllerパッケージ\r\n\r\n![Controller](https://lh3.googleusercontent.com/vdufX-rI548MiETCz_gqe8MMo5brmvJ86LDHH0Tqy74=w2212-h1622-no \"Controller\")\r\n\r\nコントローラは、リクエストを受け取りサービスを提供するクラス。コントローラは、モデルや他のクラスを制御し、出力用にビューにすべてを渡します。  \r\nFoundation/Controllerパッケージでは、アクセス制御機能を保有し、そのリクエストの種類や処理の種別に応じて基礎となるコントローラを提供します。アプリケーション層では、そのサービスの種類によって適切なコントローラを選定し実装します。\r\n\r\n * Controller_Accon : 基板コントローラークラス。\r\n\r\n    * Controller_Physical : 物理的に存在するコントローラーの基底クラス（通常）。\r\n\r\n        * Controller_Physical_Crud : CRUD基礎の振る舞いを提供するクラス。\r\n\r\n        * Controller_Physical_Nested :  再帰的な入れ子構造モデルの振る舞いを提供するクラス。\r\n\r\n    * Controller_Kinetic : 動的に生成されるコントローラーの基底クラス。\r\n\r\n        * Controller_Kinetic_Nested : 再帰的な入れ子構造のモデルの振る舞いを提供するクラス（Front用）。\r\n\r\n* Controller_Accon_Rest : Restコントローラー。\r\n\r\n## 3. 型（モデル）：Foundation/Modelパッケージ\r\n\r\n![Model](https://lh3.googleusercontent.com/KAtV9omJW_CgDVYdMLZBk-hlVD2u6tt-o-0GiI7m2BQ=w2212-h1622-no \"Model\")\r\n\r\nモデルはビジネスロジックとデータベース処理を行います。ORM(Object Relational Mapper)を使用しており、そのマッピング対象のテーブルの特性に合わせて次の二つが存在します。アプリケーション層では、その特性に合わせてクラスを選定し実装を行います。\r\n\r\n* Model_Crud : 通常のレリーション構造のテーブルを使用するモデル。\r\n\r\n* Model_Nested : 再帰的構造のテーブルを使用するモデル。\r\n\r\n## 4. 認証（アクセス制御）：Foundation/Behavior/Authパッケージ\r\n\r\n![Auth](https://lh3.googleusercontent.com/XEKBD10CEEG7qIkcG-YxgDnnjcZacegXDgPuyF6wD8s=w2212-h1622-no \"Auth\")\r\n\r\nアクセス制御の認証を提供するクラス。下の二つのクラスが含まれており、アプリケーション層では、用途によって切り替え、拡張を行います。\r\n\r\n* Behavior_Auth_Simple : 通常のログイン、ログアウト、状態の確認を提供するクラス。\r\n\r\n* Behavior_Auth_None : スタブクラス。テスト時など、認証機能をOFFにしたい場合に使用。\r\n\r\nクラスの切り替えは設定ファイルで行います。（設定ファイル：app/config/accon.php）\r\n\r\n```php\r\n/**\r\n * 認証\r\n */\r\n\'auth\' => \'Accon\\Foundation\\Behavior_Auth_Simple\',\r\n//		\'auth\' => \'Accon\\Foundation\\Behavior_Auth_None\',\r\n```\r\n\r\n## 5. 認可（アクセス制御）：Foundation/Behavior/ACLパッケージ\r\n\r\n![Auth](https://lh3.googleusercontent.com/6vU5h65D114KX_kzhM98TEaj47mSQJp8i8rQMOMJ-q4=w2212-h1622-no \"Auth\")\r\n\r\nアクセス制御の認可を提供するクラス。ユーザマスタ、グループマスタ、ロールマスタとそのアクセス制御リストからアクション単位に許可・拒否を判断します。\r\n\r\n* Behavior_Acl_Physical : 物理的に存在するコントローラ用のアクセス制御。\r\n\r\n* Behavior_Acl_Kinetic : 物理的に存在しないコントローラ用のアクセス制御。\r\n\r\n* Behavior_Acl_Rest : Rest用のアクセス制御。\r\n\r\n* Behavior_Acl_None : アクセス制御なし（スタブ）。\r\n\r\nクラスの切り替えは設定ファイルで行います。（設定ファイル：app/config/accon.php）\r\n\r\n```php\r\n/**\r\n * 物理的に存在するコントローラー\r\n */\r\n\'physical\' => array(\r\n	/**\r\n	 * 認可\r\n	 */\r\n	\'acl\' => \'Accon\\Foundation\\Behavior_Acl_Physical\',\r\n//			\'acl\' => \'Accon\\Foundation\\Behavior_Acl_None\',\r\n```\r\n\r\n```php\r\n/**\r\n * 動的に生成されるコントローラー\r\n */\r\n\'kinetic\' => array(\r\n	/**\r\n	 * 認可\r\n	 */\r\n	\'acl\' => \'Accon\\Foundation\\Behavior_Acl_Kinetic\',\r\n//			\'acl\' => \'Accon\\Foundation\\Behavior_Acl_None\',\r\n```\r\n\r\n```php\r\n/**\r\n * レストコントローラー\r\n */\r\n\'rest\' => array(\r\n	/**\r\n	 * 認可\r\n	 */\r\n	\'acl\' => \'Accon\\Foundation\\Behavior_Acl_Rest\',\r\n//			\'acl\' => \'Accon\\Foundation\\Behavior_Acl_None\',\r\n```\r\n\r\n## 6. 画動（画面動作）：Foundation/Behavior/Viewパッケージ\r\n\r\n![View](https://lh3.googleusercontent.com/LllfDgdIAWG70w_Y8A5hmUWkHsjFptsDHu9YvOrOhW0=w2212-h1622-no \"View\")\r\n\r\n画面の動作が定義されたクラス。動作の種別毎にその標準的な振る舞いを提供します。その振る舞いは、コントローラーの種類別に設定ファイルで関連付けされており、変更・拡張時にはその設定を変更します。（設定ファイル：app/config/accon.php）\r\n\r\n```php\r\n/**\r\n * 画面生成\r\n */\r\n\'view\' => array(\r\n	\'list\'   => \'Accon\\Foundation\\Behavior_View_list_Crud\',        // 一覧\r\n	\'single\' => \'Accon\\Foundation\\Behavior_View_Single_Crud\',      // 詳細\r\n	\'update\' => \'Accon\\Foundation\\Behavior_View_Update_Crud\',      // 更新\r\n	\'insert\' => \'Accon\\Foundation\\Behavior_View_Insert_Crud\',      // 追加\r\n),\r\n```\r\n\r\n## 7. 操作：Foundation/Behavior/Operationパッケージ\r\n\r\n![Operation](https://lh3.googleusercontent.com/2TepVtt-OulDtV5QEv8MwCeBslkW1pAuVakt1GnubS4=w2212-h1622-no \"Operation\")\r\n\r\nモデルの操作が定義されたクラス。動作の種別毎にその標準的な振る舞いを提供します。その振る舞いは、コントローラーの種類別に設定ファイルで関連付けされており、変更・拡張時にはその設定を変更します。（設定ファイル：app/config/accon.php）\r\n\r\n```php\r\n\'crud\' => array(\r\n	/**\r\n	 * モデル操作\r\n	 */\r\n	\'operation\' => array(\r\n		\'insert\' => \'Accon\\Foundation\\Behavior_Operation_Insert_Crud\', // 追加\r\n		\'update\' => \'Accon\\Foundation\\Behavior_Operation_Update_Crud\', // 更新\r\n		\'remove\' => \'Accon\\Foundation\\Behavior_Operation_Remove_Crud\', // 削除\r\n	),\r\n```\r\n\r\n## 8. 他\r\n\r\n![他](https://lh3.googleusercontent.com/rHS4yMcHdTjr-gx3pvQgmNjOAYRbkBzWcGbKL6drAoU=w2212-h1622-no \"他\")\r\n\r\n* View : 画面部品を使用する際、アプリケーション層、ファンデーション層の順位で検索を行う。アプリケーション層に該当の部品が存在しない場合はファンデーション層の部品を利用する。\r\n\r\n* Log : 通常のログ以外に、操作ログとして、「いつ・だれが・どこから・なにを・どうした」を出力する。また、ログファイル以外にブラウザのコンソールにログを出力することが可能。（設定ファイル：app/config/accon.php）\r\n\r\n```php\r\n/**\r\n * オペレーションログ出力設定\r\n * 		true： 出力\r\n * 		false: 出力しない\r\n */\r\n\'operation_log\'  => true,\r\n\r\n/**\r\n * ブラウザコンソールログ出力設定\r\n * 		true： 出力\r\n * 		false: 出力しない\r\n */\r\n \'browser_console\'  => true,\r\n```\r\n\r\n## 9. 管制（アクセス制御管理機能のコントローラー）：Controllerパッケージ\r\n\r\n![Controller](https://lh3.googleusercontent.com/bUyGMyUPF4_Gc8rw_GsvRI6kchWCmqJwaZN0BW45te4=w2212-h1622-no \"Controller\")\r\n\r\nアクセス制御機能の管理画面用のコントローラ。\r\n\r\n## 10. 管型（アクセス制御管理機能のモデル）：Modelパッケージ\r\n\r\n![Model](https://lh3.googleusercontent.com/ZRS_iwaLj3TpN-r_O92gj7Sow7Zbq53NZ6qh_PDCWTg=w2212-h1622-no \"Model\")\r\n\r\nアクセス制御機能の管理画面用のモデル。\r\n\r\n',9,1437948477,1438126066);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_slug`
--

LOCK TABLES `book_slug` WRITE;
/*!40000 ALTER TABLE `book_slug` DISABLE KEYS */;
INSERT INTO `book_slug` VALUES (3,0,'Standard','標準',2,0,0),(4,1,'Manual','マニュアル',2,0,0),(5,2,'Help','ヘルプ',2,0,0),(6,10,'develop-process','開発プロセス',2,1486437418,0),(7,11,'test','test',2,1486537028,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `download`
--

LOCK TABLES `download` WRITE;
/*!40000 ALTER TABLE `download` DISABLE KEYS */;
INSERT INTO `download` VALUES (6,'ACCON','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','accon_20150724.zip','accon_20150724.zip','public',1428109200,'<h3>Version 1.0.2&nbsp;（MITライセンス）</h3>\r\n\r\n<h2><a href=\"https://kurobuta.jp/download/view/6\"><img alt=\"ACCON\" src=\"https://lh3.googleusercontent.com/ejIuVtUVzl9rWVP2BPDr3-1pgNPqJp9RdqvwfFzFIg=w1929-h768-no\" style=\"height:100%; width:100%\" /></a>アクセス制御機能をはじめ、Webアプリケーションに必要な機能をオール・イン・ワン化された開発・実行基盤</h2>\r\n\r\n<h2>概要、利用方法は<a href=\"https://kurobuta.jp/books/book/manual/accon/\" target=\"_blank\">マニュアル</a>を参照してください。</h2>\r\n\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.2 (2015/07/24) ：アクションの権限がない場合は、非活性から非表示へ変更</li>\r\n	<li>1.0.1 (2015/07/18) ：内部構造の不適切な定義を修正（インターフェース・機能の変更はありません）</li>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n',99,77,0,1428128705,1438151042),(7,'ダウンロード管理モジュール','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','download_20150718.zip','download_20150718.zip','public',1428114600,'<h3>Version 1.0.1（MITライセンス）</h3>\r\n\r\n<h2>ファイルの配布を管理するアプリケーション（<a href=\"https://kurobuta.jp/books/book/manual/accon/\">ACCON</a>が必要）</h2>\r\n\r\n<p>概要、利用方法は<a href=\"https://kurobuta.jp/books/book/manual/download/\" target=\"_blank\">マニュアル</a>を参照してください</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.1 (2015/07/18) ：SEO改善</li>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n',51,48,2,1428128869,1486417427),(13,'メニュー管理モジュール','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','menus_20150718.zip','menus_20150718.zip','public',1428111000,'<h3>Version 1.0.0（MITライセンス）</h3>\r\n\r\n<h2><a href=\"https://kurobuta.jp/books/book/manual/accon/\" target=\"_blank\">ACCON</a>のアクセス制御機能と連動して機能するメニュー管理アプリケーション</h2>\r\n\r\n<p>概要、利用方法は<a href=\"https://kurobuta.jp/books/book/manual/menus/\" target=\"_blank\">マニュアル</a>を参照してください</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>​</p>\r\n\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n',40,50,0,1430948822,1438076030),(14,'ツリー構造コンテンツ管理モジュール','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','books_20150718.zip','books_20150718.zip','public',1428112800,'<h3>Version 1.0.1（MITライセンス）</h3>\r\n\r\n<h2>ツリー構造のコンテンツを簡単に作成・公開ができるアプリケーション（<a href=\"https://kurobuta.jp/books/book/manual/accon/\" target=\"_blank\">ACCON</a>のネステッドモデル機能を利用）</h2>\r\n\r\n<p>概要、利用方法は<a href=\"https://kurobuta.jp/books/book/manual/books/\" target=\"_blank\">マニュアル</a>を参照してください</p>\r\n\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.1 (2015/07/18) ：SEO改善</li>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n',48,52,0,1430948888,1438076036),(15,'Dockerfile:accon/ubuntu-nginx-phpfpm-redis-mysql','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201506/','ubuntu-nginx-phpfpm-redis-mysql_20150630_1.zip','ubuntu-nginx-phpfpm-redis-mysql_20150630.zip','public',1435484040,'<h2>Dockerfile一式: accon/ubuntu-nginx-phpfpm-redis-mysql</h2>\r\n\r\n<ul>\r\n	<li>用途: 開発環境の基礎構成</li>\r\n	<li>構成: Ubuntu + Nginx(ssh) + PHP-FPM(Xdebug) + Redis + mysql</li>\r\n	<li>利用方法は、<a href=\"https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/\">Docker Hub</a>を参照</li>\r\n</ul>\r\n\r\n<div>ビルド方法</div>\r\n\r\n<div>\r\n<ul>\r\n	<li>\r\n	<pre>\r\n<em>docker build -t accon/ubuntu-nginx-phpfpm-redis-mysql:1.00 .</em></pre>\r\n	</li>\r\n</ul>\r\n</div>\r\n\r\n<div>\r\n<hr />\r\n<div>Part of the ACCON.</div>\r\n</div>\r\n\r\n<div>Copyright (c) 2015 Maemori Fumihiro<br />\r\nThis software is released under the MIT License.<br />\r\nhttp://opensource.org/licenses/mit-license.php</div>\r\n\r\n<div>@version&nbsp;&nbsp;&nbsp; 1.00<br />\r\n@author&nbsp;&nbsp;&nbsp;&nbsp; Maemori Fumihiro<br />\r\n@link&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; https://kurobuta.jp</div>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<div>\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n</div>\r\n',62,27,0,1435484179,1438239058),(16,'ACCON利用サンプル','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','sample_20150718.zip','sample_20150718.zip','public',1435618800,'<p>ファイルを展開後、FuelPHPのディレクトリに上書きコピーを行ってください。</p>\r\n\r\n<p>アクセス制御機能を利用する場合、httpsでアクセスする必要があります。</p>\r\n\r\n<p>※注意：FuelPHPを新規に設置することをおすすめします。既存のFuelPHP配下に導入する場合、ファイルのバックアップを必ず行ってください。</p>\r\n\r\n<p>展開ファイル</p>\r\n\r\n<ul>\r\n	<li>fuel\r\n	<ul>\r\n		<li>「app」ディレクトリ配下のファイル &rarr; FuelPHPの「fuel/app」ディレクトリに上書きコピー</li>\r\n		<li>「public」ディレクトリ配下のファイル &rarr; FuelPHPの「public」ディレクトリに上書きコピー</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<hr />\r\n<p><span style=\"font-size:10px\">変更履歴</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:10px\">1.0.1 (2015/07/18)&nbsp;：バグフィックス</span></li>\r\n	<li><span style=\"font-size:10px\">1.0.0 (2015/06/30)&nbsp;：正式版リリース</span></li>\r\n</ul>\r\n',18,38,0,1435631161,1438134062),(17,'Dockerfile:fuelphp-accon','/develop/workspace/kurobuta.jp/fuel/app/modules/download/upload/201507/','fuelphp-accon_20150718.zip','fuelphp-accon_20150718.zip','public',1435647600,'<h2>Dockerfile一式: accon/fuelphp-accon</h2>\r\n\r\n<ul>\r\n	<li>用途: WEBアプリケーションの開発・実行基盤</li>\r\n	<li>構成: image[ubuntu-nginx-phpfpm-redis-mysql] + FuelPHP(1.7.3) + ACCON(1.0)</li>\r\n	<li>利用方法は、<a href=\"https://registry.hub.docker.com/u/accon/fuelphp-accon/\">Docker Hub</a>を参照</li>\r\n</ul>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">ビルド方法</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">\r\n<ul>\r\n	<li>\r\n	<pre>\r\ndocker build -t accon/fuelphp-accon:1.00 .</pre>\r\n	</li>\r\n</ul>\r\n</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">\r\n<hr />\r\n<div>Part of the ACCON.</div>\r\n</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">Copyright (c) 2015 Maemori Fumihiro<br />\r\nThis software is released under the MIT License.<br />\r\nhttp://opensource.org/licenses/mit-license.php</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">@version&nbsp;&nbsp;&nbsp; 1.00<br />\r\n@author&nbsp;&nbsp;&nbsp;&nbsp; Maemori Fumihiro<br />\r\n@link&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; https://kurobuta.jp</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">&nbsp;</div>\r\n\r\n<div style=\"line-height: 20.7999992370605px;\">\r\n<hr />\r\n<p>変更履歴</p>\r\n\r\n<ul>\r\n	<li>1.0.1 (2015/07/18)&nbsp;：バグフィックス</li>\r\n	<li>1.0.0 (2015/06/30)&nbsp;：正式版リリース</li>\r\n</ul>\r\n</div>\r\n',44,8,2,1435650481,1486417439);
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_contents`
--

LOCK TABLES `menus_contents` WRITE;
/*!40000 ALTER TABLE `menus_contents` DISABLE KEYS */;
INSERT INTO `menus_contents` VALUES (14,1,46,1,61,12,'public',1430715840,'管理',NULL,'管理メニュー',2,1430715942,1430911683),(16,1,6,2,62,13,'public',1430722980,'メニュー',NULL,'フロントメニュー',2,1430723053,1430911720),(17,2,27,1,1,NULL,'public',1430723040,'Accon管理','','Acconモジュール（アクセス制御機能）管理メニュー',2,1430723116,1430869854),(18,28,31,1,0,NULL,'public',1430723100,'Menu管理','','',2,1430723176,1430871969),(19,19,26,1,0,NULL,'public',1430724480,'ユーザ管理','','ユーザの管理、ユーザのパーミッションとロールを管理',2,1430724562,1430946739),(20,20,21,1,3,NULL,'public',1430724540,'ユーザ・マスタ','','ユーザマスターの閲覧・作成・更新・削除',2,1430724629,1430724629),(21,22,23,1,10,NULL,'public',1430724660,'ユーザ・パーミッション','','ユーザのパーミッションを管理',2,1430724663,1430724663),(22,24,25,1,11,NULL,'public',1430724660,'ユーザ・ロール','','ユーザのロールを管理',2,1430724702,1430724702),(23,1,10,3,63,14,'public',1430725140,'マニュアル',NULL,'マニュアル',2,1430725160,1430911693),(25,3,4,1,5,NULL,'public',1430725440,'パーミッション管理','','パーミッションの管理',2,1430725474,1430725478),(26,32,37,1,0,NULL,'public',1430770620,'Books管理','','',2,1430770662,1430871981),(27,33,34,1,19,NULL,'public',1430770620,'Slug','','本の分類を管理',2,1430770692,1434952559),(28,35,36,1,18,NULL,'public',1430770740,'Maker','','本の作成・変更・削除・公開',2,1430770759,1434952583),(29,29,30,1,24,NULL,'public',0,'Maker','','メニューの作成・変更・削除・公開',2,1430770870,1434952543),(30,11,18,1,0,NULL,'public',1430773620,'グループ管理','','グループの管理',2,1430773645,1430773645),(31,12,13,1,6,NULL,'public',0,'グループ・マスタ','','グループの管理',2,1430773672,1430773674),(32,14,15,1,7,NULL,'public',1430773680,'グループ・パーミッション','','グループ・パーミッションの管理',2,1430773710,1430773714),(33,16,17,1,8,NULL,'public',1430773680,'グループ・ロール','','グループ・ロールの管理',2,1430773737,1430773739),(34,5,10,1,0,NULL,'public',1430870160,'ロール管理','','',2,1430870221,1430870226),(35,6,7,1,4,NULL,'public',1430870220,'ロール・マスタ','','ロールの管理',2,1430870266,1430870266),(36,8,9,1,9,NULL,'public',1430870220,'ロール・パーミッション','','ロールのパーミッション管理',2,1430870291,1430870291),(37,1,12,4,64,15,'public',1430870820,'サンプル',NULL,'実装サンプル',2,1430870885,1430911706),(39,3,4,4,0,NULL,'public',1430871060,'ブログ(フロント)','https://kurobuta.jp/sample/acconfront','Acconモジュールを利用したブログ(フロント)の実装例',2,1430871098,1435089897),(40,2,7,4,0,NULL,'public',1430871120,'Accon','','Acconを利用した実装例',2,1430871157,1435089963),(41,5,6,4,0,NULL,'public',1430871240,'ブログ(管理)','https://kurobuta.jp/sample/acconadmin','Acconモジュールを利用したブログ(管理)の実装例',2,1430871253,1430899659),(42,8,9,4,0,NULL,'public',1430871300,'めかぶ(MeCab)','https://kurobuta.jp/sample/morphology','PHPからMeCabの利用',2,1430871350,1430899671),(43,10,11,4,0,NULL,'public',1430871360,'写真解析','https://kurobuta.jp/sample/exif','Exifデータから住所を取得',2,1430871415,1430899679),(46,38,39,1,17,NULL,'public',1430872020,'Download管理','','公開用ファイルのアップロード・公開管理',2,1430872073,1430872073),(47,40,45,1,0,NULL,'public',1430872320,'Blog管理','','',2,1430872334,1430872334),(48,41,42,1,13,NULL,'public',1430872320,'Slug','','Blogのスラッグを管理',2,1430872387,1430872387),(49,43,44,1,12,NULL,'public',1430872440,'Post','','ブログの記事を管理',2,1430872462,1430872462),(50,2,3,2,14,NULL,'public',1430872680,'Blog','','ブログ',2,1430872727,1430891598),(51,4,5,2,16,NULL,'public',1430872800,'Download','','ダウンロード',2,1430872808,1430872823),(52,2,3,3,65,NULL,'public',1431243900,'ACCON','','ACCONのマニュアル',2,1431243965,1431383617),(53,4,5,3,66,NULL,'public',1431244920,'Menus','','Menusアプリケーションのマニュアル',2,1431244926,1431244928),(54,6,7,3,67,NULL,'public',1431244920,'Books','','Booksアプリケーションのマニュアル',2,1431244976,1431244976),(55,8,9,3,70,NULL,'public',1431244980,'Download','','Downloadのアプリケーションのマニュアル',2,1431245014,1486536370),(56,1,10,5,69,16,'public',1435475220,'開発',NULL,'開発関連メニュー',9,1435475280,0),(57,2,3,5,0,NULL,'public',1435475280,'Jenkins','https://ci.kurobuta.jp/','kurobuta.jpのJenkins',9,1435475357,0),(58,4,5,5,0,NULL,'public',1435475400,'Redmine','https://redmine.kurobuta.jp/projects/root/issues','Issue管理',9,1435475432,0),(59,6,7,5,0,NULL,'public',1435475520,'GitLab','https://git.kurobuta.jp/','Gitリポジトリ管理ツール',9,1435475563,0),(60,8,9,5,0,NULL,'public',1435476240,'Docker Hub','https://hub.docker.com/u/accon/','インフラ公開リポジトリ',9,1435476320,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_menu`
--

LOCK TABLES `menus_menu` WRITE;
/*!40000 ALTER TABLE `menus_menu` DISABLE KEYS */;
INSERT INTO `menus_menu` VALUES (12,100,0,2,1430715942,1430909267),(13,10,0,2,1430723053,1430909298),(14,30,0,2,1430725160,1430909331),(15,20,0,2,1430870885,1430909315),(16,200,0,9,1435475280,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (4,'ACCON近々リリース',1,'public',1427623200,'<p><span style=\"color:#6666cc\"><span style=\"font-size:48px\">ACCON</span></span><span style=\"font-size:24px\">は、</span></p>\r\n\r\n<p><span style=\"font-size:24px\">FuelPHPで作成したアプリケーションに</span><span style=\"font-size:36px\"><span style=\"background-color:rgb(240, 255, 255)\">完全</span></span><span style=\"font-size:24px\">な</span><span style=\"color:#B22222\"><span style=\"font-size:48px\">アクセス制御</span></span><span style=\"font-size:24px\">を</span><span style=\"font-size:36px\"><span style=\"background-color:rgb(240, 255, 240)\">付与</span></span><span style=\"font-size:24px\">するオープンソースなモジュールです。</span></p>\r\n\r\n<p>近々リリース予定（MITライセンス/当サイトもACCONを利用して構築されています）。</p>\r\n','<p><span style=\"font-size:24px\">機能</span></p>\r\n\r\n<p style=\"margin-left:40px\"><span style=\"font-size:24px\">ACCONを導入すると利用できる機能</span></p>\r\n\r\n<ul style=\"margin-left:40px\">\r\n	<li><span style=\"font-size:24px\">グループ/ユーザ管理機能</span></li>\r\n	<li><span style=\"font-size:24px\">アクセスコントロール管理機能</span></li>\r\n	<li><span style=\"font-size:24px\">権限(ロール/グループ/ユーザ)管理機能</span></li>\r\n	<li><span style=\"font-size:24px\">認証(ログイン/ログアウト)機能</span></li>\r\n	<li><span style=\"font-size:24px\">アクセスコントロール機能</span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:40px\"><span style=\"font-size:24px\">ACCONを利用してアプリケーションを開発した場合、得られるメリット</span></p>\r\n\r\n<ul style=\"margin-left:40px\">\r\n	<li><span style=\"font-size:24px\">CRUDアプリケーションを簡素で最低限のコードで作成</span></li>\r\n	<li><span style=\"font-size:24px\">標準的な画面の場合、一覧検索画面のみの実装でOK</span></li>\r\n</ul>\r\n\r\n<p><span style=\"font-size:24px\">&nbsp;要件</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:24px\">FuelPHP 1.7</span></li>\r\n	<li><span style=\"font-size:24px\">MySQL 5</span></li>\r\n</ul>\r\n',4,1427622823,1427633398),(5,'Acconモジュール βリリース',1,'public',1428127200,'<h1><span style=\"font-size:48px\"><strong><a href=\"https://kurobuta.jp/download/view/6\"><span style=\"color:rgb(87, 89, 237)\">現在、公開テスト中</span></a></strong></span></h1>\r\n\r\n<p><span style=\"font-size:28px\">また、Acconを利用して作成された<a href=\"https://kurobuta.jp/download/view/7\">ダウンロード管理モジュール</a>も合わせて公開中</span></p>\r\n','<p>近々、機能説明、利用方法を公開予定</p>\r\n',4,1428129057,1428129235),(6,'アクセス制御オールインパッケージ【ACCON】開発者向けバージョン（Version 0.1.0）をリリース',1,'public',1431245400,'<p>ダウンロードは<a href=\"https://kurobuta.jp/download/view/6\">こちら</a></p>\r\n\r\n<p><a href=\"https://kurobuta.jp/books/book/manual/accon/\">マニュアルは現在整備中</a>です。</p>\r\n\r\n<h2>主な特徴</h2>\r\n\r\n<ul>\r\n	<li>Webアプリケーション（通常/Ajax）に対してアクセス制御を提供（コーディング不要）</li>\r\n	<li>アクセス制御の許可は、ロール・グループ・ユーザ単位に設定可能</li>\r\n	<li>アクセス制御の対象はアクション単位</li>\r\n	<li>アクセス制御をバンドルするアプリケーションの開発簡単にする仕組みを提供（業務で使用できるレベルのアプリケーションを容易に実装可能）</li>\r\n	<li>関連モジュールを追加するとサイトの機能を追加可能</li>\r\n</ul>\r\n\r\n<p>機能はまだまだ色々あります。順次マニュアルに記載していきます。</p>\r\n','<p><span style=\"font-size:24px\">AcconはFuelPHPを拡張するモジュールです。</span></p>\r\n\r\n<p><span style=\"font-size:24px\">アクセス制御のベースにOrmAuthを使用し、その豊富な機能をコーデイング不要で利用できるようになっています。</span></p>\r\n\r\n<p><span style=\"font-size:24px\">また、通常のアプリケーション開発時に必要となる基本的な機能（アクセス制御・色々な画面機能・セキュリティ・DB分散・ログ・etc）がすでに実装済みのためビジネスロジックのみに注力して開発が可能です。</span></p>\r\n\r\n<p><span style=\"font-size:24px\">もちろん提供機能はカスタマイズ可能。</span></p>\r\n',2,1431246003,1432162693),(7,'【ACCON】開発者向けバージョン（Version 0.1.0）リリースにともない関連モジュールをリリース',1,'public',1431246420,'<p>ACCONは開発の基盤として利用する以外に関連するモジュールを導入することで、サイトの機能を拡張できます。</p>\r\n\r\n<p>今回は、ACCONのリリースに伴い３つのモジュールを同時リリースしました。</p>\r\n','<h2><span style=\"font-size:24px\">Menusモジュール</span></h2>\r\n\r\n<p style=\"margin-left:40px\"><span style=\"font-size:24px\">ACCONと連動してアプリケーションのメニューを管理できるアプリケーション（当サイトの上に表示されているメニューは、この機能を使用しています）</span></p>\r\n\r\n<h2><span style=\"font-size:24px\">Booksモジュール</span></h2>\r\n\r\n<p style=\"margin-left:40px\"><span style=\"font-size:24px\">コンテンツをツリー構造で管理・公開できるアプリケーション（当サイトの上に表示されているマニュアルは、この機能を使用しています）</span></p>\r\n\r\n<h2><span style=\"font-size:24px\">Downloadモジュール</span></h2>\r\n\r\n<p style=\"margin-left:40px\"><span style=\"font-size:24px\">ファイルのダウンロードを管理するアプリケーション。アップロード・公開制御・統計情報の取得などの機能があります（当サイトのモジュールの配布は、この機能を使用しています）</span></p>\r\n\r\n<p><span style=\"font-size:24px\">順次、導入・利用方法を公開していきます。</span></p>\r\n',2,1431246455,1432162664),(8,'【ACCON】OSとミドルウェアの環境をDocker形式で配布開始',1,'public',1435485000,'<p>ACCONパッケージのOS&amp;ミドルウェアのレイヤをDockeとして公開しました（MITライセンス）</p>\r\n','<p>イメージの取得と利用方法は<a href=\"https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/\">こちら</a></p>\r\n\r\n<p>Dockerfile一式のダウンロードは<a href=\"https://kurobuta.jp/download/view/15\">こちら</a></p>\r\n',9,1435485173,1436915536),(9,'ACCON Version 1.0.0 リリース',1,'public',1436914680,'<p><img alt=\"ACCONシステム構成図\" src=\"https://lh3.googleusercontent.com/cZgHYr6smJLGodWm_Iw2akgQbhHhSj3uioBcAL3S3aM=w566-h400-no\" style=\"height:400px; width:566px\" /></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:12px\"><a href=\"https://registry.hub.docker.com/u/accon/fuelphp-accon/\">accon/fuelphp-accon</a>：</span><span style=\"font-size:10px\">Webアプリケーション開発・実行環境</span></li>\r\n	<li><span style=\"font-size:12px\"><a href=\"https://kurobuta.jp/books/book/manual/accon/\">ACCON</a>：</span><span style=\"font-size:10px\">Webアプリケーション開発・実行基盤</span></li>\r\n	<li><span style=\"font-size:12px\">Blog：</span><span style=\"font-size:10px\">ACCONを利用したサンプル（ブログの管理機能と公開機能）</span></li>\r\n	<li><span style=\"font-size:12px\">Service module：</span><span style=\"font-size:10px\">ACCON上で動作するWebアプリケーションサービス</span></li>\r\n	<li><span style=\"font-size:12px\"><a href=\"https://registry.hub.docker.com/u/accon/ubuntu-nginx-phpfpm-redis-mysql/\">accon/ubuntu-nginx-phpfpm-redis-mysql</a>：</span><span style=\"font-size:10px\">Webアプリケーション開発サーバー</span></li>\r\n</ul>\r\n','<ul>\r\n	<li><a href=\"https://kurobuta.jp/books/book/manual/accon//?id=48\">インストール方法</a></li>\r\n	<li><a href=\"https://kurobuta.jp/books/book/manual/accon//?id=19\">マニュアル</a></li>\r\n</ul>\r\n\r\n<p><img alt=\"ACCON クラス図\" src=\"https://lh3.googleusercontent.com/o_XW3fwGxMhFZXTtZ-gmcCdfpZRJXz-uhD9QyB5WVg=w2514-h1778-no\" style=\"width:100%\" /></p>\r\n\r\n<p style=\"text-align:right\">Powered by <a href=\"http://fuelphp.jp/\">FuelPHP</a></p>\r\n',9,1436915492,1436915652),(10,'最新バージョンのご案内',1,'public',1437692520,'<p>2015年7月24日時点のリリース情報です。</p>\r\n','<ul>\r\n	<li><a href=\"https://kurobuta.jp/download/view/6\">ACCON Version 1.0.2（2015/07/24）</a>&nbsp;：アクションの権限がない場合、非活性から非表示へ変更 ＆ 不具合対応（詳細はリリースノートを参照）</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/13\">メニュー管理モジュール Version 1.0.0 (2015/06/30)&nbsp;</a>：正式版リリース</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/14\">ツリー構造コンテンツ管理モジュール Version 1.0.1 (2015/07/18)&nbsp;</a>：SEO改善 ＆ 不具合対応（詳細はリリースノートを参照）</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/7\">ダウンロード管理モジュール Version 1.0.1 (2015/07/18)&nbsp;</a>：SEO改善 ＆ 不具合対応（詳細はリリースノートを参照）</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/16\">ACCON利用サンプル Version 1.0.1 (2015/07/18)&nbsp;</a>：不具合対応</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/17\">Dockerfile:fuelphp-accon Version 1.0.1 (2015/07/18)&nbsp;</a>：不具合対応</li>\r\n	<li><a href=\"https://kurobuta.jp/download/view/15\">Dockerfile:accon/ubuntu-nginx-phpfpm-redis-mysql Version 1.0.0 (2015/06/30)</a> ：正式版リリース</li>\r\n</ul>\r\n',9,1437692850,1437692895);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'Guest','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',1,'guest@accon.jp','0','0','',1,1419896560,1428156574),(1,'Admin','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',7,'admin@accon.jp','1486270002','1433708234','a11778fc6f9ba344d3662fbc0ce29e272e4076db',1,1419896560,1486270002),(2,'Kurobuta','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',5,'kurobuta@accon.jp','1486533302','1486507801','6ea208da3b88fd5c4e6db41a8d3153ed155365af',2,1425712557,1486533302),(3,'Kuroneko','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',4,'kuroneko@accon.jp','0','0','',2,1425518782,1430946806),(4,'Inu','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',2,'inu@accon.jp','1437973199','1437690330','b403cd7f1791834f449062e512608f506420325c',4,1426545474,1437973199),(5,'Uma','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',3,'uma@accon.jp','0','0','',2,1425712557,1430946810),(6,'Ushi','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',0,'ushi@accon.jp','0','0','',2,1426545474,1430946815),(7,'Yagi','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',6,'yagi@accon.jp','0','0','',2,1426545474,1430946820),(8,'Accon','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',8,'accon@accon.jp','1486507743','1486271070','d57558f1b75aa15daff228f2e52ab85aac5dd1fe',8,1426545474,1486507743),(9,'Maemori','jaEVoZZRHGIIE+R+ZsP4JC4C1FIWW53a2FusDlu+8mg=',5,'maemori@kurobuta.jp','1438125979','1437972908','fc391b53e81aa0770bf9b56fad1995ccea130e0c',9,1435475186,1438125979),(10,'test3','AYhFHICWaxq/zttb5t8oe/cdZhVb6c42Ldaa/ncKqeo=',7,'test@test.co.jp','0','0','0',2,1486510735,1486510748);
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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
INSERT INTO `users_permissions` VALUES (1,'/accon','admin','サービス一覧','a:1:{i:0;s:5:\"index\";}',4,1425668227,1427601715),(2,'Service','Cache','サーバーのキャッシュ全削除','a:1:{i:0;s:6:\"delete\";}',4,1425669669,1425669669),(3,'/accon/admin','user','ユーザ管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:8:\"password\";i:6;s:8:\"register\";i:7;s:6:\"modify\";i:8;s:15:\"modify_password\";}',4,1425670497,1428122727),(4,'/accon/admin','role','ロール管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713296,1427601452),(5,'/accon/admin','permission','パーミッション管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713332,1427601470),(6,'/accon/admin','group','グループ管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',2,1425713359,1486508531),(7,'/accon/admin/group','permission','グループ権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713393,1427601539),(8,'/accon/admin/group','role','グループとロールを関連付け','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713422,1427601614),(9,'/accon/admin/role','permission','ロール権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713454,1427601635),(10,'/accon/admin/user','permission','ユーザ権限管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713490,1427601675),(11,'/accon/admin/user','role','ユーザとロールの関連付け','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1425713516,1427601693),(12,'/blog','post','Blog 記事投稿','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1426806491,1427601733),(13,'/blog','slug','Blog 投稿分類','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1427149497,1427601745),(14,'/blog','front','Blog （一般公開）','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1427153070,1430891983),(15,'/','welcome','TOPページ','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1427622290,1427622290),(16,'/download','download','Downloadページ','a:3:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:3:\"get\";}',4,1427757885,1427757885),(17,'/download','admin','Download管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1427757925,1427757925),(18,'/treebooks','maker','Bookの管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;s:4:\"edit\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',2,1428280602,1434952475),(19,'/treebooks','slug','Books slug 管理','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',4,1428282623,1428282623),(20,'/treebooks','contents','Book コンテンツ管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:6:\"parent\";i:6;s:5:\"child\";i:7;s:2:\"up\";i:8;s:4:\"down\";}',4,1428290682,1428314374),(21,'/treebooks','book','Bookの一覧','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',4,1428933247,1430699052),(23,'/menus','menus','メニュー管理','a:2:{i:0;s:5:\"index\";i:1;s:4:\"view\";}',4,1428943139,1428943435),(24,'/menus','maker','メニュー管理機能','a:5:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";}',2,1428943523,1434952490),(25,'/menus','contents','メニューの構成管理','a:9:{i:0;s:5:\"index\";i:1;s:4:\"edit\";i:2;s:4:\"view\";i:3;s:6:\"create\";i:4;s:6:\"delete\";i:5;s:6:\"parent\";i:6;s:5:\"child\";i:7;s:2:\"up\";i:8;s:4:\"down\";}',4,1429136945,1429136969),(28,'/accon/ajax/admin','permission','Ajax permission list','a:1:{i:0;s:6:\"action\";}',4,1429184596,1429184596),(30,'/treebooks/ajax','slug','SlugからURLを取得','a:1:{i:0;s:4:\"area\";}',2,1429299869,1429299939),(49,'/treebooks/book/manual','testbook','本のタイトル','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1429316238,1430699071),(60,'/menus/ajax','menu','メニューリスト','a:4:{i:0;s:4:\"list\";i:1;s:5:\"items\";i:2;s:10:\"breadcrumb\";i:3;s:6:\"return\";}',2,1430715553,1430768243),(61,'/menus/menu','admin','管理','a:1:{i:0;s:5:\"index\";}',2,1430715942,1435100980),(62,'/menus/menu','front','メニュー','a:1:{i:0;s:5:\"index\";}',2,1430723053,1435100986),(63,'/menus/menu','manual','マニュアル','a:1:{i:0;s:5:\"index\";}',2,1430725160,1435100991),(64,'/menus/menu','sample','サンプル','a:1:{i:0;s:5:\"index\";}',2,1430870885,1435100995),(65,'/treebooks/book/manual','accon','ACCON','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1431243720,1431383578),(66,'/treebooks/book/manual','menus','Menus','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1431244613,1431244613),(67,'/treebooks/book/manual','books','Tree books','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1431244691,1486507852),(69,'/menus/menu','develop','開発','a:1:{i:0;s:5:\"index\";}',9,1435475280,0),(70,'/treebooks/book/manual','download','ダウンロードのマニュアル','a:3:{i:0;s:4:\"root\";i:1;s:5:\"index\";i:2;s:4:\"view\";}',2,1486533400,1486533419);
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_role_permissions`
--

LOCK TABLES `users_role_permissions` WRITE;
/*!40000 ALTER TABLE `users_role_permissions` DISABLE KEYS */;
INSERT INTO `users_role_permissions` VALUES (1,3,3,'a:2:{s:6:\"modify\";i:7;s:15:\"modify_password\";i:8;}'),(2,3,4,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(3,3,5,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(4,3,6,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(5,3,7,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(6,3,8,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(7,3,9,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:2;}'),(10,3,1,'a:1:{s:5:\"index\";i:0;}'),(11,2,15,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(12,2,14,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(13,2,16,'a:3:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:3:\"get\";i:2;}'),(14,3,12,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(15,3,13,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(16,3,17,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(18,3,19,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(19,3,18,'a:5:{s:5:\"index\";i:0;s:4:\"view\";i:1;s:4:\"edit\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(20,3,20,'a:9:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:6:\"parent\";i:5;s:5:\"child\";i:6;s:2:\"up\";i:7;s:4:\"down\";i:8;}'),(21,2,21,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(23,3,23,'a:2:{s:5:\"index\";i:0;s:4:\"view\";i:1;}'),(24,3,24,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(25,3,25,'a:9:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:6:\"parent\";i:5;s:5:\"child\";i:6;s:2:\"up\";i:7;s:4:\"down\";i:8;}'),(26,3,28,'a:1:{s:6:\"action\";i:0;}'),(27,5,2,'a:1:{s:6:\"delete\";i:0;}'),(28,3,30,'a:1:{s:4:\"area\";i:0;}'),(37,2,49,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(38,2,60,'a:4:{s:4:\"list\";i:0;s:5:\"items\";i:1;s:10:\"breadcrumb\";i:2;s:6:\"return\";i:3;}'),(39,2,65,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(40,2,67,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(42,2,66,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(43,5,3,'a:6:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;s:8:\"password\";i:5;}'),(44,5,11,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(45,5,10,'a:5:{s:5:\"index\";i:0;s:4:\"edit\";i:1;s:4:\"view\";i:2;s:6:\"create\";i:3;s:6:\"delete\";i:4;}'),(46,2,63,'a:1:{s:5:\"index\";i:0;}'),(47,3,61,'a:1:{s:5:\"index\";i:0;}'),(48,2,62,'a:1:{s:5:\"index\";i:0;}'),(50,2,64,'a:1:{s:5:\"index\";i:0;}'),(51,5,69,'a:1:{s:5:\"index\";i:0;}'),(52,1,66,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}'),(53,2,70,'a:3:{s:4:\"root\";i:0;s:5:\"index\";i:1;s:4:\"view\";i:2;}');
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

-- Dump completed on 2017-02-09  7:27:48
