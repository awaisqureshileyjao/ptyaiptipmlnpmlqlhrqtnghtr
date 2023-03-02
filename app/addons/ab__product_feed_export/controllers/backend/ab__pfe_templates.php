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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
call_user_func(ab_____(base64_decode('Z29gdXN2dHVmZWB3YnN0')),ab_____(base64_decode('YmNgYHFnZmB1Zm5xbWJ1ZmBlYnVi')));
$suffix = ab_____(base64_decode('bmJvYmhm'));
if ($mode == ab_____(base64_decode('dnFlYnVm')) and call_user_func(ab_____(base64_decode('a'.'nRgYn'.'NzY'.'no=')),call_user_func(ab_____(base64_decode('VXp'.'oaV1'.'CQ0JO'.'Ym9i'.'aGZzO'.'ztk'.'aWBi')),true)) ) {
if (!empty($_REQUEST[ab_____(base64_decode('YmNgYHFnZmB1Zm5xbWJ1ZmBlYnVi'))])) {
$template_id = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7dnFlYnVmYHVmbnFtYnVm')),$_REQUEST[ab_____(base64_decode('YmNgYHFnZmB1Zm5xbWJ1ZmBlYnVi'))], $_REQUEST[ab_____(base64_decode('dWZucW1idWZgamU='))]);
}
if (!empty($template_id)) {
$suffix = ab_____(base64_decode('dnFlYnVmQHVmbnFtYnVmYGplPg==')) . $template_id;
}
}
if ($mode == ab_____(base64_decode('bmBlZm1mdWY=')) || $mode == ab_____(base64_decode('ZWZtZnVm'))) {
if (!empty($_REQUEST[ab_____(base64_decode('dWZucW1idWZgamU='))])) {
call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7ZWZtZnVmYHVmbnFtYnVmdA==')),$_REQUEST[ab_____(base64_decode('dWZucW1idWZgamU='))]);
}
}
return array(CONTROLLER_STATUS_OK, ab_____(base64_decode('YmNgYHFnZmB1Zm5xbWJ1ZnQv')) . $suffix);
}
if ($mode == ab_____(base64_decode('aGZ1YGVmZ2J2bXVgdWZucW1idWY='))) {
if (!empty($_REQUEST[ab_____(base64_decode('b2JuZg=='))]) && call_user_func(ab_____(base64_decode('dHVzbWZv')),trim($_REQUEST[ab_____(base64_decode('b2JuZg=='))]))) {
Tygh::$app['ajax']->assign(ab_____(base64_decode('dWZucW1idWY=')), call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVmZ2J2bXVgdWZucW1idWZ0')),trim($_REQUEST[ab_____(base64_decode('b2JuZg=='))])));
}
exit;
}
if ($mode == ab_____(base64_decode('bmJvYmhm'))) {
$params = $_REQUEST;
list($templates, $search) = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YHVmbnFtYnVmdA==')),$params, call_user_func(ab_____(base64_decode('VXpoaV1TZmhqdHVzejs7aGZ1')),ab_____(base64_decode('dGZ1dWpvaHQvQnFxZmJzYm9kZi9iZW5qb2Bxc3BldmR1dGBxZnNgcWJoZg=='))));
Tygh::$app['view']->assign(ab_____(base64_decode('YmNgYHFnZmB1Zm5xbWJ1ZnQ=')), $templates);
Tygh::$app['view']->assign(ab_____(base64_decode('dGZic2Rp')), $search);
}
if ($mode == ab_____(base64_decode('dnFlYnVm')) || $mode == ab_____(base64_decode('YmVl'))) {
$default_templates = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVmZ2J2bXVgdWZucW1idWZ0')));
Tygh::$app['view']->assign(ab_____(base64_decode('ZWZnYnZtdWB1Zm5xbWJ1ZnQ=')), $default_templates);
$all_params = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YGVmZ2J2bXVgcWJzYm50')));
Tygh::$app['view']->assign(ab_____(base64_decode('Ym1tYHFic2JudA==')), $all_params);
if (!empty($_REQUEST[ab_____(base64_decode('dWZucW1idWZgamU='))])) {
$template = call_user_func(ab_____(base64_decode('VXpoaV1CQ1FHRjs7aGZ1YHVmbnFtYnVmdA==')),array(
ab_____(base64_decode('dWZucW1idWZgamU=')) => $_REQUEST[ab_____(base64_decode('dWZucW1idWZgamU='))],
'limit' => 1,
));
Tygh::$app['view']->assign('t', $template);
}
}
