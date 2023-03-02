<?php
use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (version_compare(PRODUCT_VERSION, '4.3.6', '<')){
	$cart = & $_SESSION['cart'];
	$session = & $_SESSION;
}else{
	$cart = & Tygh::$app['session']['cart'];
	$session = & Tygh::$app['session'];
}

if ($_SERVER['REQUEST_METHOD']=="POST"){	
	return;	
}
if (version_compare(PRODUCT_VERSION, '4.3.2', '<')){
	$_view = Registry::get('view');	
}else{
	$_view = Tygh::$app['view'];	
}


if ($mode=="checkout" && Registry::get('addons.csc_one_page_checkout.disable')!="Y"){
	$params=$_REQUEST;
	$profile_fields = $_view->getTemplateVars('profile_fields');	
	if (Registry::get(csc_one_page_checkout::_('YWRkb25zLmNzY19vbmVfcGFnZV9jaGVja291dC5sb2NhdGlvbl9maWVsZHM='))){
		$location_fields = array_keys(Registry::get('addons.csc_one_page_checkout.location_fields'));
	}else{
		$location_fields=array();	
	}
	$chosen_shipping=false;
	if (!empty($cart['chosen_shipping'])){
		$chosen_shipping = reset($cart['chosen_shipping']);
	}
	
	
	foreach ($profile_fields as $section=>$fields){
		foreach ($fields as $k=>$field){
			$field['shipping_ids'] = !empty($field['shipping_ids']) ? explode(',', $field['shipping_ids']) : array();
			
			if (!empty($field['cs_field_size'])){				
				$profile_fields[$section][$k]['class'] .= " cs_custom_field csc_checkout_".$field['cs_field_size'];	
			}elseif(isset($field['class'])){
				$profile_fields[$section][$k]['class'] .= " cs_custom_field csc_checkout_l";		
			}
			if(isset($field['class'])){
				$profile_fields[$section][$k]['class'] .= " cs_type_".strtolower($field['field_type']);
			}			
			
			if (in_array($field['field_name'], $location_fields)){				
				if (Registry::get('addons.csc_one_page_checkout.divide_location_fields')=="Y" && (Registry::get('addons.csc_one_page_checkout.provider')=="none" || !Registry::get('addons.csc_one_page_checkout.api_key'))){
					$profile_fields['L'][$k]=	$profile_fields[$section][$k];
					$profile_fields['L'][$k]['class']=str_replace("csc_checkout_", "cscc_", $profile_fields['L'][$k]['class']);
					unset($profile_fields[$section][$k]);
					continue;
				}else{
					$profile_fields[$section][$k]['class'] .= " cm-copc-location";
				}
			}														
			if ($chosen_shipping && in_array($chosen_shipping, $field['shipping_ids'])){				
				$profile_fields['D'][$k]=$profile_fields[$section][$k];
				unset($profile_fields[$section][$k]);
			}
			if 	($auth['user_id'] && Registry::get('addons.csc_one_page_checkout.hide_email_if_logged')=="Y" && $field['field_name']=="email"){
				unset($profile_fields[$section][$k]);
			}
			if 	(!$auth['user_id'] && Registry::get('addons.csc_one_page_checkout.email_not_required')=="Y" && $field['field_name']=="email"){
				$profile_fields[$section][$k]['required']=false;
			}
		}
	}
	if (
		Registry::get('addons.csc_one_page_checkout.provider')!="none" && Registry::get('addons.csc_one_page_checkout.api_key') || 
		(
			Registry::get('addons.csc_one_page_checkout.google_geolocation_api_key') && 
			(
				Registry::get('addons.csc_one_page_checkout.show_geoautofill')=="Y" || Registry::get('addons.csc_one_page_checkout.show_openmap')=="Y"
			)
		)
	){
		$profile_fields['L'][]=array(
			'field_id'=>'autosuggestion',
			'field_name'=>'autosuggestion',
			'checkout_show'=>'Y',
			'is_default'=>'Y',
			'field_type'=>'I',
			'section'=>'L',
			'class' => ' cs_custom_field',
			'autocomplete_type' => 'address',
			'cs_field_size' => 'l',
			'description'=>__('autosuggestion_field')
		);	
	}
	//fn_print_r($profile_fields);
	
	$_view->assign('profile_fields', $profile_fields);
	$_view->assign('location_fields', $location_fields);
	
	
	
	if (version_compare(PRODUCT_VERSION, '4.10.1', '>=')){
		$payment_methods = fn_prepare_checkout_payment_methods($cart, $auth, CART_LANGUAGE, true);
	}else{
		$payment_methods = $_view->getTemplateVars('payment_methods');
	}	
	
	if (count($payment_methods) > 1){
		$_payment_methods=array('tab1'=>array());
		foreach ($payment_methods as $group){
			$_payment_methods['tab1'] = array_merge($_payment_methods['tab1'], $group);	
		}		
						
	}else{
		$_payment_methods = $payment_methods;
	}
	$_view->assign('payment_methods', $_payment_methods);

	
	
	if (!empty($params['edit_step']) &&  $params['edit_step']=="step_one" || (Registry::get('settings.Checkout.disable_anonymous_checkout')=="Y" && !$auth['user_id'])){
		$_SESSION['copc.edit_first_step']=true;	
	}
	if (!empty($params['edit_step']) &&  $params['edit_step']!="step_one"){
		$_SESSION['copc.edit_first_step']=false;	
	}
	$_cart = $_view->getTemplateVars('cart');
	if (empty($params['edit_step']) && empty($_SESSION['copc.edit_first_step'])){
		if (!$auth['user_id'] && !empty($cart['user_data']['email']) && strpos($cart['user_data']['email'], $_SERVER['HTTP_HOST'])!==false && strpos($cart['user_data']['email'], '_guest_')!==false){
			$cart['user_data']['email']='';
		}		
		$_cart['edit_step']="step_two";
		$completed_steps = $_view->getTemplateVars('completed_steps');
		$completed_steps['step_one']=true;
		$_view->assign('cart', $_cart);	
		$_view->assign('completed_steps', $completed_steps);			
	}	
	//fn_print_r($_cart['edit_step']);
}

if ($mode=="complete" && Registry::get('addons.csc_one_page_checkout.disable')!="Y"){	
	if (
		!$auth['user_id'] 
		&& !empty($cart['user_data']['email']) 
		&& strpos($cart['user_data']['email'], $_SERVER['HTTP_HOST'])!==false 
		&& strpos($cart['user_data']['email'], '_guest_')!==false 
		&& Registry::get('settings.Checkout.allow_create_account_after_order')=="Y"
	){		
		$_view->assign('hide_registration', true);	
	}	
}
