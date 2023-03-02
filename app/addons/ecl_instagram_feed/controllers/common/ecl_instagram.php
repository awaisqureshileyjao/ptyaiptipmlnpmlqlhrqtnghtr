<?php

use Tygh\Http;
use Tygh\Registry;
use Tygh\Settings;

defined('BOOTSTRAP') or die('Access denied');

$app_id = Registry::get('addons.ecl_instagram_feed.app_id');
$app_secret = Registry::get('addons.ecl_instagram_feed.app_secret');
if (fn_allowed_for('ULTIMATE')) {
    $redirect_uri = 'https://' . Registry::get('runtime.company_data.secure_storefront') . '/ecl_instagram_update/';
} else {
    $redirect_uri = Registry::get('config.https_location') . '/ecl_instagram_update/';
}

if ($mode == 'process') {

    $redirect_uri = urlencode($redirect_uri);
    $url = "https://api.instagram.com/oauth/authorize?client_id={$app_id}&redirect_uri={$redirect_uri}&scope=user_profile,user_media&response_type=code";
    Settings::instance()->updateValue('instagram_token', '');
    Settings::instance()->updateValue('instagram_token_expiry', 0);
    fn_redirect($url, true);

    exit;
}

if ($mode == 'update') {
    if (defined('INSTAGRAM_DEBUG')) {
        fn_echo('Auth result:');
        fn_print_r($_REQUEST);
    }

    $code = $_REQUEST['code'];

    $suffix = substr($code, 0, -2);
    if ($suffix == '#_') {
        $code = substr($code, 0, strlen($code-2));
    }

    $data = array(
        'client_id' => $app_id,
        'client_secret' => $app_secret,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect_uri,
        'code' => $code
    );

    $response_data = Http::post('https://api.instagram.com/oauth/access_token', $data);

    $data = json_decode($response_data, true);

    if (defined('INSTAGRAM_DEBUG')) {
        fn_echo('Get token:');
        fn_print_r($data);
    }

    if (!empty($data['error_message'])) {
        fn_set_notification('E', __('error'), $data['error_message']);
    } else {
        $url = "https://graph.instagram.com/access_token?grant_type=ig_exchange_token&client_secret={$app_secret}&access_token=" . $data['access_token'];

        $response_data = Http::get($url);

        $data = json_decode($response_data, true);

        if (defined('INSTAGRAM_DEBUG')) {
            fn_echo('Get a Long-Lived Token: ');
            fn_print_r($data);
        }

        Settings::instance()->updateValue('instagram_token', $data['access_token']);
        Settings::instance()->updateValue('instagram_token_expiry', TIME + $data['expires_in']);

        if (defined('INSTAGRAM_DEBUG')) {
            $response_data = Http::get("https://graph.instagram.com/me/media?fields=id,media_type,media_url,username,timestamp&access_token={$data[access_token]}");

            $data = json_decode($response_data, true);

            fn_echo('Get a Long-Lived Token: ');
            fn_print_die($data);
        }

        fn_set_notification('N', __('notice'), __('done'));
    }

    fn_redirect(fn_url('addons.update?addon=ecl_instagram_feed', 'A'));
}
