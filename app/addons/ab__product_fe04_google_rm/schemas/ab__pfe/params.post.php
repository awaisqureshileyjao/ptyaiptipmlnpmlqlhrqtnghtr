<?php
/*******************************************************************************************
*   ___  _          ______                     _ _                _                        *
*  / _ \| |         | ___ \                   | (_)              | |              © 2020   *
* / /_\ | | _____  _| |_/ /_ __ __ _ _ __   __| |_ _ __   __ _   | |_ ___  __ _ _ __ ___   *
* |  _  | |/ _ \ \/ / ___ \ '__/ _` | '_ \ / _` | | '_ \ / _` |  | __/ _ \/ _` | '_ ` _ \  *
* | | | | |  __/>  <| |_/ / | | (_| | | | | (_| | | | | | (_| |  | ||  __/ (_| | | | | | | *
* \_| |_/_|\___/_/\_\____/|_|  \__,_|_| |_|\__,_|_|_| |_|\__, |  \___\___|\__,_|_| |_| |_| *
*                                                         __/ |                            *
*                                                        |___/                             *
* ---------------------------------------------------------------------------------------- *
* This is commercial software, only users who have purchased a valid license and accept    *
* to the terms of the License Agreement can install and use this program.                  *
* ---------------------------------------------------------------------------------------- *
* website: https://cs-cart.alexbranding.com                                                *
*   email: info@alexbranding.com                                                           *
*******************************************************************************************/
$schema['ab__product_fe04_google_rm']['ab__pfe04_brand'] = array(
'name' => __('ab__pfe04.params.export_brand'),
'tooltip' => __('ab__pfe04.params.export_brand.tooltip'),
'default' => "N",
);
$schema['ab__product_fe04_google_rm']['ab__pfe04_product_type'] = array(
'name' => __('ab__pfe04.params.export_product_type'),
'tooltip' => __('ab__pfe04.params.export_product_type.tooltip'),
'default' => "N",
);
$schema['ab__product_fe04_google_rm']['ab__pfe04_google_product_category'] = array(
'name' => __('ab__pfe04.params.export_google_product_category'),
'tooltip' => __('ab__pfe04.params.export_google_product_category.tooltip'),
'default' => "N",
);
$schema['ab__product_fe04_google_rm']['ab__pfe04_isbn_feature_id'] = array(
'name' => __('ab__pfe04.params.isbn_feature_id'),
'tooltip' => __('ab__pfe04.params.isbn_feature_id.tooltip'),
'default' => 0,
);
$schema['ab__product_fe04_google_rm']['ab__pfe04_gtin_feature_id'] = array(
'name' => __('ab__pfe04.params.gtin_feature_id'),
'tooltip' => __('ab__pfe04.params.gtin_feature_id.tooltip'),
'default' => 0,
);
$schema['ab__product_fe04_google_rm']['ab__pfe04_mpn_feature_id'] = array(
'name' => __('ab__pfe04.params.mpn_feature_id'),
'tooltip' => __('ab__pfe04.params.mpn_feature_id.tooltip'),
'default' => 0,
);
return $schema;
