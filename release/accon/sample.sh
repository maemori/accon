#!/bin/bash
target=sample
base_dir=~/Develop/master/accon/v2.0/data-volume/workspace/accon/
release_dir=~/Develop/master/accon/release

cd $release_dir

# バックアップディレクトリ作成
if [ ! -e $release_dir"/_backup" ]; then
	mkdir $release_dir"/_backup"
fi

# 配布モジュール格納先作成
if [ -e $release_dir"/"$target ]; then
	rm -Rf $release_dir"/"$target
fi

# 前回作成モジュールをバックアップ
if [ -e $release_dir"/"$target*.zip ]; then
	mv -f $release_dir"/"$target*.zip $release_dir"/_backup/"
fi

# リリース対象取得
## classes
mkdir -p $release_dir"/"$target"/app/classes"
cp -Ra $base_dir"/fuel/app/classes" $release_dir"/"$target"/app/"
## config
mkdir -p $release_dir"/"$target"/app/config"
cp -Ra $base_dir"/fuel/app/config" $release_dir"/"$target"/app/"
## views
mkdir -p $release_dir"/"$target"/app/views"
cp -Ra $base_dir"/fuel/app/views" $release_dir"/"$target/app/
## public
mkdir -p $release_dir"/"$target"/public"
cp -Ra $base_dir"/public/assets" $release_dir"/"$target/public/
## bootstrap.php
cp -a $base_dir"/fuel/app/bootstrap.php" $release_dir"/"$target"/app/"

# リリースファイル作成
zip -r $target"_"`date +%Y%m%d`.zip $target
