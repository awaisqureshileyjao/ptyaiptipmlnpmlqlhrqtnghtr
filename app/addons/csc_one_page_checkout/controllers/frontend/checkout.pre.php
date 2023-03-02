<?php
use Tygh\Registry;
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (version_compare(PRODUCT_VERSION, '4.3.6', '<')){
	$cart = & $_SESSION['cart'];
	$session = & $_SESSION;
	$city_geolocation = isset($_SESSION['geocity']) ? $_SESSION['geocity'] : null;
}else{
	$cart = & Tygh::$app['session']['cart'];
	$session = & Tygh::$app['session'];
	$city_geolocation = isset(Tygh::$app['session']['geocity']) ? Tygh::$app['session']['geocity'] : null;
}



if ($_SERVER['REQUEST_METHOD']=="POST" && Registry::get('addons.csc_one_page_checkout.disable')!="Y"){
	if ($mode=="save_user_data"){
		$params=$_REQUEST;
		$params['update_step']='step_two';
		if ($params['customer_notes']=="undefined"){
			unset($params['customer_notes']);	
		}
		if (isset($params['customer_notes'])){
			$cart['customer_notes'] = $params['customer_notes'];
			$cart['notes'] = $params['customer_notes'];
		}
		if (empty($params['ship_to_another']) || $params['ship_to_another']!="1"){
			$params['ship_to_another']=false;	
		}
		$cart['user_data'] = array_merge($cart['user_data'], $params['user_data']);
		if (empty($cart['user_data']['firstname']) && (!empty($cart['user_data']['b_firstname']) || !empty($cart['user_data']['s_firstname']))){
			$params['user_data']['firstname'] = !empty($cart['user_data']['b_firstname']) ? $cart['user_data']['b_firstname'] : $cart['user_data']['s_firstname'];
		}
		if (empty($cart['user_data']['lastname']) && (!empty($cart['user_data']['b_lastname']) || !empty($cart['user_data']['s_lastname']))){
			$params['user_data']['lastname'] = !empty($cart['user_data']['b_lastname']) ? $cart['user_data']['b_lastname'] : $cart['user_data']['s_lastname'];
		}
		
		fn_checkout_update_steps($cart, $auth, $params);
				
		if (!empty($session['notifications'])){
			foreach ($session['notifications'] as $k=>$n){
				if ($n['type']=="N"){
					unset($session['notifications'][$k]);	
				}	
			}	
		}
		if (!$auth['user_id']){
			$cart['guest_checkout']=true;
		}else{
			fn_update_user_profile($auth['user_id'], $params['user_data']);
		}
		fn_save_cart_content($cart, $auth['user_id']);
		
		fn_opc_rus_customer_geolocation_compatibility($session, $cart, $city_geolocation);
		if ($params['hidden']=='false'){		
			return array(CONTROLLER_STATUS_REDIRECT, 'checkout.checkout');
		}else{
			exit;
		}
	}	
	
	if ($mode == 'place_order') {
		if(!$auth['user_id'] && empty($_REQUEST['user_data']['email'])){
			$_REQUEST['user_data']['email'] = '_guest_'.TIME.'@'.$_SERVER['HTTP_HOST'];	
		}		
	}	
	return;	
}
if ($mode=="checkout" && Registry::get('addons.csc_one_page_checkout.disable')!="Y"){
	if ($auth['user_id'] && !empty($_REQUEST['edit_step']) && $_REQUEST['edit_step']=="step_one"){
		$last_login = db_get_field("SELECT last_login FROM ?:users WHERE user_id=?i", $auth['user_id']);
		if ($last_login + 3 > TIME){
			return array(CONTROLLER_STATUS_REDIRECT, 'checkout.checkout');
		}
	}
	
	if (empty($cart['user_data']['s_county'])){
		$cart['user_data']['s_county'] = Registry::get('settings.General.default_country');
		if (empty($cart['user_data']['s_state'])){
			$cart['user_data']['s_state'] = Registry::get('settings.General.default_state');			
		}
	}
	fn_opc_rus_geolocation_compatibility($session, $cart, $city_geolocation);	
}

function fn_opc_rus_geolocation_compatibility(&$session, &$cart, $city_geolocation=''){
	//Geolocation and Rus cities compatibility
	if (empty($cart['user_data']['s_city']) && !empty($city_geolocation)){
		$cart['user_data']['s_city'] = $session['geocity'];
		if (Registry::get('addons.rus_cities.status')=="A"){
			$list_cities = fn_rus_geolocation_select_cities($city_geolocation);
			if (!empty($list_cities['city'])) {
				$cart['user_data']['b_city'] = $list_cities['city'];
				$cart['user_data']['s_city'] = $list_cities['city'];
				$cart['user_data']['b_country'] = $list_cities['code'];
				$cart['user_data']['s_country'] = $list_cities['code'];
				$cart['user_data']['b_state'] = $list_cities['state_code'];
				$cart['user_data']['s_state'] = $list_cities['state_code'];
			}
		}	
	}
}

function fn_opc_rus_customer_geolocation_compatibility(&$session, $cart){
	if (Registry::get('addons.rus_customer_geolocation.status')=="A"){		
		if (!empty($session['settings']['rus_customer_geolocation_location']['value'])){
			foreach ($cart['user_data'] as $k=>$value){
				$field = str_replace('s_', '', $k);
				if (isset($session['settings']['rus_customer_geolocation_location']['value'][$field])){
					$session['settings']['rus_customer_geolocation_location']['value'][$field]=$value;					
				}
							
							
			}
					
		}		
	}
}
