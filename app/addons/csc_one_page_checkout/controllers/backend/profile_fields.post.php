<?php
use Tygh\Registry;
if (!defined('BOOTSTRAP')) { die('Access denied'); }
if (version_compare(PRODUCT_VERSION, '4.3.2', '<')){
	$_view = Registry::get('view');	
}else{
	$_view = Tygh::$app['view'];	
}


if ($mode=="update"){
	$_view->assign('shippings', fn_get_available_shippings(null));
	$field = $_view->getTemplateVars('field');
	
	if (!empty($field['shipping_ids'])){
		$field['shipping_ids'] = explode(',', $field['shipping_ids']);	
	}
	$_view->assign('field', $field);
	
	fn_csc_opc_profile_types($_view);
	
}
if ($mode=="manage"){
	fn_csc_opc_profile_types($_view);
}

function fn_csc_opc_profile_types($_view){
	if (version_compare(PRODUCT_VERSION, '4.10.1', '>=')){
		$profile_types = $_view->getTemplateVars('profile_types');
		if (isset($profile_types['U']['allowed_areas']) && !in_array('checkout', $profile_types['U']['allowed_areas'])){
			$profile_types['U']['allowed_areas'][]='checkout';	
		}
		$_view->assign('profile_types', $profile_types);	
	}
}