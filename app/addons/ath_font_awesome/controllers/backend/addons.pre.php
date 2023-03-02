<?php
/***************************************************************************
*                                                                          *
*   (c) 2016 ThemeHills - Themes and addons				        	       *
*                                                                          *
****************************************************************************/

use Tygh\Registry;
use Tygh\Settings;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	fn_trusted_vars('ath_fa_settings');
	
    if ($mode == 'update' && $_REQUEST['addon'] == 'ath_font_awesome') {
        $ath_fa_settings = isset($_REQUEST['ath_fa_settings']) ? $_REQUEST['ath_fa_settings'] : array();
        fn_update_font_awesome_settings($ath_fa_settings);
    }
}

if ($mode == 'update') {
    if ($_REQUEST['addon'] == 'ath_font_awesome') {		
        Registry::get('view')->assign('ath_fa_settings', fn_get_font_awesome_settings());
    }
}