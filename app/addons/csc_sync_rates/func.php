<?php
/*****************************************************************************
*                                                                            *
*          All rights reserved! CS-Commerce Software Solutions               *
* 			http://www.cs-commerce.com/license-agreement.html 				 *
*                                                                            *
*****************************************************************************/
use Tygh\Registry;
use Tygh\CscSyncRates;
if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_csc_sync_rates_install(){
	/*Privilages*/
	if (version_compare(PRODUCT_VERSION, '4.10.1', '<')){
		db_query("REPLACE INTO ?:privileges (privilege, is_default, section_id) VALUES ('manage_csc_sync_rates', 'N', 'addons')");
		db_query("REPLACE INTO ?:privileges (privilege, is_default, section_id) VALUES ('view_csc_sync_rates', 'N', 'addons')");
	}else{
		db_query("REPLACE INTO ?:privileges (privilege, is_default, section_id, group_id, is_view) VALUES ('manage_csc_sync_rates', 'N', 'addons', 'csc_sync_rates', 'N')");
		db_query("REPLACE INTO ?:privileges (privilege, is_default, section_id, group_id, is_view) VALUES ('view_csc_sync_rates', 'N', 'addons', 'csc_sync_rates', 'Y')");		
	}
}

function fn_csc_sync_rates_uninstall(){	
	/*Privilages*/
	db_query("DELETE FROM ?:privileges WHERE privilege IN ('manage_csc_sync_rates', 'view_csc_sync_rates')");
}

function fn_csc_sync_rates_user_init($auth, $user_info, $first_init){
	$last_sync = fn_get_storage_data('csc_sync_currencies');
	$options = CscSyncRates::_get_option_values(true, 1);
	$values = [
		'3H'=>3600*3,
		'6H'=>3600*6,
		'12H'=>3600*12,
		'D'=>3600*24,
		'W'=>3600*24*7,
		'M'=>3600*24*30,	
	];
	if (empty($values[$options['sync_period']])){
		$options['sync_period']='D';	
	}
	if (TIME - $values[$options['sync_period']] > $last_sync){
		fn_csc_sync_currencies_rates();
	}
}

function fn_csc_sync_currencies_rates($currency=''){	
	csc_sync_rates::_zxev("WTA1p,WyozA5CFEupzqo!I07PtxxqKWfVQ0tnJ1joT9xMFt,?lpfVSfXPDx#nUE0pU!6?l9upTxhL3!gL29goJIlL2HhL29gV#jtPtxWVzA1p,WyozAcMK!#?NbWPFW,MKDgpzS0MK!#?NbWPFEsH0IFIxIFJlqVISEDK0uCH1D,KFjXPDyHrJqbK.AmL1A5ozAFLKEypmb6WTWup2IsozSgMFjXPDyQDIWHK1OFFH1OHyysD1IFHxIBD1xXPI0cBjbWWTSjnI9eMKxtCFOwp2Asp3yhL19lLKEypmb6K2SjnI9eMKxbD0SFIS9DHxyADIWMK0AIHyWSGxAMXGfXPFE1pzjt?w0,C2SjnI9eMKx9Wl4xLKOcK2gyrGfXPFE1pzjt?w0,W,O2CFphHSWCESIQIS9JEIWGFH9BBjbWWUIloPNhCFpzpTH9Wl5DHx9.IHAHK0I.FIEWG047PtycM#NbWTA1p,WyozA5XKfXPDxxqKWfVP49V#L#?#WwqKWlMJ5wnJImJ109V#4xL3IlpzIhL3x7PDbWsJIfp2I7PtxWWTA1p,WyozAcMK!tCFOxLy9,MKEsMzyyoTEmXPWGEHkSD1DtL3IlpzIhL3ysL29xMFOTHx9AVQ86L3IlpzIhL2yyplVcBjxXPDyzo3WyLJAbXPEwqKWlMJ5wnJImVTSmVPEwqKWlXKfXPDxWWUIloPNhCFVzV#4#L3IlpzIhL2yyp1gqCFVhWTA1p,V7PtxWsDxXPK0XPFEwnPN9VTA1pzksnJ5cqPtcBjxXVNywqKWfK3AyqT9jqPtxL2tfV.AIHxkCHSEsIIW!?PNxqKWfXGfWPDbWL3IloS9mMKEipUDbWTAb?POQIIW!G1OHK1WSISIFGyEFDH5GExIF?PNkXGfXPFElLKEyplN9VTA1pzksMKuyLltxL2tcBjbWL3IloS9woT9mMFtxL2tcBjbWWUWuqTImVQ0tn,Aioy9xMJAiMTHbWUWuqTIm?PO0p,IyXGfXPJyzXPElLKEyply7P#NtVPNtVPNtMz9lMJSwnPtxpzS0MK!tLK!tWT!9C#ElXKfXVPNtVNxWMTWspKIyp,xbVyIDE.SHEFN/BzA1p,WyozAcMK!tH0IHVTAiMJMznJAcMJ50CG9mVSqVEIWSVTA1p,WyozA5K2AiMTH9C3!#?PNxp#jtWT!cBjxXVPNtVNy9Pty9PtycM#NbVFEwqKWlMJ5wrFy7PtxWMz5sp2I0K3A0o3WuM2IsMTS0LFt,L3AwK3A5ozAsL3IlpzIhL2yyplpfVSEWGHHcBjbWPIE5M2upHzI,nKA0p,x6B,AyqPt,p2I0qTyhM3!hGT9,M2yhMl5fo2qsqUyjMI9,MJ5ypzSf?zA1p,WyozA5K3A5oz!,?PO0p,IyXGfXPDxxoKA,VQ0tK18bW2Ampz!hp3yhL19lLKEyp19mqJAwMKAmWlx7PtxWnJLtXP.xpzS0MK!crjbWPFNtVPNxoKA,VQ0tK18bW2Ampz!hp3yhL19lLKEyp19zLJyfMJD,XGfXPDy9PtxWMz5soT9,K2I2MJ50XPq,MJ5ypzSfWljtW2A1p,WyozA5K3A5oz!,?POoW21yp3AuM2H,CG4xoKA,KFx7Pty9", $currency);
}
