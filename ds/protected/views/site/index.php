<?php $this->pageTitle=Yii::app()->name; ?>

<script type="text/javascript">
$(function(){

	var geocoder;
	var map;
	var refMarker;
	var placesMarkers;
	var placesData;

	function getLatLng() {
		var latlng=map.getCenter();
		$('#geolat').val(latlng.lat());
		$('#geolng').val(latlng.lng());
	}
	
	function initializeMap() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(48.86, 2.335);
		var styles = [
		  {
		    "featureType": "landscape.man_made",
		    "elementType": "geometry.fill",
		    "stylers": [
		      { "visibility": "simplified" }
		    ]
		  },{
		    "featureType": "road",
		    "stylers": [
		      { "hue": "#00ccff" }
		    ]
		  },{
		    "featureType": "poi.business",
		    "elementType": "geometry",
		    "stylers": [
		      { "visibility": "off" }
		    ]
		  }
		];
		var mapOptions = {
			zoom: 13,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			styles: styles
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
		if(refMarker != null){
			refMarker.setMap(null);
			refMarker = null;
		}
		var address = document.getElementById("address").value;
		if(isArea(address)){
			showMeZone(address);
		}
		else{
			geocoder.geocode( {
				'address': address,
				'region': 'fr'
			}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				showMeThere(results[0].geometry.location);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
		}
	}

	function isArea(address){
		if(/^\s*[0-9]+\s*$/.test(address) || /^\s*paris\s+[0-9]+$/i.test(address) || /^\s*paris\s*$/i.test(address)){
			return true;
		}
		return false;
	}

	function showMeThere(pos) {
		if(refMarker == null){
			refMarker = new google.maps.Marker({
				map: map,
				title:"Here !",
				icon:{
				    path: google.maps.SymbolPath.CIRCLE,
				    scale: 4,
				    fillColor: 'red',
				    strokeColor: 'red'
				}
			});
		}
		refMarker.setPosition(pos);
		refMarker.setAnimation(google.maps.Animation.DROP)
		map.setCenter(pos);
		getLatLng();
		$.getJSON('http://localhost:3000/place/nearby/ll/'+pos.lat()+','+pos.lng(), function(placesData, textStatus){
			showPlaces(placesData);
			//autoZoom();
		});
		/*
		$.getJSON('/ds/index.php?r=place/nearby/ll/'+pos.lat()+','+pos.lng(), function(placesData, textStatus){
			showPlaces(placesData);
			//autoZoom();
		});
		*/
	}

	function showMeZone(zone){
		var zonematch;
		if(/^\s*paris\s*$/i.exec(zone)){
			zone = '75';
		}
		if(zonematch = /^\s*paris\s+([0-9]+)$/i.exec(zone)){
			zone = '750';
			if(zonematch[1]>9){
				zone += zonematch[1];
			}
			else{
				zone += '0'+zonematch[1];
			}
		}
		if(!/^\s*[0-9]+\s*$/.test(zone)){
			return;
		}
		$.getJSON('http://localhost:3000/place/area/zip/'+zone, function(placesData, textStatus){
			showPlaces(placesData);
			//autoZoom();
		});
		/*
		$.getJSON('/ds/index.php?r=place/zone/zip/'+zone, function(placesData, textStatus){
			showPlaces(placesData);
			//autoZoom();
		});
		*/
	}

	function showPlaces(_placesData){
		if(placesMarkers != null){
			for(var m=0 ; m<placesMarkers.length ; m++){
				placesMarkers[m].setMap(null);
			}
		}
		placesData = _placesData;
		var maxProviders = placesData['providers'].length;
		var places = placesData['data'];
		autoZoom();
		placesMarkers = [];
		// min=25 | max=200 | floor=25
		var lapse=30;
		if(places.length<30){
			lapse+=175*(30-places.length)/30;
		}
		for(var p=0 ; p<places.length ; p++){
			var place=places[p];
			(function(_place, _maxProviders, _p){
				setTimeout(function(){
					showMarker(_place, _maxProviders);
				}, 200+_p*lapse);
			})(place, maxProviders, p);
		}
	}

	function showMarker(place, maxProviders){
		var marker = new google.maps.Marker({map: map, title: place.name});
		var opacity=.2;
		if(place.providers){
			opacity += .8*place.providers.length/maxProviders
		}
		marker.setIcon({
			path: google.maps.SymbolPath.CIRCLE,
		    scale: 5,
		    strokeOpacity: opacity,
		    fillColor: 'black',
		    strokeColor: 'black'
		})
		marker.setPosition(new google.maps.LatLng(place.lat, place.lng));
		marker.setAnimation(google.maps.Animation.DROP);
		placesMarkers.push(marker);
	}

	function autoZoom(){
		if(placesData == null || Number(placesData['count'])==0){
			return;
		}
		var bounds = new google.maps.LatLngBounds();
		if(refMarker != null){
			bounds.extend(refMarker.getPosition());
		}
		var places = placesData['data'];
		for(var m=0 ; m<places.length ; m++){
			var place = places[m];
			bounds.extend(new google.maps.LatLng(place.lat, place.lng));
		}
		map.fitBounds(bounds);
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

<div id="map_canvas" style="width: 100%; height: 700px;"></div>

<input type="text" id="geolat" value="">
<input type="text" id="geolng" value="">