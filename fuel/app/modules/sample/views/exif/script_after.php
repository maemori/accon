<script>
	// アタッチメント
	function attachMessage(marker, msg) {
		google.maps.event.addListener(marker, 'click', function (event) {
			new google.maps.InfoWindow({content: msg}).open(marker.getMap(), marker);
			map.setZoom();
			map.setCenter(marker.getPosition());
		});
	}
	// マーカー用データの生成
	var data = new Array();
	<?php
		if (!empty($results['items']))
		{
			foreach ($results['items'] as $node)
			{
				echo 'data.push({'
						.'position: new google.maps.LatLng('.$node['latitude'].', '.$node['longitude'].'), '
						 .'content: '
							 .'\'<div class="google_map_attach"">'
								 .'<a href="#'.$node['image_name'].'" id="map_'.$node['image_name'].'">'
									 .'<b class="google_map_attach_str">'.$node['image_name'].'</b><br/>'
									 .$node['address']
								.'</a>'
							.'</div>\','
						 .'icon_image: \''.$node['image'].'\''
				.'});';
			}
		}
	?>
	var myMap = new google.maps.Map(document.getElementById('map'), {
		zoom: <?php echo !empty($results['zoom_level']) ? $results['zoom_level'] : '18';?>,// 地図縮尺
		<?php
			if (!empty($results['items']))
			{
				// 地図の中心点
				echo'center: new google.maps.LatLng('.$results['latitude_position'].', '.$results['longitude_position'].'),';
			}
		?>
		// マウスホイールを使ったズームレベルの変更
		scrollwheel: true,
		// マップタイプは通常の市街地図を表示
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE
		}
	});
	// マーカー生成
	for (i = 0; i < data.length; i++) {
		var myMarker = new google.maps.Marker({
			position: data[i].position,
			map: myMap,
			zIndex: i,
			icon: {
				size: new google.maps.Size(220, 220),
				origin: new google.maps.Point(0, 0),
				url: data[i].icon_image,
				anchor: new google.maps.Point(16, 16)
			}
		});
		attachMessage(myMarker, data[i].content);
	}
	// geo location
	function startFunc() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
		} else {
			document.getElementById("geo").innerHTML = "Geolocationが利用できません";
		}
	}
	function successCallback(position) {
		//成功したときの処理
		latitude = position.coords.latitude; // 北緯
		longitude = position.coords.longitude; // 東経
		result = '<div class="form-group location">';
		result += '<label class="col-sm-1 control-label small">北緯</label>';
		result += '<div class="col-sm-5">';
		result += '<input type="test" id="latitude" name="latitude" class="form-control input-sm small" value="' + latitude + '" readonly>';
		result += '</div>';
		result += '<label class="col-sm-1 control-label small">東経</label>';
		result += '<div class="col-sm-5">';
		result += '<input type="test" id="longitude" name="longitude" class="form-control input-sm small" value="' + longitude + '" readonly>';
		result += '</div>';
		result += '</div>';
		document.getElementById("geo1").innerHTML = result;
		document.getElementById("geo2").innerHTML = result;
	}
	function errorCallback(error) {
		//失敗のときの処理
		document.getElementById("geo1").innerHTML = 'Geolocationが利用できません';
		document.getElementById("geo2").innerHTML = 'Geolocationが利用できません';
	}
	// geo location On/Off
	$('.btn-toggle').click(function () {
		$(this).find('.btn').toggleClass('active');
		if ($(this).find('.btn-primary').size() > 0) {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		if ($(this).find('.btn-danger').size() > 0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		if ($(this).find('.btn-success').size() > 0) {
			$(this).find('.btn').toggleClass('btn-success');
		}
		if ($(this).find('.btn-info').size() > 0) {
			$(this).find('.btn').toggleClass('btn-info');
		}
		$(this).find('.btn').toggleClass('btn-default');
		if ($(this).find('.btn.active').text() == 'ON') {
			startFunc();
		} else {
			document.getElementById("geo1").innerHTML = '';
			document.getElementById("geo2").innerHTML = '';
		}
	});
</script>