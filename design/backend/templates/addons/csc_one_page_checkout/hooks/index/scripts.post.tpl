<script type="text/javascript" >
var opc_pref = '#container_addon_option_csc_one_page_checkout_';

(function(_, $){
    $.ceEvent('on', 'ce.commoninit', function(context) {
		$('input[id^="addon_option_csc_one_page_checkout_clr"]:enabled').ceColorpicker();
		fn_copc_check_fields();	
	});
})(Tygh, Tygh.$);
$(document).on('change', '#addon_option_csc_one_page_checkout_shipping_methods_view', function(){
	fn_copc_check_fields();
});
$(document).on('change', '#addon_option_csc_one_page_checkout_payment_methods_view', function(){
	fn_copc_check_fields();
});

$(document).on('click', '.csc_one_page_checkout .cm-update-for-all-icon:not(.visible)', function(){	
	try {
		if (
		$('input[name="addon_data[options][' + $(this).data('caDisableId') + ']').attr('id').indexOf("one_page_checkout_clr")>=0){
			var item=$(this);
			$(item).hide();
			setTimeout(function(){
				$('input[name="addon_data[options][' + $(item).data('caDisableId') + ']').ceColorpicker();
			}, 100, item);
		}
	}catch{
	}
});

$(document).on('change', '#addon_option_csc_one_page_checkout_provider', function(){
	fn_copc_check_fields();
});




function fn_copc_check_fields(){
	//shippings fields
	$(opc_pref + 'clr_shipping_bg_default').show();
	$(opc_pref + 'clr_shipping_border_default').show();
	$(opc_pref + 'clr_shipping_bg_active').show();
	$(opc_pref + 'clr_shipping_border_active').show();	
	if($('#addon_option_csc_one_page_checkout_shipping_methods_view').val()=="simple_list"){
		$(opc_pref + 'clr_shipping_bg_default').hide();
		$(opc_pref + 'clr_shipping_border_default').hide();
		$(opc_pref + 'clr_shipping_bg_active').hide();
		$(opc_pref + 'clr_shipping_border_active').hide();		
	}
	if($('#addon_option_csc_one_page_checkout_shipping_methods_view').val()=="simple_list_radio"){		
		$(opc_pref + 'clr_shipping_border_default').hide();		
		$(opc_pref + 'clr_shipping_border_active').hide();		
	}
	
	//payments fields
	$(opc_pref + 'clr_payment_bg_default').show();
	$(opc_pref + 'clr_payment_border_default').show();
	$(opc_pref + 'clr_payment_bg_active').show();
	$(opc_pref + 'clr_payment_border_active').show();	
	if($('#addon_option_csc_one_page_checkout_payment_methods_view').val()=="simple_list"){
		$(opc_pref + 'clr_payment_bg_default').hide();
		$(opc_pref + 'clr_payment_border_default').hide();
		$(opc_pref + 'clr_payment_bg_active').hide();
		$(opc_pref + 'clr_payment_border_active').hide();		
	}
	if($('#addon_option_csc_one_page_checkout_payment_methods_view').val()=="simple_list_radio"){		
		$(opc_pref + 'clr_payment_border_default').hide();		
		$(opc_pref + 'clr_payment_border_active').hide();		
	}
	
	if ($('#addon_option_csc_one_page_checkout_provider').val()=="google"){
		$(opc_pref + 'google_geolocation_api_key').hide();
		$(opc_pref + 'api_key').show();
	}else if($('#addon_option_csc_one_page_checkout_provider').val()=="none"){
		$(opc_pref + 'google_geolocation_api_key').show();
		$(opc_pref + 'api_key').hide();		
	}else{
		$(opc_pref + 'google_geolocation_api_key').show();
		$(opc_pref + 'api_key').show();
	}
}

</script>