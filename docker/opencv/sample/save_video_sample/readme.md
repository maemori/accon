[TOP](https://github.com/maemori/OpenCV3_Sample/)
----

# [C++] OpenCV3 描画サンプル: 動画の保存

動画を読み込み、リサイズ＆モノクロ変換して動画ファイルの保存を行います。

## 0.内容

保存処理

* cv::VideoWriter writer - ビデオライターの取得
* writer.open - ビデオライターの初期化を確認
* writer << gray - 動画にフレームを追加

保有処理

* cv::VideoCapture - 動画の読み込み
* capture >> frame; - 再生フレームの取得
* cv::resize - リサイズ
* cv::cvtColor(・・・, cv::COLOR_BGR2GRAY); - グレースケール変換

## 1.[サンプルコード](./main.cpp)

### 1.1. 実行イメージ

入力動画（クリックでYouTubeの動画が開きます）:

[![入力動画](http://img.youtube.com/vi/UDPQthJe7cg/0.jpg)](https://www.youtube.com/watch?v=UDPQthJe7cg)

出力動画（クリックでYouTubeの動画が開きます）:

[![出力動画](http://img.youtube.com/vi/MpB86yd_qqY/0.jpg)](https://www.youtube.com/watch?v=MpB86yd_qqY)


## 2.ビルド

``` bash
cmake .
make
```

## 3.実行

``` bash
./put_text_sample
```

