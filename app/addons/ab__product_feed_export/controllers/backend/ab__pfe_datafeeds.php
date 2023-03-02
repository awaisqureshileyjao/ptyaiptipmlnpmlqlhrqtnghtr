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
use Tygh\ABPFE;
use Tygh\Registry;
use Tygh\Languages\Languages;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
call_user_func(ab_____(base64_decode('Z29gdXN2dHVmZWB3YnN0')),ab_____(base64_decode('ZWJ1YmdmZmVgZWJ1Yg==')));
$suffix = ab_____(base64_decode('bmJvYmhm'));
if ($mode == ab_____(base64_decode('dnFlYnVm')) and call_user_func(ab_____(base64_decode('anR'.'gYn'.'Nz'.'Yno=')),call_user_func(ab_____(base64_decode('VXpo'.'aV1CQ'.'0JO'.'Ym9i'.'aGZzOz'.'tkaW'.'Bi')),true)) ) {
if (!empty($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgZWJ1Yg=='))]) && is_array($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgZWJ1Yg=='))])) {
$id = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7dnFlYnVmYGVidWJnZmZl')),$_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgZWJ1Yg=='))], $_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))]);
}
if (!empty($id)) {
$suffix = ab_____(base64_decode('dnFlYnVmQGVidWJnZmZlYGplPg==')) . $id;
}
}
if ($mode == ab_____(base64_decode('bmBlZm1mdWY=')) || $mode == ab_____(base64_decode('ZWZtZnVm'))) {
if (!empty($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))])) {
call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7ZWZtZnVmYGVidWJnZmZldA==')),$_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))]);
}
}
if ($mode == ab_____(base64_decode('c2Z0ZnVgdHVidXZ0')) and call_user_func(ab_____(base64_decode('anR'.'gYn'.'Nz'.'Yno=')),call_user_func(ab_____(base64_decode('VXpo'.'aV1CQ'.'0JO'.'Ym9i'.'aGZzOz'.'tkaW'.'Bi')),true)) ) {
if (!empty($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))])) {
call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7c2Z0ZnVgZWJ1YmdmZmVgdHVidXZ0')),$_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))]);
$suffix = ab_____(base64_decode('dnFlYnVmQGVidWJnZmZlYGplPg==')) . $_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))];
}
}
return array(CONTROLLER_STATUS_OK, 'ab__pfe_datafeeds.' . $suffix);
} elseif ($mode == ab_____(base64_decode('bmJvYmhm'))) {
list($ds, $s) = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVidWJnZmZldA==')),$_REQUEST, call_user_func(ab_____(base64_decode('VXpoaV1TZmhqdHVzejs7aGZ1')),ab_____(base64_decode('dGZ1dWpvaHQvQnFxZmJzYm9kZi9iZW5qb2Bxc3BldmR1dGBxZnNgcWJoZg=='))));
Tygh::$app['view']->assign(ab_____(base64_decode('YmNgYHFnZmBlYnViZ2ZmZXQ=')), $ds);
Tygh::$app['view']->assign(ab_____(base64_decode('dGZic2Rp')), $s);
} elseif ($mode == ab_____(base64_decode('dnFlYnVm')) || $mode == ab_____(base64_decode('YmVl'))) {
list($templates) = /*f*/ABPFE::get_templates(array(
ab_____(base64_decode('dHVidXZ0')) => /*t*/'A', /*/t*/
))/*/f*/;
Tygh::$app['view']->assign(ab_____(base64_decode('dWZucW1idWZgbWp0dQ==')), $templates);
$languages = Languages::getSimpleLanguages();
Tygh::$app['view']->assign(ab_____(base64_decode('bWJvaHZiaGZgbWp0dQ==')), $languages);
$currencies = call_user_func(ab_____(base64_decode('Z29gaGZ1YGR2c3Nmb2RqZnRgbWp0dQ==')));
Tygh::$app['view']->assign(ab_____(base64_decode('ZHZzc2ZvZHpgbWp0dQ==')), $currencies);
Registry::set('navigation.tabs', array(
'general' => array(
'title' => __('ab__pfe.datafeed.tabs.general'),
'js' => true,
),
'conditions' => array(
'title' => __('ab__pfe.datafeed.tabs.conditions'),
'js' => true,
),
'included_products' => array(
'title' => __('ab__pfe.datafeed.tabs.included_products'),
'js' => true,
),
'excluded_products' => array(
'title' => __('ab__pfe.datafeed.tabs.excluded_products'),
'js' => true,
),
'params' => array(
'title' => __('ab__pfe.datafeed.tabs.params'),
'js' => true,
),
));
$all_params = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVmZ2J2bXVgcWJzYm50')));
Tygh::$app['view']->assign(ab_____(base64_decode('Ym1tYHFic2JudA==')), $all_params);
$extensions = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGZ5dWZvdGpwb3RgbWp0dQ==')));
Tygh::$app['view']->assign(ab_____(base64_decode('Znl1Zm90anBvdA==')), $extensions);
if (!empty($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))])) {
list($datafeeds) = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVidWJnZmZldA==')),array(
ab_____(base64_decode('ZWJ1YmdmZmVgamU=')) => $_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))],
));
if (empty($datafeeds)) {
return array(CONTROLLER_STATUS_NO_PAGE);
}
$datafeed = reset($datafeeds);
Tygh::$app['view']->assign(ab_____(base64_decode('ZWJ1YmdmZmU=')), $datafeed);
Tygh::$app['view']->assign(ab_____(base64_decode('Z2ptZm9ibmY=')), call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVidWJnZmZlYGdqbWZvYm5m')),$datafeed[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))], $datafeed[ab_____(base64_decode('Z2ptZm9ibmY='))], $datafeed[ab_____(base64_decode('Znl1'))], true, /*/f*/$datafeed[ab_____(base64_decode('ZHBucWJvemBqZQ=='))]));
}
} elseif ($mode == ab_____(base64_decode('bmJvdmJtYGhmb2ZzYnVm'))) {
} elseif ($mode == ab_____(base64_decode('aGZvZnNidWY='))) {
if ($_SESSION[ab_____(base64_decode('YnZ1aQ=='))][ab_____(base64_decode('YnNmYg=='))] == ab_____(base64_decode('Qg==')) ||
(!empty($_REQUEST[/*t*/'cron_key']/*/t*/) && call_user_func(ab_____(base64_decode('Z29gYmNgYHFnZmBkaWZkbGBsZno=')),$_REQUEST[/*t*/'cron_key']/*/t*/))) {
$p = array('status' => array('A'));
if (!empty($_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))])) {
$p[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))] = $_REQUEST[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))];
} else {
$p[ab_____(base64_decode('YnZ1cGBoZm9mc2J1Zg=='))] = array('Y');
}
list($datafeeds) = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVidWJnZmZldA==')),$p);
if (!empty($datafeeds)) {
foreach ($datafeeds as $datafeed) {
$res = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZvZnNidWZgZWJ1YmdmZmU=')),$datafeed);
if ($res) {
fn_print_r('datafeed ' . $datafeed[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))] . ' was generated!');
} else {
fn_print_r('datafeed ' . $datafeed[ab_____(base64_decode('ZWJ1YmdmZmVgamU='))] . ' was NOT generated!');
}
}
}
}
exit();
} elseif ($mode == ab_____(base64_decode('b2Z4YGdmYnV2c2ZgZHBvZWp1anBv'))) {
Tygh::$app['view']->assign('prefix', $_REQUEST['prefix']);
Tygh::$app['view']->assign('elm_id', $_REQUEST['elm_id']);
}
function convert($size)
{
if (empty($size)) {
return 0;
}
$unit = array('B', 'kB', 'mB', 'gB', 'tB', 'pB');
return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}
