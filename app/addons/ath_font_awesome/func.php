<?php
/***************************************************************************
*                                                                          *
*   (c) 2016 ThemeHills - Themes and addons				        	       *
*                                                                          *
****************************************************************************/

use Tygh\Registry;
use Tygh\Settings;
use Tygh\Http;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_update_font_awesome_settings($settings) {
	
	if (Registry::get('runtime.simple_ultimate')) {
        $company_id = 1;
    } elseif (Registry::get('runtime.company_id')) {
        $company_id = Registry::get('runtime.company_id');
    } else {
        $company_id = 0;
    }

	$font_awesome_settings['company_id'] = $company_id;
	$font_awesome_settings['settings'] = json_encode($settings);
	
    db_query("REPLACE INTO ?:ath_font_awesome ?e", $font_awesome_settings);

	return $company_id;
}

function fn_get_font_awesome_settings() {
	
	if (Registry::get('runtime.simple_ultimate')) {
        $company_id = 1;
    } elseif (Registry::get('runtime.company_id')) {
        $company_id = Registry::get('runtime.company_id');
    } else {
        $company_id = 0;
    }
	
    $json_font_awesome_settings = db_get_row('SELECT settings FROM ?:ath_font_awesome WHERE company_id = ?i', $company_id);
	
	if (!empty($json_font_awesome_settings)) {
		$font_awesome_settings = json_decode($json_font_awesome_settings['settings'],true);
	} else {
		return true;
	}

    return $font_awesome_settings;
}
