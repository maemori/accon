<ul id="menus_list" class="nav navbar-nav">
</ul>
<script>
	/**
	 * 公開されているメニューのリストを取得
	 */
	$(document).ready(function () {
		$.ajax({
			type: "GET",
			url: "/menus/ajax/menu/list.html",
			dataType: 'html'
		}).success(function(response){
//				console.log(response);
			$('#menus_list').append(response);
		});
	});
</script>
