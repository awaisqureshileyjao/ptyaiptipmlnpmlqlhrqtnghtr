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
use Tygh\Registry;
if (!defined('BOOTSTRAP')) { die('Access denied'); }
/**
* Hook update_product_post
*
* @param array $product_data Product data
* @param int $product_id Product integer identifier
* @param string $lang_code Two-letter language code (e.g. 'en', 'ru', etc.)
* @param boolean $create Flag determines if product was created (true) or just updated (false).
*/
function fn_ab__product_fe05_facebook_ads_update_product_post($product_data, $product_id, $lang_code, $create)
{
if (isset($product_data['ab__pfe05_condition'])) {
db_replace_into('ab__pfe05_product_conditions', array(
'product_id' => $product_id,
'value' => $product_data['ab__pfe05_condition']
));
}
}
/**
* Hook get_product_data
*
* @param int $product_id Product ID
* @param string $field_list List of fields for retrieving
* @param string $join String with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
* @param mixed $auth Array with authorization data
* @param string $lang_code Two-letter language code (e.g. 'en', 'ru', etc.)
* @param string $condition Condition for selecting product data
*/
function fn_ab__product_fe05_facebook_ads_get_product_data($product_id, &$field_list, &$join, $auth, $lang_code, $condition)
{
if (AREA == 'A') {
$field_list .= db_quote(', IFNULL(?:ab__pfe05_product_conditions.value, ?s) as ab__pfe05_condition', AB__PFE05_DEFAULT_CONDITION);
$join .= ' LEFT JOIN ?:ab__pfe05_product_conditions ON ?:ab__pfe05_product_conditions.product_id = ?:products.product_id';
}
}
/**
* Hook delete_product_post
*
* @param int $product_id Product identifier
* @param bool $product_deleted True if product was deleted successfully, false otherwise
*/
function fn_ab__product_fe05_facebook_ads_delete_product_post($product_id, $product_deleted)
{
if (!empty($product_deleted)) {
db_query('DELETE FROM ?:ab__pfe05_product_conditions WHERE product_id = ?i', $product_id);
}
}
/**
* Hook clone_product
*
* @param int $product_id Original product identifier
* @param int $pid Cloned product identifier
*/
function fn_ab__product_fe05_facebook_ads_clone_product($product_id, $pid)
{
$row = db_get_row('SELECT * FROM ?:ab__pfe05_product_conditions WHERE product_id = ?i', $product_id);
if (!empty($row)) {
$row['product_id'] = $pid;
db_replace_into('ab__pfe05_product_conditions', $row);
}
}
/**
* Hook ab__pfe_get_items
*
* @param array $datafeed Current datafeed data
* @param array $params Product search params
* @param array $fields List of fields for retrieving
* @param string $joins String with the complete JOIN information (JOIN type, tables and fields) for an SQL-query
* @param string $condition String containing SQL-query condition possibly prepended with a logical operator (AND or OR)
* @param string $group String containing the SQL-query GROUP BY field
* @param string $limit Limit parameter
*/
function fn_ab__product_fe05_facebook_ads_ab__pfe_get_items($datafeed, $params, &$fields, &$joins, $condition, $group, $limit)
{
if (!empty($params['facebook_ads'])) {
$fields[] = db_quote('IFNULL(?:ab__pfe05_product_conditions.value, ?s) as ab__pfe05_condition', AB__PFE05_DEFAULT_CONDITION);
$joins .= ' LEFT JOIN ?:ab__pfe05_product_conditions ON ?:ab__pfe05_product_conditions.product_id = p.product_id';
}
}
/**
* Exports product
*
* @param int $product_id ID of exported product
*
* @return string Condition of the product
*/
function fn_ab__pfe05_exim_get_product($product_id) {
$condition = db_get_field('SELECT value FROM ?:ab__pfe05_product_conditions WHERE product_id = ?i', $product_id);
return empty($condition) ? AB__PFE05_DEFAULT_CONDITION : $condition;
}
/**
* Imports product
*
* @param int $product_id ID of importing product
* @param string $value Condition of the product
*/
function fn_ab__pfe05_exim_put_product($product_id, $value) {
if (!in_array($value, fn_ab__pfe05_conditions_list())) {
$value = AB__PFE05_DEFAULT_CONDITION;
}
db_replace_into('ab__pfe05_product_conditions', array(
'product_id' => $product_id,
'value' => $value
));
}
/**
* Gets list of conditions variants
*
* @return array
*/
function fn_ab__pfe05_conditions_list() {
return array(
'new',
'refurbished',
'used'
);
}
/**
* Escapes double quotes in string
*
* @param string $string
*
* @return string
*/
function fn_ab__pfe05_escape_csv($string)
{
$string = strip_tags((string) $string);
$string = htmlspecialchars_decode($string);
$string = html_entity_decode($string);
$string = trim(preg_replace('/\s+/', ' ', $string));
return str_replace('"', '""', $string);
}
/**
* Adds events to stack
*
* @param string $event Tracked event
* @param array $data Data to send
*
* @return bool
*/
function fn_ab__pfe05_send_event($event, $data)
{
if (empty($event) || empty($data)) {
return false;
}
$stack = Registry::ifGet('ab__pfe05_pixel', array());
if (fn_ab__pfe05_is_valid_event($event, $data)) {
$stack[] = array(
'event' => $event,
'data' => $data
);
}
Registry::set('ab__pfe05_pixel', $stack);
return true;
}
/**
* Hook dispatch_before_display
*/
function fn_ab__product_fe05_facebook_ads_dispatch_before_display()
{
$stack = Registry::ifGet('ab__pfe05_pixel', array());
if (empty($stack)) {
return;
}
if (defined('AJAX_REQUEST')) {
Tygh::$app['ajax']->assign('ab__pfe05_pixel', $stack);
} else {
Tygh::$app['view']->assign('ab__pfe05_pixel', $stack);
}
}
/**
* Hook add_to_cart
*
* @param array $cart Array of cart content and user information necessary for purchase
* @param int $product_id Product identifier
* @param int $_id Cart item identifier
*/
function fn_ab__product_fe05_facebook_ads_add_to_cart($cart, $product_id, $_id)
{
$product = $cart['products'][$_id];
$data = array(
'content_ids' => array($product_id),
'content_name' => $product['product'],
'content_type' => 'product',
'currency' => CART_PRIMARY_CURRENCY,
'value' => $product['price']
);
fn_ab__pfe05_send_event('AddToCart', $data);
}
/**
* Hook pre_add_to_wishlist
*
* @param array $product_data array with data for the product to add)(product_id, price, amount, product_options, is_edp)
* @param array $wishlist wishlist data storage
* @param array $auth user session data
*/
function fn_ab__product_fe05_facebook_ads_pre_add_to_wishlist($product_data, $wishlist, $auth)
{
if (empty($product_data)) {
return;
}
$is_new = true;
$product_id = key($product_data);
if (!empty($wishlist['products'])) {
foreach ($wishlist['products'] as $hash => $product) {
if ($product_id == $product['product_id']) {
$is_new = false;
break;
}
}
}
if ($is_new) {
$product = fn_get_product_data($product_id,$auth,CART_LANGUAGE,'', false,false,true,false,false,false,false);
$data = array(
'content_name' => $product['product'],
'content_ids' => array($product_id),
'currency' => CART_PRIMARY_CURRENCY,
'value' => $product['price'],
);
fn_ab__pfe05_send_event('AddToWishlist', $data);
}
}
/**
* Hook place_order
*
* @param int $order_id Order identifier
* @param string $action Current action. Can be empty or "save"
* @param string $order_status New order status (one char)
* @param array $cart Array of the cart contents and user information necessary for purchase
* @param array $auth Array of user authentication data (e.g. uid, usergroup_ids, etc.)
*/
function fn_ab__product_fe05_facebook_ads_place_order($order_id, $action, $order_status, $cart, $auth)
{
$runtime = Registry::get('runtime');
if (AREA != 'C' || ($runtime['controller'] == 'checkout' && $runtime['mode'] == 'place_order')) {
return;
}
$data = fn_ab__pfe05_get_array_by_products($cart['products']);
fn_ab__pfe05_send_event('Purchase', $data);
}
/**
* Makes array to send by products from cart or order
*
* @param array $products Array of products to send
*
* @return array
*/
function fn_ab__pfe05_get_array_by_products($products)
{
if (empty($products)) {
return array();
}
$sum = 0;
$products_ids = array();
foreach($products as $product) {
$products_ids[] = $product['product_id'];
$sum += $product['price'] * $product['amount'];
}
$data = array(
'content_ids' => $products_ids,
'content_type' => 'product',
'currency' => CART_PRIMARY_CURRENCY,
'value' => $sum,
);
return $data;
}
/**
* Creates string value for "product_type" field
*
* @param int $category_id Product category identifier
*
* @return string
*/
function fn_ab__pfe05_create_product_type($category_id)
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
while ($category_id > 0 && isset($categories[$category_id])) {
$path[] = str_replace(',', '.', $categories[$category_id]['category']);
$category_id = $categories[$category_id]['parent_id'];
}
$path[] = __('ab__pfe05.home');
return implode(' > ', array_reverse($path));
}
/**
* Checks is valid event
*
* @param string $event Tracked event
* @param array $data Data to send
*
* @return bool $result Is valid event
*/
function fn_ab__pfe05_is_valid_event($event, $data)
{
$result = true;
static $runtime = [];
if (empty($runtime)) {
$runtime = Registry::get('runtime');
}
$result &= ($runtime['controller'] !== 'geo_maps');
/*
* @param string $event Tracked event
* @param array $data Data to send
* @param bool $result Is valid event
*/
fn_set_hook('ab__pfe05_is_valid_event',$event, $data, $result);
return $result;
}