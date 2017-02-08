<div class="container">
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span> ホーム</a></li>
		<li class="active"><span class="glyphicon glyphicon-list-alt"></span> サンプル</li>
		<li class="active"><span class="glyphicon glyphicon-pencil"></span> <?php echo $title; ?></li>
	</ul>
	<div class="container">
		<?php
		$string = '# Acconを利用した管理機能の実装例

FuelPHPでアプリケーションを作成する場合、Acconモジュールを利用すると、アクセス制御とCRUDアプリケーションに必要な機能を強力にサポート。
このサンプルのコードは、そのAcconモジュールを利用してブログの管理（記事投稿・管理）の実装例です。

***

## 事前準備

* [FuelPHPのインストール](http://fuelphp.jp/docs/1.8/installation/instructions.html "FuelPHP")
* [必要なライブラリのインストール（準備中）](https://kurobuta.jp/ "kurobuta.jp")
* [Acconのインストール（準備中）](https://kurobuta.jp/ "kurobuta.jp")

***

## サンプルコード
';
		echo Markdown::parse($string);
		?>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Controller</h3>
				<h4>fuel/app/classes/controller/blog/post.php</h4>
				<div class="well pre-scrollable">
					<code><?php show_source(APPPATH.'classes/controller/blog/post.php'); ?></code>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>Model</h3>
				<h4><a href="https://localhost/sample/acconfront" title="Acconフロント実装例">フロント側と共通</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>View</h3>
				<h4>fuel/app/views/blog/post/index.php</h4>
				<div class="well pre-scrollable">
					<code><?php show_source(APPPATH.'views/blog/post/index.php'); ?></code>
				</div>
				<h4>fuel/app/views/blog/post/_form.php</h4>
				<div class="well pre-scrollable">
					<code><?php show_source(APPPATH.'views/blog/post/_form.php'); ?></code>
				</div>
				<h4>fuel/app/views/blog/post/_menu.php</h4>
				<div class="well pre-scrollable">
					<code><?php show_source(APPPATH.'views/blog/post/_menu.php'); ?></code>
				</div>
			</div>
		</div>
	</div>
</div>