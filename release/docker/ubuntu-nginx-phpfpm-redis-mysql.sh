#!/bin/bash
terget=ubuntu-nginx-phpfpm-redis-mysql
filepass=~/Develop/master/accon/v2.0/data-volume/workspace/accon/docker
release_dir=~/Develop/master/accon/release

cd $release_dir

# バックアップディレクトリ作成
if [ ! -e $release_dir"/_backup" ]; then
	mkdir $release_dir"/_backup"
fi

# 配布モジュール格納先作成
if [ -e $release_dir"/ubuntu-nginx-phpfpm-redis-mysql" ]; then
	rm -Rf $release_dir"/ubuntu-nginx-phpfpm-redis-mysql"
fi

# 前回作成モジュールをバックアップ
if [ -e $release_dir"/"$terget*.zip ]; then
	mv -f $release_dir"/"$terget*.zip $release_dir"/_backup/"
fi

# リリース対象取得
cp -a $filepass"/"$terget ./

# リリースファイル作成
zip -r $terget"_"`date +%Y%m%d`.zip $terget
