<div class="container">
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span> ホーム</a></li>
		<li class="active"><span class="glyphicon glyphicon-list-alt"></span> サンプル</li>
		<li><a href="/sample/morphology"><span class="glyphicon glyphicon-cog"></span> <?php echo $title; ?></a></li>
		<li class="active"><span class="glyphicon glyphicon-pencil"></span> サンプルコード</li>
	</ul>
	<div class="container">
		<?php
		$string = '# MeCabをPHPから利用するサンプル

形態素解析のエンジンであるMeCabをPHPから利用するサンプルです。
サンプルのコードは、PHP5用のWebフレームワークのFuelPHPを利用しています。

***

## 事前準備

* [FuelPHPのインストール](http://fuelphp.jp/docs/1.8/installation/instructions.html "FuelPHP")
* [MeCabのインストール](http://kurobuta.jp/2014/11/30/%E3%82%81%E3%81%8B%E3%81%B6%E3%81%AE%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB/ "kurobuta.jp")
* [php-mecabのインストール](http://kurobuta.jp/2014/12/01/php%E3%81%8B%E3%82%89mecab%E3%82%92%E5%88%A9%E7%94%A8/ "kurobuta.jp")

***

## サンプルコード
';
		echo Markdown::parse($string);
		?>
		<h3>Controller</h3>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/controller/morphology.php'); ?></code>
		</div>
		<h3>Model</h3>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/classes/model/morphology.php'); ?></code>
		</div>

		<h3>View</h3>
		<div class="well pre-scrollable">
			<code><?php show_source(APPPATH.'modules/sample/views/morphology/content.php'); ?></code>
		</div>
	</div>
</div>