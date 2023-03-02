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
use Tygh\Registry;
use Tygh\Themes\Themes;
use Tygh\Storage;
if (!defined('BOOTSTRAP')) {
die('Access denied');
}
function fn_ab__p_update_link($link_data, $link_id)
{
if (!empty($link_data['url']) && strpos($link_data['url'], '?') !== false) {
list($url, $query) = explode('?', trim($link_data['url']));
if (is_numeric($query) && strlen($query) == 10) {
$link_data['url'] = $url;
$link_data['use_timestamp'] = 'Y';
}
}
if (!empty($link_id)) {
db_query('UPDATE ?:ab__preload_links SET ?u WHERE link_id = ?i', $link_data, $link_id);
} else {
$link_data['company_id'] = fn_get_runtime_company_id();
$link_id = db_query('INSERT INTO ?:ab__preload_links ?e', $link_data);
}
return $link_id;
}
function fn_ab__p_delete_link($link_id)
{
db_query('DELETE FROM ?:ab__preload_links WHERE link_id = ?i', $link_id);
return true;
}
function fn_ab__p_get_links($params = [])
{
$sortings = [
'url' => '?:ab__preload_links.url',
'format' => '?:ab__preload_links.format',
'use_timestamp' => '?:ab__preload_links.use_timestamp',
'status' => '?:ab__preload_links.status',
];
$sorting = db_sort($params, $sortings, 'url', 'asc');
$fields = [
'?:ab__preload_links.*',
];
$join = '';
$condition = fn_get_company_condition('?:ab__preload_links.company_id');
if (AREA == 'C') {
$condition .= db_quote(' AND ?:ab__preload_links.status = ?s', 'A');
}
$links = db_get_hash_array('SELECT ?p FROM ?:ab__preload_links ?p WHERE 1 ?p ?p', 'link_id', implode(', ', $fields), $join, $condition, $sorting);
return $links;
}

function fn_ab__preload_merge_styles_file_hash($files, $styles, $prepend_prefix, $params, $area, $css_dirs, $hash)
{
if ($area === 'C' && !empty($params['use_scheme']) && empty($prepend_prefix)) {
$prefix = 'standalone';
if (fn_is_rtl_language()) {
$prefix .= '-rtl';
}
$filename = $prefix . '.' . $hash . '.css';
$theme = Themes::areaFactory($area);
$relative_path = $theme->getThemeRelativePath() . '/css/';
$timestamp = 0;
$file = Storage::instance('assets')->getAbsolutePath($relative_path . $filename);
if (!empty($file)) {
if (file_exists($file)) {
$timestamp = fn_get_storage_data('ab__p_' . $relative_path . $filename);
} else {
$timestamp = TIME;
fn_set_storage_data('ab__p_' . $relative_path . $filename, TIME);
}
}
Registry::set('ab__preload.timestamp', $timestamp);
}
}

function fn_ab__p_get_css_timestamp()
{
return Registry::ifGet('ab__preload.timestamp',0);
}

function fn_ab__preload_clear_cache_post($type, $extra)
{
if ($type == 'misc' || $type == 'all') {
db_query('DELETE FROM ?:storage_data WHERE data_key LIKE ?l', 'ab__p_%');
}
}

function fn_ab__preload_styles_update($that, $style_id, $style, $style_path, &$less)
{
if (Registry::get('addons.ab__preload.add_font_display') == 'Y') {
$add_string = 'font-display: swap;' . PHP_EOL;
preg_match_all('/\@font-face[\s]*{(?:(?!font-display)[^}])*}/is', $less, $m);
foreach ($m as $match) {
$fixed_match = str_replace('font-family:', $add_string.'font-family:', $match);
$less = str_replace($match, $fixed_match, $less);
}
}
}