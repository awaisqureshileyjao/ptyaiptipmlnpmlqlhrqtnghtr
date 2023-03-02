var cscAutocompleteFunction='fn_opc_init_dadata_fields';

$("<link/>", {
   rel: "stylesheet",
   type: "text/css",
   href: "https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/css/suggestions.min.css"
}).appendTo("head");

$(document).ready(function(){
	fn_opc_init_dadata();
});

(function(_, $){	
	$(document).on('click', "input[name='ship_to_another']", function(){
		fn_opc_init_dadata();		   
	});	
})(Tygh, Tygh.$);


function fn_opc_init_dadata(){	
	$.getScript('https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js', function() {});	
	$.getScript('https://cdn.jsdelivr.net/npm/suggestions-jquery@18.11.1/dist/js/jquery.suggestions.min.js', function() {
		fn_opc_init_dadata_fields(); 
	});
}

function fn_opc_init_dadata_fields(){	
	$("#tbw-elm_autosuggestion").suggestions({
		token: opc_api_key,
		type: "ADDRESS",
		count: 5,
		scrollOnFocus: false,
		/* Вызывается, когда пользователь выбирает одну из подсказок */
		onSelect: function(suggestion) {
			var data = suggestion.data;
			$("select[name*='b_country'],select[name*='s_country']").val("RU").change();
			
			var city  = fn_opc_city_formatSelected(suggestion);						
			if (city){
				$("input[name*='b_city'],input[name*='s_city']").val(city);
			}			
			
			if (data.postal_code!= null){
				$("input[name*='b_zipcode'],input[name*='s_zipcode']").val(data.postal_code);
			}						
			fn_opc_select_region(data, null);
						
			var address=opc_makeAddressString(data);				
			if (address){
				$("input[name*='b_address]'],input[name*='s_address]']").val(address);
			}							
			fn_cs_update_profile(0, true);	
		}
	});	
	$("input[name*='b_firstname'],input[name*='s_firstname'],input[name*='b_lastname'],input[name*='s_lastname']").suggestions({
		token: opc_api_key,
		type: "NAME",
		count: 5,
		scrollOnFocus: false,		
		onSelect: function(suggestion) {
			fn_cs_update_profile(0, false);	
		}
	});
	
	//SELECT city by geolocation
	/*$("input[name*='s_city']:visible,input[name*='b_city']:visible").suggestions().getGeoLocation().done(function(locationData) {	  
	});*/
	
	fn_opc_dadata_init_city('s');
	fn_opc_dadata_init_city('b');
	
	fn_opc_dadata_init_address('s');
	fn_opc_dadata_init_address('b');	
}

function fn_opc_dadata_init_city(type){
	$("input[name*='"+type+"_city']").suggestions({
		token: opc_api_key,
		type: "ADDRESS",
		scrollOnFocus: false,
		bounds: {from_bound:"city",to_bound:"city"},
		count: 5,
		formatSelected: fn_opc_city_formatSelected,
		
		onSelect: function(suggestion) {				
			var data = suggestion.data;
			var prefix=type;										
			fn_opc_select_region(data, prefix);
			if (data.postal_code!= null && !$("input[name*='"+prefix+"_zipcode']").val()){
				$("input[name*='"+prefix+"_zipcode']").val(data.postal_code);
			}				
			if(jQuery.inArray($(this).attr('name').replace('user_data[', '').replace(']', ''), $.parseJSON(location_fields)) !== -1){	
				fn_cs_update_profile(0, true);
			}else{
				fn_cs_update_profile(0, false);
			}
		}
	});
}


function fn_opc_dadata_init_address(type){
	$("input[name*='" + type + "_address]']").suggestions({
		token: opc_api_key,
		type: "ADDRESS",
		bounds: {from_bound:"street", to_bound:"street"},
		count: 5,
		hint: false,
		scrollOnFocus: false,		
		formatSelected: opc_formatSelected,	
		constraints: {			
			label: "",
			locations: {				
				city: $("input[name*='" + type + "_city']:visible").val()
			  }
		},
		onSelect: function(suggestion) {					
			var data = suggestion.data;			
			var prefix=type;					
			var current_city = $("input[name*='"+prefix+"_city']").val();
			if ($("select[name*='"+prefix+"_country']").val()!="RU"){			
				$("select[name*='"+prefix+"_country']").val("RU").change();
			}
			var city  = fn_opc_city_formatSelected(suggestion);						
			if (city){
				$("input[name*='"+prefix+"_city']").val(city);
			}
				
			if (data.postal_code!= null){				
				$("input[name*='"+prefix+"_zipcode']").val(data.postal_code);				
			}
									
			fn_opc_select_region(data, prefix);
			
			if ((prefix=="s" && current_city!=city) || jQuery.inArray($(this).attr('name').replace('user_data[', '').replace(']', ''), $.parseJSON(location_fields)) !== -1 || (jQuery.inArray('s_zipcode', $.parseJSON(location_fields)) !== -1 && data.postal_code!= null)){				
				$("#tbw-elm_autosuggestion").val(suggestion.value);				
				fn_cs_update_profile(0, true);
			}else{
				fn_cs_update_profile(0, false);
			}
		}
	});
}



function fn_opc_select_region(data, prefix){
	if (data.region!= null){		
		if (prefix!=null){
			fn_opc_region_selection(data, prefix);
		}else{
			fn_opc_region_selection(data, 's');
			fn_opc_region_selection(data, 'b');
		}		
	}
	return true;
}

function fn_opc_region_selection(data, prefix){
	var opc_region_selected = false;
	$("select[name*='"+prefix+"_state']").prop("selected", false);
	$("select[name*='"+prefix+"_state'] option").filter(function() {				
		if (~this.text.indexOf(data.region)){
			opc_region_selected = true;
			return true;
		}
		return false;				
	}).attr('selected', true);
	if (!opc_region_selected){
		$("input[name*='"+prefix+"_state']").val(data.region_with_type);	
	}
}

function opc_formatSelected(suggestion){
  var addressValue = opc_makeAddressString(suggestion.data); 
  return addressValue;
}

function fn_opc_city_formatSelected(suggestion){	
	return opc_join([suggestion.data.city, suggestion.data.settlement]);
}

function opc_makeAddressString(address){
  return opc_join([
    address.street_with_type,
    opc_join([address.house_type, address.house,
          address.block_type, address.block], " "),
    opc_join([address.flat_type, address.flat], " ")	
  ]);
}

function opc_join(arr /*, separator */) {
  var separator = arguments.length > 1 ? arguments[1] : ", ";
  return arr.filter(function(n){return n}).join(separator);
}

