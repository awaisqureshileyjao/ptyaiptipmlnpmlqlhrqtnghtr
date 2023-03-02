<?php
/*******************************************************************************************
*   ___  _          ______                     _ _                _                        *
*  / _ \| |         | ___ \                   | (_)              | |              © 2019   *
* / /_\ | | _____  _| |_/ /_ __ __ _ _ __   __| |_ _ __   __ _   | |_ ___  __ _ _ __ ___   *
* |  _  | |/ _ \ \/ / ___ \ '__/ _` | '_ \ / _` | | '_ \ / _` |  | __/ _ \/ _` | '_ ` _ \  *
* | | | | |  __/>  <| |_/ / | | (_| | | | | (_| | | | | | (_| |  | ||  __/ (_| | | | | | | *
* \_| |_/_|\___/_/\_\____/|_|  \__,_|_| |_|\__,_|_|_| |_|\__, |  \___\___|\__,_|_| |_| |_| *
*                                                         __/ |                            *
*                                                        |___/                             *
* ---------------------------------------------------------------------------------------- *
* This is commercial software, only users who have purchased a valid license and  accept   *
* to the terms of the License Agreement can install and use this program.                  *
* ---------------------------------------------------------------------------------------- *
* website: https://cs-cart.alexbranding.com                                                *
*   email: info@alexbranding.com                                                           *
*******************************************************************************************/
use Tygh\ABPFE;
if (!defined('BOOTSTRAP')) {
die('Access denied');
}
function fn_ab__pfe_install_demodata($action)
{
$functions_list = array(
'template' => 'fn_ab__pfe_create_template',
'datafeed' => 'fn_ab__pfe_create_datafeed',
);
if (empty($action) || empty($functions_list[$action])) {
fn_set_notification('E', __('error'), 'No such demodata for this addon');
return false;
}
$func = $functions_list[$action];
if (is_array($func)) {
$func_name = array_shift($func);
$args = $func;
} else {
$func_name = $func;
$args = array();
}
if (is_callable($func_name)) {
$result = call_user_func_array($func_name, $args);
if (is_string($result)) {
fn_set_notification('N', __('notice'), $result);
}
}
return true;
}
function fn_ab__pfe_create_template()
{
$default_template = ABPFE::get_default_templates('general');
$template_data = array(
'name' => 'ab-template',
'position' => 1,
'status' => 'A',
'template' => $default_template,
);
$template_id = ABPFE::update_template($template_data, 0);
if (empty($template_id)) {
$string = __('ab__pfe.demodata.template_not_created');
} else {
$link = '<a target="_blank" href="' . fn_url('ab__pfe_templates.update?template_id=' . $template_id, 'A') . '">' . $template_data['name'] . '</a>';
$string = __('ab__pfe.demodata.template_created', array('[template]' => $link));
}
return $string;
}
function fn_ab__pfe_create_datafeed()
{
$test_categories_ids = db_get_fields('SELECT c.category_id FROM ?:categories AS c WHERE c.status = ?s AND c.parent_id = 0 ?p', 'A', fn_get_company_condition('c.company_id'));
$template_id = db_get_field('SELECT template_id FROM ?:ab__pfe_templates WHERE name = ?s OR template LIKE ?l', 'ab-template', '% general %');
if (empty($template_id)) {
$string = __('ab__pfe.demodata.template_not_found');
return $string;
}
$company_id = fn_get_runtime_company_id();
$datafeed_data = array(
'company_id' => $company_id,
'name' => 'AB: Datafeed',
'filename' => 'feed',
'ext' => 'xml',
'template_id' => $template_id,
'lang_code' => CART_LANGUAGE,
'currency_code' => CART_PRIMARY_CURRENCY,
'max_images' => 1,
'images_full_size' => 'Y',
'export_variations' => 'N',
'promotions_apply' => 'N',
'auto_generate' => 'Y',
'output_to_display' => 'Y',
'position' => 1,
'status' => 'A',
'only_in_stock' => 'Y',
'only_with_description' => 'N',
'only_with_images' => 'Y',
'included_categories' => empty($test_categories_ids) ? '' : implode(',', $test_categories_ids),
'included_subcategories' => 'Y',
'included_products' => '',
'excluded_categories' => '',
'excluded_subcategories' => 'N',
'excluded_products' => '',
'params' => array(
'abpfe_p1' => 'utf-8',
),
);
$datafeed_id = ABPFE::update_datafeed($datafeed_data, 0);
if (empty($datafeed_id)) {
$string = __('ab__pfe.demodata.datafeed_not_created');
} else {
$admin_link = '<a target="_blank" href="' . fn_url('ab__pfe_datafeeds.update?datafeed_id=' . $datafeed_id, 'A') . '">' . $datafeed_data['name'] . '</a>';
$file_url = ABPFE::get_datafeed_filename($datafeed_id, $datafeed_data['filename'], $datafeed_data['ext'], true);
$file_link = '<a target="_blank" href="' . $file_url . '">' . $file_url . '</a>';
$string = __('ab__pfe.demodata.datafeed_created', array('[datafeed]' => $admin_link, '[file_url]' => $file_link));
}
list($datafeeds) = ABPFE::get_datafeeds(array(
'datafeed_id' => $datafeed_id,
));
ABPFE::generate_datafeed(reset($datafeeds));
return $string;
}
