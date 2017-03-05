#!/usr/bin/env bash

# 基礎ディレクトリの作成
if [ ! -e /develop/workspace ]; then
	mkdir -p /develop/workspace
fi
if [ ! -e /develop/www ]; then
	mkdir -p /develop/www
fi

# FuelPHPの配置
if [ ! -e /develop/workspace/product ]; then
	cp -a /develop/archive/workspace/product /develop/workspace/
fi

# ACCONとサンプルの設置
if [ ! -e /develop/workspace/product/fuel/app/modules/accon ]; then
	# ACCONの取得と設置
	curl -k https://kurobuta.jp/download/get/6 > /develop/archive/accon.zip
	unzip /develop/archive/accon.zip -d /develop/workspace/product/fuel/app/modules
	# Sampleファイルセットの取得
	curl -k https://kurobuta.jp/download/get/16 > /develop/archive/sample.zip
	unzip -o /develop/archive/sample.zip -d /develop/workspace/product/
	## Sampleファイルセットをappディレクトリに設置
	mv -f /develop/workspace/product/sample/app/bootstrap.php /develop/workspace/product/fuel/app/
	## classes設置
	rm -Rf /develop/workspace/product/fuel/app/classes
	mv /develop/workspace/product/sample/app/classes /develop/workspace/product/fuel/app/
	## config設置
	rm -Rf /develop/workspace/product/fuel/app/config
	mv /develop/workspace/product/sample/app/config /develop/workspace/product/fuel/app/
	## views設置
	rm -Rf /develop/workspace/product/fuel/app/views
	mv /develop/workspace/product/sample/app/views /develop/workspace/product/fuel/app/
	## Sampleファイルセットをpublicディレクトリに設置
	rm -Rf /develop/workspace/product/public/assets
	mv /develop/workspace/product/sample/public/assets /develop/workspace/product/public/
	# Sampleファイルセットの削除
	rm -Rf /develop/workspace/product/sample
fi

# Database構築用ファイルの設置
if [ ! -e /develop/workspace/product/data ]; then
	## Databaseの作成
	cp /develop/workspace/product/fuel/app/modules/accon/data/database.sql /tmp/
	## 初期データの投入
	cp /develop/workspace/product/fuel/app/modules/accon/data/tables.sql /tmp/
fi

# Menusモジュールのの設置
if [ ! -e /develop/workspace/product/fuel/app/modules/menus ]; then
	curl -k https://kurobuta.jp/download/get/13 > /develop/archive/menus.zip
	unzip /develop/archive/menus.zip -d /develop/workspace/product/fuel/app/modules
fi

# Treebooksモジュールのの設置
if [ ! -e /develop/workspace/product/fuel/app/modules/treebooks ]; then
	curl -k https://kurobuta.jp/download/get/14 > /develop/archive/treebooks.zip
	unzip /develop/archive/treebooks.zip -d /develop/workspace/product/fuel/app/modules
fi

# Downloadモジュールのの設置
if [ ! -e /develop/workspace/product/fuel/app/modules/download ]; then
	curl -k https://kurobuta.jp/download/get/7 > /develop/archive/download.zip
	unzip /develop/archive/download.zip -d /develop/workspace/product/fuel/app/modules
fi

# wwwの設置
if [ ! -e /develop/www/index.php ]; then
	ln -s /develop/workspace/product/public/* /develop/www/
	ln -s /develop/workspace/product/public/.htaccess /develop/www/
fi

echo -e "\nACCON Installation completion\n"

# Service1の起動とDatabaseの作成
/etc/service/run
