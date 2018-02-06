$(document).ready(function(){
	$(".button-collapse").sideNav();
})

var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
	  center: {lat: 43.1293659, lng: -77.6394728},
	  zoom: 25,
	  mapTypeId: 'satellite',
	  mapTypeControl: false,
	  streetViewControl: false
	});
	map.setTilt(45);
	
	//var image = path/to/image;
	var marker = new google.maps.Marker({
	  position: {lat: 43.1293659, lng: -77.6394728},
	  map: map,
	  animation: google.maps.Animation.DROP,
	  title: "Hello World!"
	  //icon: image
	});

	var infoWindow = new google.maps.InfoWindow;

	// Try HTML5 geolocation.
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(function(position) {
		var pos = {
		  lat: position.coords.latitude,
		  lng: position.coords.longitude
		};

		infoWindow.setPosition(pos);
		infoWindow.setContent('Location found.');
		infoWindow.open(map);
		map.setCenter(pos);
		console.log(pos);
	  }, function() {
		handleLocationError(true, infoWindow, map.getCenter());
	  });
	} else {
	  // Browser doesn't support Geolocation
	  handleLocationError(false, infoWindow, map.getCenter());
	}
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(browserHasGeolocation ?
					  'Error: The Geolocation service failed.' :
					  'Error: Your browser doesn\'t support geolocation.');
infoWindow.open(map);
}
