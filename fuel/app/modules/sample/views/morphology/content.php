<div class="container">
	<ul class="breadcrumb">
		<li><a href="/"><span class="glyphicon glyphicon-home"></span> ホーム</a></li>
		<li class="active"><span class="glyphicon glyphicon-list-alt"></span> サンプル</li>
		<li class="active"><span class="glyphicon glyphicon-cog"></span> <?php echo $title; ?></li>
		<li class="active"><a href="/sample/code/morphology"><span class="glyphicon glyphicon-pencil"></span> サンプルコード</a></li>
	</ul>
	<div class="row">
		<div class="col-md-4">
			<h2>入力</h2>
			<form class="form-group" method="post" action="<?php echo Uri::current(); ?>">
				<textarea name="input" rows="10" cols="31" class="form-control" maxlength="4000"><?php echo (!empty($input)) ? $input : ""; ?></textarea>
				<p>
					<button type="submit" name="processing" value="<?php echo SERVICE_CLEAR_KEY ?>" class="btn btn-default btn-xs btn-block btn-clear	"><?php echo SERVICE_CLEAR_NAME ?></button>
					<button type="submit" name="processing" value="<?php echo SERVICE_ROOT_KEY ?>" class="add-on btn btn-primary btn-lg btn-block"><?php echo SERVICE_ROOT_NAME ?></button>
				</p>
				<div class="text-center">
					<p class="btn-group btn-group-xx">
						<button type="submit" name="processing" value="<?php echo SERVICE_CHANGE_PERIOD_KEY ?>" class="btn btn-success"><?php echo SERVICE_CHANGE_PERIOD_NAME ?></button>
						<button type="submit" name="processing" value="<?php echo SERVICE_PUNCTUATION_REMOVE_KEY ?>" class="btn btn-success"><?php echo SERVICE_PUNCTUATION_REMOVE_NAME ?></button>
						<button type="submit" name="processing" value="<?php echo SERVICE_DELETE_SYMBOL_KEY ?>" class="btn btn-success"><?php echo SERVICE_DELETE_SYMBOL_NAME ?></button>
					</p>
				</div>
			</form>
			<ul>
				<li>最大文字数は4,000です。</li>
			</ul>
			<hr/>
			<h2>履歴</h2>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
					<thead>
					<tr class="success">
						<th>
							<small>時刻</small>
						</th>
						<th>
							<small>種類</small>
						</th>
						<th>
							<small>文章</small>
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (!empty($history)) {
						foreach ($history as $node) {
							echo '<tr>';
							echo '<td>'.$node['run_time'].'</td>';
							echo '<td>'.$node['type_name'].'</td>';
							echo '<td>'.$node['string'].'</td>';
							echo '</tr>';
						}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-8">
			<h2>結果</h2>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover table-condensed table-responsive">
					<thead>
					<tr class="success">
						<th>
							<small>単語</small>
						</th>
						<th>
							<small>有効</small>
						</th>
						<th>
							<small>結果</small>
						</th>
						<th>
							<small>品詞</small>
						</th>
						<th>
							<small>品詞細分類1</small>
						</th>
						<th>
							<small>品詞細分類2</small>
						</th>
						<th>
							<small>品詞細分類3</small>
						</th>
						<th>
							<small>活用形</small>
						</th>
						<th>
							<small>活用型</small>
						</th>
						<th>
							<small>原形</small>
						</th>
						<th>
							<small>読み</small>
						</th>
						<th>
							<small>発音</small>
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if (!empty($results)) {
						foreach ($results as $node) {
							echo '<tr class="'.($node['stat'] ? 'danger' : '').'">';
							echo '<td>'.$node['surface'].'</td>';
							echo '<td>'.($node['isbest'] == 1 ? 'Ｏ' : 'Ｘ').'</td>';
							echo '<td>'.($node['stat'] == 0 ? 'Ｏ' : 'Ｘ').'</td>';
							echo '<td>'.$node['part_apeech'].'</td>';
							echo '<td>'.$node['part_apeech_classify_1'].'</td>';
							echo '<td>'.$node['part_apeech_classify_2'].'</td>';
							echo '<td>'.$node['part_apeech_classify_3'].'</td>';
							echo '<td>'.$node['inflected'].'</td>';
							echo '<td>'.$node['use_type'].'</td>';
							echo '<td>'.$node['original'].'</td>';
							echo '<td>'.$node['reading'].'</td>';
							echo '<td>'.$node['pronunciation'].'</td>';
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