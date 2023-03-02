<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

use Tygh\Registry;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return;
}

if ($mode == 'get_products_list') {
    $page_size = isset($_REQUEST['page_size']) ? (int) $_REQUEST['page_size'] : 10;

    $params = $_REQUEST;

    // search params
    $_params = array(
        'subcats' => 'Y',
        'pcode_from_q' => 'Y',
        'pshort' => 'Y',
        'pfull' => 'Y',
        'pname' => 'Y',
        'pkeywords' => 'Y',
        'items_per_page' => $page_size
    );

    $params = array_merge($params, $_params);

    list($products, $params) = fn_get_products($params, $page_size);
    fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => false, 'get_discounts' => true));

    $width = $height = 50; // image size

    $objects = array();
    foreach ($products as $products_list) {

        Tygh::$app['view']->assign('class', 'ty-price-num ty-nowrap');
        Tygh::$app['view']->assign('value', fn_get_product_price($products_list['product_id'], 1, $auth));

        if (empty($products_list['main_pair'])) {
            $products_list['main_pair'] = array();
        }

        $objects[] = array(
            'product_id' => $products_list['product_id'],
            'product' => $products_list['product'],
            'url' => fn_url('products.view?product_id=' . $products_list['product_id']),
            'image_data' => fn_image_to_display($products_list['main_pair'], $width, $height),
            'price' => Tygh::$app['view']->fetch('common/price.tpl', true),
            'product_code' => $products_list['product_code']
        );
    }

    Tygh::$app['ajax']->assign('products', $objects);

    exit;
}