<?php


use Tygh\Registry;
use Tygh\BlockManager\ProductTabs;
use Tygh\session;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

//
// List products
//

if ($mode == 'chart') {

	if (!empty($_REQUEST['category_id'])){
		$category_data = fn_get_category_data($_REQUEST['category_id']);
		$category_name =fn_get_category_name($category_data['parent_id']);
		$_main_cat[] = explode('/', $category_data['id_path']);
		list($_main_cat) = $_main_cat;
		$main_cat = $_main_cat[0];
			
		Tygh::$app['view']->assign('category_id', $main_cat);
      
	}

}

if ($mode == 'newsletter') {

	}