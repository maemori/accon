<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">KUROBUTA.JP</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			</ul>
			<ul class="nav navbar-nav navbar-right">
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php if ($error = Session::get_flash('error')): ?>
				<div class="alert alert-danger"><span class=""><?php echo $error; ?></span></div>
			<?php endif; ?>
		</div>
	</div>
</div>

