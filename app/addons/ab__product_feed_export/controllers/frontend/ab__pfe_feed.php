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
return true;
}
if ($mode == 'get') {
if (!empty($_REQUEST['datafeed_id']) && !empty($_REQUEST['filename']) && !empty($_REQUEST['ext'])) {
$p = array();
$p['datafeed_id'] = $_REQUEST['datafeed_id'];
list($datafeeds) = ABPFE::get_datafeeds($p);
$df = $datafeeds[$_REQUEST['datafeed_id']];
Registry::set('runtime.company_id', $df['company_id']);
$status = true;
if (!empty($df['login']) && !empty($df['password'])) {
if (empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])
|| trim($df['login']) != trim($_SERVER['PHP_AUTH_USER'])
|| trim($df['password']) != trim($_SERVER['PHP_AUTH_PW'])
) {
$status = false;
}
}
if ($status) {
ABPFE::send_datafeed($df, $_REQUEST['filename'], $_REQUEST['ext']);
} else {
header('WWW-Authenticate: Basic realm="' . $_SERVER['SERVER_NAME'] . '"');
header('HTTP/1.0 401 Unauthorized');
die('Not authorized!');
}
}
exit;
}
