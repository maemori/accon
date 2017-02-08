<div class="container">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/"><?php echo \Config::get('accon.site_name') ?></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<!-- Accon Auth Menu --->
			<ul class="nav navbar-nav">
				<?php
				if (!\Session::get('username')) {
					if (!\Session::get_flash('Logged')) {
						echo '<li>'.Html::anchor('/accon/auth/login', '<span class="glyphicon glyphicon-log-in"></span>&nbsp;ログイン').'</li>';
					}
					echo '<li>'.Html::anchor('/accon/admin/user/register', '<span class="glyphicon glyphicon-user"></span>&nbsp;アカウントの新規作成作成').'</li>';
				} else {
					echo '<li class="dropdown">';
					echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;'.
						\Session::get('username').'<span class="caret"></span></a>';
					echo '<ul class="dropdown-menu" role="menu">';
					echo '<li>'.Html::anchor('/accon/auth/logout', '<span class="glyphicon glyphicon-log-out"></span>&nbsp;ログアウト').'</li>';
					echo '<li>'.Html::anchor('/accon/admin/user/modify', '<span class="glyphicon glyphicon-list-alt"></span>&nbsp;アカウント情報の変更').'</li>';
					echo '<li>'.Html::anchor('/accon/admin/user/modify_password', '<span class="glyphicon glyphicon-text-color"></span>&nbsp;パスワード変更').'</li>';
					if (\Auth::has_access('Service.Cache[delete]')) {
						echo '<li>'.Html::anchor('/accon/cache/delete', '<span class="glyphicon glyphicon-trash"></span>&nbsp;キャッシュのクリア').'</li>';
					}
					echo '</ul>';
				}
				?>
			</ul>
			<!-- Module Menus List -->
			<?php echo render('Menus::menu/_list'); ?>
		</div>
	</nav>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12" id="error_message">
			<?php if ($error = Session::get_flash('error')): ?>
				<div class="alert alert-danger"><span class=""><?php echo $error; ?></span></div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Module Menus Items -->
<?php echo render('Menus::menu/_items'); ?>
