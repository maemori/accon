<div id ="menu_items"></div>
<script>
	/**
	 * 公開されているメニューのリストを取得
	 */
	$(document).ready(function () {
		$.ajax({
			type: "GET",
			url: "/menus/ajax/menu/items.html",
			dataType: 'html'
		}).success(function(response){
//				console.log(response);
			$('#menu_items').append(response);
		});
	});
</script>