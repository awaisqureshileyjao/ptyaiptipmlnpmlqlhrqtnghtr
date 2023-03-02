function fn_csc_calculate_total_shipping_cost(){
	params = [];
    parents = Tygh.$('#shipping_rates_list');
    radio = Tygh.$('input[type=radio]:checked', parents);

    Tygh.$.each(radio, function(id, elm) {
        params.push({
			name: elm.name, value: elm.value});
    });

    url = fn_url('checkout.checkout');

    for (var i in params) {
        url += '&' + params[i]['name'] + '=' + escape(params[i]['value']);
    }
	$('.cs-one-page-checkout').addClass('loading');
    Tygh.$.ceAjax('request', url, {
        result_ids: 'checkout*',
        method: 'get',
        full_render: true,
		callback: function(data) {
			  $('.cs-one-page-checkout').removeClass('loading');
				try{
					window[cscAutocompleteFunction]();
				}catch(e){
					console.log(e);
				}
		  }
    });
}
$(document).on('click', "input[name='ship_to_another']", function(){
	fn_cs_update_profile(0, false);			
});


$(document).on('change', '.copc-cm-phone .tbwfields-input input', function(e){
	fn_cs_update_profile(0, false);
});

var csc_timeout='';
$(document).on('change', '.cm-location-fields input, .cm-copc-location input', function(e){
	if ($(this).attr('id')!='tbw-elm_autosuggestion'){		
		fn_cs_update_profile(0, true);
	}
	
});
$(document).on('change', '.cm-location-fields select, .cm-copc-location select', function(e){	
	
	if (e.isTrigger){
		return true;
	}
	fn_cs_update_profile(0, true);	
});

$(document).on('change', '.csc_delivery_block div.cs_custom_field:not(.cm-copc-location) input', function(e){	
	fn_cs_update_profile(0, false);
});
$(document).on('change', '.ty-customer-notes__text', function(e){	
	fn_cs_update_profile(0, false);
});
$(document).on('change', '.csc_delivery_block div.cs_custom_field:not(.cm-copc-location) select', function(e){	
	if (e.isTrigger==true){
		return true;
	}
	fn_cs_update_profile(0, false);
});

$(document).on('keydown', '#copc_one_page_checkout input', function(ev) {	
	if(ev.which === 13) {		
		$(this).blur();
        return false;
    }
});
$(document).on('change', '.copc-cm-phone input', function(e){
	id = $(this).attr('id').replace('tbw-','');
	$("#"+id).val($(this).val());	
});

function fn_cs_update_profile(timeout, check_result_ids){
	clearTimeout(csc_timeout);
	csc_timeout = setTimeout(function(){
		params = [];
		parents = Tygh.$('.csc_main_form');
		input = Tygh.$('input[type=text]:enabled, input[type=tel]:enabled', parents);	
		Tygh.$.each(input, function(id, elm) {
			params.push({
				name: elm.name, value: elm.value});
		});
		sel = Tygh.$('select:enabled', parents);		
		Tygh.$.each(sel, function(id, elm) {			
			params.push({
				name: elm.name, value: elm.value});
		});		
		params.push({
			name: 'customer_notes', value: $('.ty-customer-notes__text').val()
		});
		ship_to_another = $('input[type=hidden][name=ship_to_another]').val();		
		if ($('input[type=radio][name=ship_to_another]:checked').length){
			ship_to_another = $('input[type=radio][name=ship_to_another]:checked').val();			
		}
		
		params.push({
			name: 'ship_to_another', value: ship_to_another
		});	
		
		url = fn_url('checkout.save_user_data');	
		for (var i in params) {
			url += '&' + params[i]['name'] + '=' + encodeURIComponent(params[i]['value']);
		}
		if (check_result_ids){
			result_ids='copc_one_page_checkout,checkout_info*,tygh_shipping*';
			full_render=true;
			hidden=false;
			$('.cs-one-page-checkout').addClass('loading');
		}else{
			result_ids='no_need';
			full_render=false;
			hidden=true;
		}
	
		Tygh.$.ceAjax('request', url, {
			result_ids: result_ids,
			method: 'post',
			full_render: full_render,
			hidden:hidden,
			data:{hidden:hidden},
			callback: function(data) {				
				$('.cs-one-page-checkout').removeClass('loading');				
				try{					
					window[cscAutocompleteFunction]();					
				}catch(e){
					console.log(e);
				}
			}
		});
	}, timeout);
}