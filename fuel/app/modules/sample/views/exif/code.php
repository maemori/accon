<div class="container">
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span> ホーム</a></li>
		<li class="active"><span class="glyphicon glyphicon-list-alt"></span> サンプル</li>
		<li><a href="/sample/exif"><span
					class="glyphicon glyphicon-cog"></span> <?php echo $title; ?></a></li>
		<li class="active"><span class="glyphicon glyphicon-pencil"></span> サンプルコード</li>
	</ul>
	<div class="container">
		<?php
		$string = '# 写真から住所を取得するサンプルコード

画像のEXIFデータから住所を取得するサンプル。（内包機能：複数ファイルアップロード、ＵＲＬから複数の画像ファイル取得、画像のBASE64エンコーディング、GooogleMapV3連携・複数マーキング）

***

## 事前準備

* [FuelPHPのインストール](http://fuelphp.jp/docs/1.8/installation/instructions.html "FuelPHP")

***

## サンプルコード
';
		echo Markdown::parse($string);
		?>
		<h3>Controller</h3>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/controller/exif.php'); ?></code>
		</div>
		<h3>Model</h3>
		<h4>photo</h4>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/model/photo.php'); ?></code>
		</div>
		<h4>exif</h4>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/model/exif.php'); ?></code>
		</div>
		<h4>address</h4>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/model/address.php'); ?></code>
		</div>
		<h4>html</h4>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/model/html.php'); ?></code>
		</div>
		<h3>View</h3>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/views/exif/content.php'); ?></code>
		</div>
	</div>
</div>