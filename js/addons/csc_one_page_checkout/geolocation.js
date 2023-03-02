var selected_location = {lat : -34.397, lng : 150.644};
var is_selected_location = false;
var location_map, markerCenter, opc_search_input;

var componentForm = {
  street_number: 'short_name',
  route: 'short_name',
  locality: 'long_name',
  administrative_area_level_1: 'long_name',
  country: 'short_name',
  postal_code: 'short_name'
};

$(document).on("click", '.opc_open_map', function(){
	$.toggleStatusBox('show', {overlay: null});
	$('#opc_gmap_location').ceDialog('open', 
		{
			title:opc_map_title,
			keepInPlace:false,
			nonClosable:false
		}
	);		
	// Try HTML5 geolocation.	
	if (navigator.geolocation && !is_selected_location) {
	  navigator.geolocation.getCurrentPosition(function(position) {		
		selected_location.lat = position.coords.latitude;
		selected_location.lng = position.coords.longitude;		
		fn_opc_init_google_gmap(selected_location);
		$.toggleStatusBox('hide', {overlay: null});	
	  }, function() {
		 fn_opc_init_google_gmap(selected_location);
		 $.toggleStatusBox('hide', {overlay: null});
	  });
	} else {
	   fn_opc_init_google_gmap(selected_location);
	   $.toggleStatusBox('hide', {overlay: null});	
	}
	
});

$(document).on("click", '.opc_apply_icon', function(){
	$.toggleStatusBox('show', {overlay: null});	
	geocoder = new google.maps.Geocoder;						  
	geocoder.geocode({'address': $('#pac-input').val()}, function(res, status) {						 
		if (status === 'OK') {
		  if (res[0]) {			  
			  fn_opc_fill_addresses_fields(res[0]);
		  } else {								  
		  }
		} else {
		  window.alert('Geocoder failed due to: ' + status);
		}
	});						  
    $('#tbw-elm_autosuggestion').val($('#pac-input').val());
	$.ceDialog('get_last').ceDialog('close');
	$.toggleStatusBox('hide', {overlay: null});	
});

$(document).on("click", '.opc_find_my_location', function(){
	$.toggleStatusBox('show', {overlay: null});	
	if ("geolocation" in navigator) {
		navigator.geolocation.getCurrentPosition(function(position) {											 
			pos = {
			  lat: position.coords.latitude,
			  lng: position.coords.longitude
			};			  
			 geocoder = new google.maps.Geocoder();
				geocoder.geocode({
					'latLng': pos
				  }, function (results, status) {
					if (status === google.maps.GeocoderStatus.OK) {
					  if (results[1]) {						  
						  geocoder = new google.maps.Geocoder;						  
						  geocoder.geocode({'address': results[1]['formatted_address']}, function(res, status) {				 
							  if (status === 'OK') {
								if (res[0]) {									
									fn_opc_fill_addresses_fields(res[0]);
									$.toggleStatusBox('hide', {overlay: null});
								} else {
									$.toggleStatusBox('hide', {overlay: null});								  
								}
							  } else {
								window.alert('Geocoder failed due to: ' + status);
								$.toggleStatusBox('hide', {overlay: null});
							  }
						  });						  
						$('#tbw-elm_autosuggestion').val(results[1]['formatted_address']);						
					  } 
					} 
				  });													  
		   
		}, function(){ 
				alert('No have access to geolocation service on your Browser');
				$.toggleStatusBox('hide', {overlay: null});		
			}
		);
	  }
});

function fn_opc_init_google_gmap(selected_location){	
	location_map = new google.maps.Map(document.getElementById("opc_gmap"), {
		center: selected_location,
		zoom: 14,
		maxZoom: 19,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl: true,
		mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.LEFT_BOTTOM
        },

		streetViewControl: false,
		fullscreenControl: false				
	});
	
	markerCenter = new google.maps.Marker({
		  position: new google.maps.LatLng(selected_location),
		  title: 'Current Location',
		  map: location_map,
		  draggable: true,
		  icon:' ',
		 label: {
			fontFamily: 'one_page_checkout',
        	text: '\ue804',
			color: '#0075D2',
			fontSize: "32px"
		}
	 });	 
	 google.maps.event.addListener(markerCenter,'dragend', (function(){ 		 
		  location_map.panTo(markerCenter.position);
		  fn_set_marker_and_map_position(markerCenter.position); 			
	  }));
	
	  //add search icon	
	    var search_iconDiv = document.createElement('div');		
		var search_icon = document.createElement('div');
		search_icon.className = 'search_icon';
		search_iconDiv.appendChild(search_icon);
		search_iconDiv.style.zIndex=1;
    	location_map.controls[google.maps.ControlPosition.TOP_LEFT].push(search_iconDiv);
		 
		//add apply btn	
	    var apply_iconDiv = document.createElement('div');		
		var apply_icon = document.createElement('div');
		apply_icon.className = 'opc_apply_icon  cm-tooltip';
		apply_icon.setAttribute('title', opc_langvar_apply_location);		
		apply_iconDiv.appendChild(apply_icon);
		apply_iconDiv.style.zIndex=1;
    	location_map.controls[google.maps.ControlPosition.TOP_RIGHT].push(apply_iconDiv);
	   
	  
	  //Add custom button to find user location
	  var centerControlDiv = document.createElement('div');	  
	  var centerControl = new fn_CenterControl(centerControlDiv);
	  centerControlDiv.index = 1;	 
	  location_map.controls[google.maps.ControlPosition.TOP_RIGHT].push(centerControlDiv);	 
	  fn_set_location_search_input(location_map, markerCenter);
	  //Fill found user address	  
	  fn_set_marker_and_map_position(markerCenter.position); 
}

