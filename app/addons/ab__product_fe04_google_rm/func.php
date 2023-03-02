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
use Tygh\Enum\ProductFeatures;
use Tygh\Registry;
if (!defined('BOOTSTRAP')) { die('Access denied'); }
function fn_ab__product_fe04_google_rm_update_product_post($product_data, $product_id, $lang_code, $create)
{
if (isset($product_data['ab__pfe04_condition']) && fn_check_view_permissions('ab__product_fe04_google_rm.manage')) {
db_replace_into('ab__pfe04_product_conditions', array(
'product_id' => $product_id,
'value' => $product_data['ab__pfe04_condition']
));
}
}
function fn_ab__product_fe04_google_rm_get_product_data($product_id, &$field_list, &$join, $auth, $lang_code, $condition)
{
if (AREA == 'A') {
$field_list .= db_quote(', IFNULL(?:ab__pfe04_product_conditions.value, ?s) as ab__pfe04_condition', AB__PFE04_DEFAULT_CONDITION);
$join .= ' LEFT JOIN ?:ab__pfe04_product_conditions ON ?:ab__pfe04_product_conditions.product_id = ?:products.product_id';
}
}
function fn_ab__product_fe04_google_rm_delete_product_post($product_id, $product_deleted)
{
if (!empty($product_deleted)) {
db_query('DELETE FROM ?:ab__pfe04_product_conditions WHERE product_id = ?i', $product_id);
}
}
function fn_ab__product_fe04_google_rm_clone_product($product_id, $pid)
{
$row = db_get_row('SELECT * FROM ?:ab__pfe04_product_conditions WHERE product_id = ?i', $product_id);
if (!empty($row)) {
$row['product_id'] = $pid;
db_replace_into('ab__pfe04_product_conditions', $row);
}
}
function fn_ab__product_fe04_google_rm_ab__pfe_get_items($datafeed, $params, &$fields, &$join, $condition, $group, $limit)
{
if (!empty($params['google_rm'])) {
$fields[] = 'pd.promo_text';
$fields[] = db_quote('IFNULL(?:ab__pfe04_product_conditions.value, ?s) as ab__pfe04_condition', AB__PFE04_DEFAULT_CONDITION);
$join .= ' LEFT JOIN ?:ab__pfe04_product_conditions ON ?:ab__pfe04_product_conditions.product_id = p.product_id';
$load_features = [];
foreach(['isbn', 'gtin', 'mpn'] as $field) {
$feature_param = 'ab__pfe04_' . $field . '_feature_id';
if (!empty($datafeed['params'][$feature_param]) && is_numeric(trim($datafeed['params'][$feature_param]))) {
$load_features[$field] = $datafeed['params'][$feature_param];
}
}
if (!empty($load_features)) {
$features = db_get_array(
'SELECT feature_id, feature_type FROM ?:product_features WHERE feature_id IN (?n) AND status IN (?a)'
, $load_features, ['A', 'H']
);
foreach ($features as $feature) {
$field = array_search($feature['feature_id'], $load_features);
$prefix = 'ab_pfe04_' . $field;
$join .= db_quote(" LEFT JOIN ?:product_features_values AS {$prefix}_pfv ON {$prefix}_pfv.product_id = p.product_id AND {$prefix}_pfv.lang_code = pd.lang_code AND {$prefix}_pfv.feature_id = ?i", $feature['feature_id']);
if (in_array($feature['feature_type'], [ProductFeatures::TEXT_SELECTBOX, ProductFeatures::NUMBER_SELECTBOX, ProductFeatures::EXTENDED, ProductFeatures::MULTIPLE_CHECKBOX])) {
$fields[] = "{$prefix}_vd.variant as {$field}";
$join .= " LEFT JOIN ?:product_feature_variant_descriptions AS {$prefix}_vd ON {$prefix}_pfv.variant_id = {$prefix}_vd.variant_id AND {$prefix}_vd.lang_code = pd.lang_code";
} else {
$fields[] = ($feature['feature_type'] === ProductFeatures::NUMBER_FIELD) ? "{$prefix}_pfv.value_int as {$field}" : "{$prefix}_pfv.value as {$field}";
}
}
}
}
}
function fn_ab__pfe04_exim_get_product($product_id) {
$condition = db_get_field('SELECT value FROM ?:ab__pfe04_product_conditions WHERE product_id = ?i', $product_id);
return empty($condition) ? AB__PFE04_DEFAULT_CONDITION : $condition;
}
function fn_ab__pfe04_exim_put_product($product_id, $value) {
if (!in_array($value, fn_ab__pfe04_conditions_list())) {
$value = AB__PFE04_DEFAULT_CONDITION;
}
db_replace_into('ab__pfe04_product_conditions', array(
'product_id' => $product_id,
'value' => $value
));
}
function fn_ab__pfe04_conditions_list() {
return array(
'new',
'refurbished',
'used'
);
}
function fn_ab__pfe04_escape_csv($string)
{
$string = strip_tags($string);
$string = htmlspecialchars_decode($string);
$string = html_entity_decode($string);
$string = trim(preg_replace('/\s+/', ' ', $string));
return str_replace('"', '""', $string);
}
function fn_ab__pfe04_trim_string($string)
{
$string = strip_tags($string);
return (mb_strlen($string) > 30) ? mb_substr($string, 0, 26).'...' : $string;
}
function fn_ab__pfe04_create_product_type($category_id)
{
static $categories = Null;
if ($categories === Null) {
$datafeed = Registry::get('ab__pfe_datafeed');
$categories = db_get_hash_array('SELECT c.category_id, c.parent_id, cd.category FROM ?:categories AS c
INNER JOIN ?:category_descriptions AS cd ON c.category_id = cd.category_id AND cd.lang_code = ?s
WHERE c.status = ?s',
'category_id', $datafeed['lang_code'], 'A');
}
$path = array();
while (!empty($category_id) && !empty($categories[$category_id])) {
$path[] = str_replace(',', '.', $categories[$category_id]['category']);
$category_id = $categories[$category_id]['parent_id'];
}
$path[] = __('ab__pfe04.home');
return implode(' > ', array_reverse($path));
}
function fn_ab__product_fe04_google_rm_update_category_post($category_data, $category_id, $lang_code)
{
if (isset($category_data['ab__pfe04_google_product_category']) && fn_check_view_permissions('ab__product_fe04_google_rm.manage')) {
db_replace_into('ab__pfe04_google_product_category', array(
'category_id' => $category_id,
'value' => $category_data['ab__pfe04_google_product_category']
));
}
}
function fn_ab__product_fe04_google_rm_get_category_data($category_id, &$field_list, &$join, $lang_code, $conditions)
{
if (AREA == 'A') {
$field_list .= ', IFNULL(?:ab__pfe04_google_product_category.value, 0) as ab__pfe04_google_product_category';
$join .= ' LEFT JOIN ?:ab__pfe04_google_product_category ON ?:ab__pfe04_google_product_category.category_id = ?:categories.category_id';
}
}
function fn_ab__product_fe04_google_rm_delete_category_post($category_id, $recurse, $category_ids)
{
db_query('DELETE FROM ?:ab__pfe04_google_product_category WHERE category_id IN (?n)', $category_ids);
}
function fn_ab__product_fe04_google_rm_ab__pfe_get_categories($datafeed, &$fields, &$join, $conditions)
{
$fields[] = 'IFNULL(?:ab__pfe04_google_product_category.value, 0) as ab__pfe04_google_product_category';
$join .= ' LEFT JOIN ?:ab__pfe04_google_product_category ON ?:ab__pfe04_google_product_category.category_id = c.category_id';
}
