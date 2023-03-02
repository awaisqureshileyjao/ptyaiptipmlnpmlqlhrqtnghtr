$(document).ready(function(){
	fn_csc_init_google_Autocomplete();
});

var cscAutocompleteFunction='fn_csc_init_google_Autocomplete';
var placeSearch, autocomplete, opc_autocomplete;

function fn_csc_init_google_Autocomplete() {
	try {
	    fn_csc_run_autocomplete();	
	} catch (err) {	  
		$.getScript('https://maps.googleapis.com/maps/api/js?key='+opc_api_key+'&libraries=places&callback=fn_csc_init_google_Autocomplete&language='+Tygh.cart_language, function() {	
			fn_csc_run_autocomplete();	  
		});
	}	
}

function fn_csc_run_autocomplete(){
	$('#tbw-elm_autosuggestion').attr('placeholder', '');
    $("#tbw-elm_autosuggestion").attr('onFocus', "fn_opc_geolocate()");
	$(".pac-container").remove();
	try{
		google.maps.event.removeListener(opc_autocompleteLsr);
		google.maps.event.clearInstanceListeners(autocomplete);		
	}catch(err){		
	}
	
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('tbw-elm_autosuggestion')),
		{types: ['geocode']});
	// When the user selects an address from the dropdown, populate the address fields in the form.
	opc_autocompleteLsr = autocomplete.addListener('place_changed', fn_opc_fillInAddress);
}

function fn_opc_fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();  
  fn_opc_fill_addresses_fields(place);
}
function fn_opc_geolocate() {
  if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
	  var geolocation = {
		lat: position.coords.latitude,
		lng: position.coords.longitude
	  };
	  var circle = new google.maps.Circle({
		center: geolocation,
		radius: position.coords.accuracy
	  });
	  autocomplete.setBounds(circle.getBounds());
	});
  }
}


