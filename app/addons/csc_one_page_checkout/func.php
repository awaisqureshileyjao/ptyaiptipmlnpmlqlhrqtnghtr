<?php
use Tygh\Registry;
use Tygh\Http;
if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_settings_variants_addons_csc_one_page_checkout_provider(){
	return array(
		'none'=>__('disabled'),
		'google'=>csc_one_page_checkout::_('R29vZ2xlIEF1dG9jb21wbGV0ZQ=='),		
		'dadata'=>'Dadata.ru'
	);
}

function fn_settings_variants_addons_csc_one_page_checkout_shipping_methods_view(){
	return array(
		'grid'=>__('tmpl_grid'),
		'list'=>__('list'),		
		'simple_list_radio'=>__('copc.simple_list_radio'),
		'simple_list'=>__('copc.simple_list'),
	);
}

function fn_settings_variants_addons_csc_one_page_checkout_payment_methods_view(){
	return array(
		'grid'=>__('tmpl_grid'),
		'list'=>__('list'),		
		'simple_list_radio'=>__('copc.simple_list_radio'),
		'simple_list'=>__('copc.simple_list'),
	);
}

function fn_settings_variants_addons_csc_one_page_checkout_title_font_size_weight(){
	return array(
		'bold'=>__('copc.bold'),
		'normal'=>__('copc.normal'),		
		'light'=>__('copc.light')		
	);	
}

function fn_settings_variants_addons_csc_one_page_checkout_location_fields(){
	return array(
		's_country'=>__('country'),
		's_state'=>__('state'),
		's_city'=>__('city'),
		's_zipcode'=>__('zip_postal_code'),		
		's_address'=>__('address'),	
		
		'b_country'=>__('billing_address') .': '. __('country'),
		'b_state'=>__('billing_address') .': '. __('state'),
		'b_city'=>__('billing_address') .': '. __('city'),
		'b_zipcode'=>__('billing_address') .': '. __('zip_postal_code'),		
		'b_address'=>__('billing_address') .': '. __('address'),		
	);
}

function fn_settings_variants_addons_csc_one_page_checkout_shipping_and_address_in_one_row(){
	return array(
		'bold'=>__('copc.bold'),
		'normal'=>__('copc.normal'),		
		'light'=>__('copc.light')		
	);	
}


function fn_csc_one_page_checkout_shippings_get_shippings_list_post($group, $lang, $area, &$shippings_info){
	if (Registry::get('addons.csc_one_page_checkout.disable')=="Y"){
		return;
	}
	if (Registry::get('addons.csc_one_page_checkout.location')==csc_one_page_checkout::_('WQ==')){
		foreach ($shippings_info as $k=>$shipping){
			if (empty($shipping['rate_info']) && $shipping['rate_calculation']=="M"){
				$rate = db_get_row("SELECT rate_id, rate_value FROM ?:shipping_rates WHERE shipping_id=?i AND destination_id=?i", $shipping['shipping_id'], 1);
				if ($rate){
					$shippings_info[$k]['rate_info']['rate_value'] = unserialize($rate['rate_value']);
					$shippings_info[$k]['rate_info']['rate_id'] = $rate['rate_id'];
				}
			}
		}		
	}
	
}
function fn_csc_one_page_checkout_shippings_get_shippings_list_conditions($group, $shippings, $fields, $join, &$condition, $order_by){	
	$package_cost = $group['package_info_full']['C'];	
	$condition .= db_quote(' AND (?:shippings.min_subtotal <= ?d', $package_cost);
    $condition .= db_quote(' AND (?:shippings.max_subtotal >= ?d OR ?:shippings.max_subtotal = 0.00))', $package_cost);
}

function fn_csc_one_page_checkout_calculate_cart_items(&$cart, $cart_products, $auth, $apply_cart_promotions){
	if (Registry::get('addons.csc_one_page_checkout.disable')=="Y"){
		return;
	}
	$cart['calculate_shipping'] = true;
}


function fn_check_location_fields_is_filled($user_data){
	$filled = true;
	if (Registry::get('addons.csc_one_page_checkout.location_fields')){
		$fields=array_keys(Registry::get('addons.csc_one_page_checkout.location_fields'));
		if (is_array($fields)){
			foreach ($fields as $field){
				if (empty($user_data[$field])){
					$filled=false;	
				}
			}	
		}else{
			$filled = false;
		}
	}
	return $filled;
}

