<?php $this->pageTitle=Yii::app()->name; ?>

<script type="text/javascript">
$(function(){

	var geocoder;
	var map;

	function getLatLng() {
		var latlng=map.getCenter();
		$('#geolat').val(latlng.lat());
		$('#geolng').val(latlng.lng());
	}
	
	function initializeMap() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(48.86, 2.335);
		var mapOptions = {
			zoom: 13,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		getLatLng();
	}

	function getHerePosition() {
		if(navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = new google.maps.LatLng(	position.coords.latitude,
													position.coords.longitude);
				showMeThere(pos);
	          }, function() {
	            handleNoGeolocation(true);
	          });
	     } else {
			// Browser doesn't support Geolocation
			handleNoGeolocation(false);
		}
	}

	function handleNoGeolocation(supported) {
		$.pnotify({
			title: 'Localisation impossible !',
			text: (supported?'Accès non autorisé':'Non supporté par votre navigateur')
		});
	}
	
	function codeAddress() {
		var address = document.getElementById("address").value;
		geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			showMeThere(results[0].geometry.location);
		} else {
			alert("Geocode was not successful for the following reason: " + status);
		}
		});
	}

	function showMeThere(pos) {
		var marker = new google.maps.Marker({
			map: map,
			position: pos,
			animation: google.maps.Animation.DROP,
			title:"Here !"
		});
		map.setCenter(pos);
		getLatLng();
	}

	initializeMap();
	$('#geocode_button').click(codeAddress);
	if(navigator.geolocation) {
		$('#geocode_here').show();
		$('#geocode_here').click(getHerePosition);
	}
	$('#address').bind('keyup',function(e) {
		if(e.keyCode==13){
			codeAddress();
			return false;
		}
	});
	$('form').submit(function(){return false});
	 
});

</script>

<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name); ?></h1>

<form>
<input type="text" id="address" value="">
<input type="button" id="geocode_button" value="Geocode">
<input type="button" id="geocode_here" value="Here">
</form>

<div id="map_canvas" style="width: 1000px; height: 800px;"></div>

<input type="text" id="geolat" value="">
<input type="text" id="geolng" value="">