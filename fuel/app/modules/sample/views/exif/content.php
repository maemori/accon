<div class="container">
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span> ホーム</a></li>
		<li class="active"><span class="glyphicon glyphicon-list-alt"></span> サンプル</li>
		<li class="active"><span class="glyphicon glyphicon-cog"></span> <?php echo $title; ?></li>
		<li class="active"><a href="/sample/code/exif"><span
					class="glyphicon glyphicon-pencil"></span> サンプルコード</a></li>
	</ul>
	<div class="row">
		<div class="col-md-4">
			<h2>入力</h2>
			<div>
				<label class="lead">位置情報</label>
				<div class="btn-group btn-toggle">
					<button class="btn btn-lg btn-default">ON</button>
					<button class="btn btn-lg btn-primary active">OFF</button>
				</div>
			</div>
			<!--タブ-->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#upload" data-toggle="tab">アップロード（複数可）</a></li>
				<li><a href="#url" data-toggle="tab">ウェブページ(URL)</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="upload">
					<?php echo Form::open(array('enctype' => 'multipart/form-data')); ?>
					<?php echo Form::file(array('id' => 'form_upload_file', 'name' => 'upload_file[]', 'class' => 'file', 'multiple' => 'true', 'data-show-upload' => 'false', 'data-show-caption' => 'true', 'data-max-file-count' => 10)); ?>
					<button type="submit" name="processing" value="<?php echo SERVICE_UPLOAD_KEY ?>"
							class="add-on btn btn-primary btn-lg btn-block margin4px"><?php echo SERVICE_UPLOAD_NAME ?></button>
					<div id="geo1"></div>
					<?php echo Form::close(); ?>
				</div>
				<div class="tab-pane" id="url">
					<?php echo Form::open(); ?>
					<input type="url" id="input" name="input" placeholder="http://" value=""
						   class="form-control input-xx">
					<button type="submit" name="processing" value="<?php echo SERVICE_URL_KEY ?>"
							class="add-on btn btn-primary btn-lg btn-block margin4px"><?php echo SERVICE_URL_NAME ?></button>
					<div id="geo2"></div>
					<?php echo Form::close(); ?>
				</div>
			</div>
			<?php echo Form::open(); ?>
			<button type="submit" name="processing" value="<?php echo SERVICE_CLEAR_KEY ?>"
					class="btn btn-default btn-xs btn-block btn-clear"><?php echo SERVICE_CLEAR_NAME ?></button>
			<?php echo Form::close(); ?>
			<ul>
				<li>1回のアップロード最大数は10枚です。</li>
				<li>アップロードされたファイルは保存されません。</li>
				<li>iPhone/iPadは、ファイルアップロード時にブラウザで位置情報が削除（仕様）されます。PCに保存し、ＰＣからアップロードしてください。</li>
			</ul>
		</div>
		<div class="col-md-8">
			<h2>結果</h2>
			<?php
			echo isset($message) ? '<p class="text-danger">'.$message.'</p>' : '';
			echo empty($results['items']) ? '<p class="text-danger">位置情報のある写真はありません。</p>' : '<p class="text-primary">位置情報の処理結果は'.count($results['items']).'件です。</p>';
			?>
			<!--map-->
			<div id="map" style="width:100%; height:<?php echo empty($results['items']) ? '0px' : '320px'; ?>"></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
					<thead>
					<tr class="success">
						<th>
							<small>画像</small>
						</th>
						<th>
							<small>ファイル名</small>
						</th>
						<th>
							<small>住所</small>
						</th>
						<th>
							<small>方角</small>
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (!empty($results['items'])) {
						foreach ($results['items'] as $node) {
							echo '<tr id="'.$node['image_name'].'">';
							echo '<td><a href="#map_'.$node['image_name'].'"><img src="'.$node['image'].'"></a></td>';
							echo '<td><a href="#map_'.$node['image_name'].'">'.$node['image_name'].'</a></td>';
							echo '<td><a href="#map_'.$node['image_name'].'">'.$node['address'].'</a></td>';
							echo '<td><a href="#map_'.$node['image_name'].'">';
							echo isset($node['direction']) ? '<img src="'.$node['direction'].'"></a></td>' : '';
							echo '</a></td>';
							echo '</tr>';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>