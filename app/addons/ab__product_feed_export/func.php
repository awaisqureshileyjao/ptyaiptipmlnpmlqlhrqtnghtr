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
if (!defined('BOOTSTRAP')) {
die('Access denied');
}
use Tygh\Registry;
use Tygh\ABPFE;
foreach (glob(Registry::get('config.dir.addons') . '/ab__product_feed_export/ab__functions/fn.*.php') as $functions) {
require_once $functions;
}
function fn__pfe_get_offers($datafeed, $params)
{
return ABPFE::get_datafeed_items($datafeed, $params);
}
function fn_ab__product_feed_export_get_rewrite_rules(&$rewrite_rules, &$prefix, &$extension)
{
$rewrite_rules['!^' . '\/ab__pfe_([0-9]+)_([a-z0-9-_]+)\.([a-z0-9-]+)$!'] = '$customer_index?dispatch=ab__pfe_feed.get&datafeed_id=$matches[1]&filename=$matches[2]&ext=$matches[3]';
$rewrite_rules['!^' . $prefix . '\/ab__pfe_([0-9]+)_([a-z0-9-_]+)\.([a-z0-9-]+)$!'] = '$customer_index?dispatch=ab__pfe_feed.get&datafeed_id=$matches[2]&filename=$matches[3]&ext=$matches[4]';
}
function fn_ab__pfe_check_key($cron_key)
{
$key = trim(Registry::get('addons.ab__product_feed_export.cron_key'));
return (strlen($key) >= 10 && strlen($key) <= 20
&& strlen(trim($cron_key)) >= 10 && strlen(trim($cron_key)) <= 20
&& trim($cron_key) == $key);
}
function fn_ab__product_feed_export_ab__pfe_autogenerate()
{
$p = array(
'status' => array('A'),
'auto_generate' => array('Y'),
);
list($datafeeds) = ABPFE::get_datafeeds($p);
if (!empty($datafeeds)) {
foreach ($datafeeds as $datafeed) {
ABPFE::generate_datafeed($datafeed);
}
}
}
function fn_ab__product_feed_export_get_product_features(&$fields, &$join, &$condition, $params)
{
if (!empty($params['ab__pfe'])) {
$fields[] = '?:product_filter_descriptions.filter';
$join .= ' LEFT JOIN ?:product_filters ON pf.feature_id = ?:product_filters.feature_id';
$join .= ' LEFT JOIN ?:product_filter_descriptions ON ?:product_filters.filter_id = ?:product_filter_descriptions.filter_id AND ?:product_filter_descriptions.lang_code = ?:product_features_descriptions.lang_code';
if (!empty($params['exclude_feature_ids'])) {
$condition .= db_quote(' AND pf.feature_id NOT IN (?n)', $params['exclude_feature_ids']);
}
}
}
function fn_ab__product_feed_export_install()
{
$objects = array(
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'ext',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD ext VARCHAR(5) NOT NULL DEFAULT \'\' AFTER filename',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'company_id',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD company_id INT(10) unsigned NOT NULL DEFAULT 0 AFTER datafeed_id',
'add_sql' => array('ALTER TABLE ?:ab__pfe_datafeeds ADD KEY `company_id` (`company_id`)'),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'images_full_size',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD images_full_size CHAR(1) NOT NULL DEFAULT \'Y\' AFTER max_images',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'use_watermark',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD use_watermark CHAR(1) NOT NULL DEFAULT \'N\' AFTER images_full_size',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'export_variations',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD export_variations CHAR(1) NOT NULL DEFAULT \'N\' AFTER use_watermark',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'promotions_apply',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD promotions_apply CHAR(1) NOT NULL DEFAULT \'N\' AFTER export_variations',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'features_conditions',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD features_conditions text CHARACTER SET utf8 NOT NULL AFTER included_subcategories',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'output_to_display',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD output_to_display CHAR(1) NOT NULL DEFAULT \'N\'',
'add_sql' => array(),
),
array(
'table' => '?:ab__pfe_datafeeds',
'field' => 'included_products',
'sql' => 'ALTER TABLE ?:ab__pfe_datafeeds ADD `included_products` text NOT NULL AFTER included_subcategories',
'add_sql' => array(),
),
);
if (!empty($objects) && is_array($objects)) {
foreach ($objects as $object) {
$fields = db_get_fields('DESCRIBE ' . $object['table']);
if (!empty($fields) && is_array($fields)) {
$is_present_field = false;
foreach ($fields as $f) {
if ($f == $object['field']) {
$is_present_field = true;
break;
}
}
if (!$is_present_field) {
db_query($object['sql']);
if (!empty($object['add_sql'])) {
foreach ($object['add_sql'] as $sql) {
db_query($sql);
}
}
}
}
}
}
}
function fn_ab__product_feed_export_is_need_watermark_post($object_type, $is_detailed, $company_id, &$result)
{
$datafeed = Registry::get('ab__pfe_datafeed');
if ($object_type == 'product' && !empty($datafeed) && !empty($datafeed['use_watermark'])) {
$result = $datafeed['use_watermark'] == 'Y';
}
}
function fn_ab__pfe_get_features_names($params, $lang_code = CART_LANGUAGE)
{
$fields = array(
'abcd__f.*',
'abcd__fd.*',
);
$condition = '';
if (!empty($params['category_id'])) {
$condition .= db_quote(' AND abcd__f.category_id IN (?n)', (array) $params['category_id']);
}
if (!empty($params['feature_id'])) {
$condition .= db_quote(' AND abcd__f.feature_id IN (?n)', (array) $params['feature_id']);
}
if (!empty($params['item_id'])) {
$condition .= db_quote(' AND abcd__f.item_id = ?i', $params['item_id']);
}
if (!empty($params['datafeed_id'])) {
$condition .= db_quote(' AND abcd__f.datafeed_id IN (?n)', (array) $params['datafeed_id']);
}
$items = db_get_hash_array('SELECT ?p FROM ?:ab__pfe_features_names AS abcd__f
LEFT JOIN ?:ab__pfe_feature_name_descriptions AS abcd__fd ON abcd__f.item_id = abcd__fd.item_id AND abcd__fd.lang_code = ?s
WHERE 1 ?p', 'item_id', implode(',', $fields), $lang_code, $condition);
return $items;
}
function fn_ab__pfe_update_feature_name($item_data, $item_id, $lang_code = DESCR_SL)
{
if (empty($item_id)) {
$item_id = db_query('INSERT INTO ?:ab__pfe_features_names ?e', $item_data);
} else {
db_query('UPDATE ?:ab__pfe_features_names SET ?u WHERE item_id = ?i', $item_data, $item_id);
}
$item_data['lang_code'] = $lang_code;
$item_data['item_id'] = $item_id;
db_replace_into('ab__pfe_feature_name_descriptions', $item_data);
return $item_id;
}
function fn_ab__pfe_delete_feature_names($items_ids)
{
db_query('DELETE FROM ?:ab__pfe_features_names WHERE item_id IN (?n)', $items_ids);
db_query('DELETE FROM ?:ab__pfe_feature_name_descriptions WHERE item_id IN (?n)', $items_ids);
return true;
}
function fn_ab__product_feed_export_delete_category_post($category_id, $recurse, $category_ids)
{
$items = fn_ab__pfe_get_features_names(array('category_id' => $category_ids));
if (!empty($items)) {
fn_ab__pfe_delete_feature_names(array_keys($items));
}
return true;
}
function fn_ab__product_feed_export_delete_feature_post($feature_id, $variant_ids)
{
$items = fn_ab__pfe_get_features_names(array('feature_id' => $feature_id));
if (!empty($items)) {
fn_ab__pfe_delete_feature_names(array_keys($items));
}
return true;
}
