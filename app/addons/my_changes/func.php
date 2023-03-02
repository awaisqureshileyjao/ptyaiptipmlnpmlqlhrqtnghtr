<?php

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_my_changes_auth_routines(&$request, &$auth, &$field, &$condition, &$user_login){
	/*print_r($request);
	print_r($filed);
	print_r($condition);
	print_r($user_login);
	die;*/
}

function fn_my_changes_get_categories_brand($parent_id){
	if($parent_id){
		$brands = db_get_array("SELECT distinct(C.variant), C.variant_id FROM cscart_product_features_values A, cscart_products_categories B, cscart_product_feature_variant_descriptions C, cscart_categories D WHERE A.product_id = B.product_id AND A.variant_id = C.variant_id AND B.category_id= D.category_id AND FEATURE_ID = 18 AND B.category_id IN(SELECT category_id FROM cscart_categories WHERE parent_id = $parent_id) order by C.variant ");
			//list($brands) = $_brands.variant;
			return $brands;
	}

	return false;
}

function fn_my_changes_get_categories_sale($parent_id ){
	if($parent_id){
	$_sale = db_get_array("SELECT a.category_id,b.category FROM cscart_categories a, cscart_category_descriptions b where a.category_id=b.category_id AND a.parent_id =?i AND b.lang_code=?s", $parent_id , $lang_code=CART_LANGUAGE);

		return $_sale;
	}
	return false;
}


function fn_my_changes_get_brans_name($product_id){
	if(!empty($product_id)){
	$brand = db_get_field("SELECT variant FROM cscart_product_features_values FV, cscart_product_feature_variant_descriptions FVD WHERE FV.variant_id = FVD.variant_id AND product_id=?i AND feature_id=18 AND FVD.lang_code=?s",$product_id, DESCR_SL);
	return $brand;
	}
	return false;
}
//$ss = fn_my_changes_categorieswise_brand($category_id='409'); print_r($ss);die('hgf');
function fn_my_changes_categorieswise_brand($category_id){
	if($category_id){
		$cat_brands = db_get_array("SELECT  distinct(C.variant_id) FROM cscart_product_features_values A, cscart_products_categories B, cscart_product_feature_variant_descriptions C, cscart_categories D WHERE A.product_id = B.product_id AND A.variant_id = C.variant_id AND B.category_id= D.category_id AND FEATURE_ID = 18 AND C.lang_code =?s AND D.id_path like ?l",'en', trim($category_id) . '%' );
		
		return $cat_brands;		
	}

	return false;
}



function fn_my_changes_selected_variants($category_id, $variants){
	$filter_variants = array();
	$finalArray = [];
	$filter_variants = fn_my_changes_categorieswise_brand($category_id);
$_filter_variants = [];
foreach ($filter_variants as $key => $value){
        $_filter_variants[$key] = $value['variant_id'];
 }
$brands = [];
foreach ($variants as $vk => $variant){
    $finalArray  = array_merge($finalArray,$variant);
	$expectedArray = [];
	foreach ($finalArray as $key => $value) {
	    if(in_array($value['variant_id'],$_filter_variants)){
	        $cc='';
	        $cc = substr($value['variant'], 0, 1);
	        if($vk == $cc){ $expectedArray[$key]  = $value; }
	        $brands[$vk] = $expectedArray; 
		}
    }
}
	return $brands;
}

/*
function fn_my_changes_get_categories_brand__display($category_id){
	if($category_id){
		$brands = db_get_array("SELECT distinct(C.variant), C.variant_id FROM cscart_product_features_values A, cscart_products_categories B, cscart_product_feature_variant_descriptions C, cscart_categories D WHERE A.product_id = B.product_id AND A.variant_id = C.variant_id AND B.category_id= D.category_id AND FEATURE_ID = 18 AND B.category_id IN(SELECT category_id FROM cscart_categories WHERE parent_id = $category_id) order by C.variant ");
			//list($brands) = $_brands.variant;
			echo  $brands;
	}

	return false;
}

*/
















