<?php
use Tygh\Registry;
if (!defined('BOOTSTRAP')) { die('Access denied'); }
if ($_SERVER['REQUEST_METHOD']=="POST" && $mode=="update"){
	if (isset($_REQUEST['field_data']['shipping_ids']) && is_array($_REQUEST['field_data']['shipping_ids'])){
		$_REQUEST['field_data']['shipping_ids']	=implode(',', $_REQUEST['field_data']['shipping_ids']);
	}elseif(isset($_REQUEST['field_data']['shipping_ids'])){
		$_REQUEST['field_data']['shipping_ids']='';	
	}
}