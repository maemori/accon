<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="/"><span class="glyphicon glyphicon-home"></span> <?php echo MENU_HOME; ?></a></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p>はじめに</p>
			<h2>ACCONシリーズ</h2>
			<h3>データベースとアクセス制御を利用したWebアプリケーションに特化。その開発・実行に必要な基盤をオープンソースとして公開。</h3>
			<h4>ACCONシリーズは、OS層からアプリケーション層まで全てをターゲットとしており、WEBアプリケーションの開発・運用をライトします。（従来の5%の労力でアプリケーションを構築&リリースが可能 *1）</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>インストール済み</h2>
			<ul class="list-group">
				<li class="list-group-item">
                    <div class="text-left"><span title="Menu" class="glyphicon glyphicon-ok-sign"></span>&nbsp;ACCON<span>&nbsp;：&nbsp;基礎モジュール（<a href="/treebooks/book/manual/accon/">マニュアル</a>）</span></div>
 				</li>
				<li class="list-group-item">
					<div class="text-left"><span title="Menu" class="glyphicon glyphicon-ok-sign"></span>&nbsp;MENUS<span>&nbsp;：&nbsp;メニューを管理・公開するアプリケーション（<a href="/treebooks/book/manual/menus/">マニュアル</a>）</span></div>
				</li>
				<li class="list-group-item">
					<div class="text-left"><span title="Menu" class="glyphicon glyphicon-ok-sign"></span>&nbsp;Treebooks<span>&nbsp;：&nbsp;ツリー構造のコンテンツを管理・公開するアプリケーション（<a href="/treebooks/book/manual/books/"></span>マニュアル</a>）</span></div>
				</li>
				<li class="list-group-item">
					<div class="text-left"><span title="Menu" class="glyphicon glyphicon-ok-sign"></span>&nbsp;DOWNLOAD<span>&nbsp;：&nbsp;ダウンロードサービスを管理するアプリケーション（<a href="/treebooks/book/manual/download/">マニュアル</a>）</span></div>
				</li>
			</ul>
			<?php echo render('layout/rectangle'); ?>
		</div>
		<div class="col-md-8">
			<h2>連絡</h2>
			<?php echo render('blog/front/_list'); ?>
			<div class="pull-right"><?php echo Pagination::instance('pagination')->render(); ?></div>
			<p>*1 開発対象の特性、外的要因、開発者の熟練度により変動します</p>
		</div>
	</div>
</div>
