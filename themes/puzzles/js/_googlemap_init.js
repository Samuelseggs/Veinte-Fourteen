// Init Google map
var THEMEREX_googlemap_init_obj = {
	map: null,
	dom: null,
	opt: null,
	address: null,
	latlng: null,
	point: null,
	description: null
}
function googlemap_init(dom_obj, coords, description, point) {
	"use strict";
	try {
		if (coords.latlng!=='') {
			var latlngStr = coords.latlng.split(',');
			var lat = parseFloat(latlngStr[0]);
			var lng = parseFloat(latlngStr[1]);
			var latlng = new google.maps.LatLng(lat, lng);
		} else
			var latlng = new google.maps.LatLng(0, 0);
		THEMEREX_googlemap_init_obj.dom = dom_obj;
		THEMEREX_googlemap_init_obj.point = point;
		THEMEREX_googlemap_init_obj.description = description;
		THEMEREX_googlemap_init_obj.opt = {
			zoom: coords.zoom,
			center: latlng,
			scrollwheel: true,
			scaleControl: false,
			disableDefaultUI: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var custom_map = new google.maps.Geocoder();
		
		custom_map.geocode(coords.latlng!=='' ? {'latLng': latlng} : {"address": coords.address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				THEMEREX_googlemap_init_obj.address = results[0].geometry.location;
				googlemap_create();
			} else
				alert(THEMEREX_GEOCODE_ERROR + ' ' + status);
		});
		jQuery(window).resize(function() {
			if (THEMEREX_googlemap_init_obj.map) THEMEREX_googlemap_init_obj.map.setCenter(THEMEREX_googlemap_init_obj.address);
		});
	} catch (e) {
		//alert(THEMEREX_GOOGLE_MAP_NOT_AVAIL);
	};
}

function googlemap_create() {
	"use strict";
	if (!THEMEREX_googlemap_init_obj.address) return false;
	THEMEREX_googlemap_init_obj.map = new google.maps.Map(THEMEREX_googlemap_init_obj.dom, THEMEREX_googlemap_init_obj.opt);
	THEMEREX_googlemap_init_obj.map.setCenter(THEMEREX_googlemap_init_obj.address);
	var marker = new google.maps.Marker({
		map: THEMEREX_googlemap_init_obj.map,
		icon: THEMEREX_googlemap_init_obj.point,
		position: THEMEREX_googlemap_init_obj.map.getCenter()
	});
	var infowindow = new google.maps.InfoWindow({
		content: THEMEREX_googlemap_init_obj.description
	});
	google.maps.event.addListener(marker, "click", function() {
		infowindow.open(THEMEREX_googlemap_init_obj.map, marker);
	});
}

function googlemap_refresh() {
	"use strict";
	googlemap_create();	
}