function fn_csgmap_set_input_adress(markerCenter){
	
	geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		'latLng': markerCenter.position
	}, function (results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
		  if (results[1]) {			  
			$(opc_search_input).val(results[1]['formatted_address']);
		  } 
		} 
	});
}

function fn_set_location_search_input(location_map, markerCenter){
	opc_search_input = document.createElement("input");
	opc_search_input.type = "text";
	opc_search_input.setAttribute("id", "pac-input");	
	opc_search_input.className = "control";
	var searchBox = new google.maps.places.SearchBox(opc_search_input);
	location_map.controls[google.maps.ControlPosition.TOP_LEFT].push(opc_search_input);	

	// Bias the SearchBox results towards current map's viewport.
	location_map.addListener('bounds_changed', function() {
	  searchBox.setBounds(location_map.getBounds());	  
	});	
	searchBox.addListener('places_changed', function() {
		  var places = searchBox.getPlaces();	
		  if (places.length == 0) {
			return;
		  }	
		  // For each place, get the icon, name and location.
		  var bounds = new google.maps.LatLngBounds();
		  places.forEach(function(place) {
			  if (!place.geometry) {
				console.log("Returned place contains no geometry");
				return;
			  }
			  fn_set_marker_and_map_position(place.geometry.location);			 
		});		
	});
	return true;
}

function fn_CenterControl(controlDiv) {       
  var controlUI = document.createElement('div');       
  controlUI.className = 'find_me cm-tooltip';
  controlUI.setAttribute('title', opc_langvar_find_my_address);	      
  controlDiv.appendChild(controlUI);       
  controlUI.addEventListener('click', function() {
	  $.toggleStatusBox('show', {overlay: null});	
	  if ("geolocation" in navigator) {
		navigator.geolocation.getCurrentPosition(function(position) {											 
			pos = {
			  lat: position.coords.latitude,
			  lng: position.coords.longitude
			};
			fn_set_marker_and_map_position(pos);
			$.toggleStatusBox('hide', {overlay: null});								  
		   
		}, function(){ 
			alert('No have access to geolocation service on your Browser');
			$.toggleStatusBox('hide', {overlay: null});	
		}
		);
	  }else{
		  fn_set_marker_and_map_position(selected_location);
		  $.toggleStatusBox('hide', {overlay: null});	
	  }
  });
}

function fn_set_marker_and_map_position(pos){
	markerCenter.setPosition(pos);
	if (fn_opc_isFunction(pos.lat)){
		selected_location = {lat:pos.lat(), lng:pos.lng()};
	}else{
		selected_location = pos;
	}
	is_selected_location=true;
	location_map.panTo(pos);  	
	fn_csgmap_set_input_adress(markerCenter);	
}

function fn_opc_fill_addresses_fields(place){
	place.address_components = place.address_components.reverse(); 
	var address, city, country, zipcode, state, state_short;
    //var state = $("select[name*='s_state']").find('option:selected').text();
    for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];		
		if (componentForm[addressType]) {
		  var val = place.address_components[i][componentForm[addressType]];
		  if (addressType=="postal_code"){
			  zipcode =val; 
		  }
		  if (addressType=="country"){
			  country=val; 
		  }
		  if (addressType=="administrative_area_level_1"){
			  state=val;
			  state_short=place.address_components[i].short_name;
		  }
		  if (addressType=="locality"){
			  city=val; 
		  }
		   if (addressType=="route"){
			  address=val;			   
		  }
		  if (addressType=="street_number"){			  
			  address = address + " " + val;			 
		  }
	  }
  }
  
  
  if (country){
  	$("select[name*='b_country'],select[name*='s_country']").val(country).change();
  }			
  if (city){
	  $("input[name*='b_city'],input[name*='s_city']").val(city);
  }else{
	   $("input[name*='b_city'],input[name*='s_city']").val('');
   } 
  if (zipcode){
	  $("input[name*='b_zipcode'],input[name*='s_zipcode']").val(zipcode);
  }else{
	   $("input[name*='b_zipcode'],input[name*='s_zipcode']").val('');
  }	

  if (!state || state=="undefined"){	  
	state=city;  		  
  }
  fn_gopc_select_region(state, state_short,  's');

  if (address){
	  $("input[name*='b_address]'],input[name*='s_address]']").val(address);
  }else{
	  $("input[name*='b_address]'],input[name*='s_address]']").val('');
	}					
  fn_cs_update_profile(0, true);
}

function fn_gopc_select_region(state, state_short, prefix){	
	if (state){		
		fn_gopc_region_selection(state, state_short, 's');
		fn_gopc_region_selection(state, state_short, 'b');			
	}
	return true;
}

function fn_gopc_region_selection(state, state_short, prefix){
	var opc_region_selected = false;	
	if ($("input[name*='"+prefix+"_state']:enabled").length){
		$("input[name*='"+prefix+"_state']").val(state);	
	}else{
		$("select[name*='"+prefix+"_state']").prop("selected", false);
		$("select[name*='"+prefix+"_state'] option").filter(function() {				
			if (~this.text.indexOf(state)){
				opc_region_selected = true;			
				return true;
			}
			return false;				
		}).attr('selected', true);
		if (!opc_region_selected){				
			$("select[name*='"+prefix+"_state']").val(state_short);	
		}	
	}
}

function fn_opc_isFunction(functionToCheck) {
 return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
}
