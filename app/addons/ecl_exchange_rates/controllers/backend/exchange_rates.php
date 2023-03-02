<?php
/*****************************************************************************
*                                                                            *
*                   All rights reserved! eComLabs LLC                        *
* http://www.ecom-labs.com/about-us/ecom-labs-modules-license-agreement.html *
*                                                                            *
*****************************************************************************/

use Tygh\Registry;
use Tygh\Http;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   return;
}

if ($mode == 'update') {

	$cron_password = Registry::get('addons.ecl_exchange_rates.cron_password');

    if ((!isset($_REQUEST['cron_password']) || $cron_password != $_REQUEST['cron_password']) && (!empty($cron_password)) && empty($auth['user_id'])) {
        die(__('access_denied'));
    }

	$currencies = fn_get_currencies_list([], AREA);
	
	$f_name = 'fn_get_' . Registry::get('addons.ecl_exchange_rates.provider') . '_currency_rates';
	
	if (sizeof($currencies) > 1) {
		$f_name($currencies, $auth);
	}
	
	if (empty($auth['user_id'])) {
		fn_echo('OK');
		exit;
	} elseif (!empty($_REQUEST['currency_id'])) {
		$currency = db_get_row("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_id = b.currency_id AND lang_code = ?s WHERE a.currency_id = ?s", DESCR_SL, $_REQUEST['currency_id']);

        Registry::get('view')->assign('currency', $currency);
		Registry::get('view')->display('views/currencies/update.tpl');
	} else {
		return array(CONTROLLER_STATUS_REDIRECT, "currencies.manage");
	}
}

function fn_get_yahoo_currency_rates($currencies = array(), $auth = array())
{
	foreach ($currencies as $code => $cur_data) {
		if ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
			$conv[$cur_data['currency_id']] = $code . CART_PRIMARY_CURRENCY;
		}
	}
	
	$query = "http://query.yahooapis.com/v1/public/yql?q=select * from yahoo.finance.xchange where pair in ('" . implode("','", $conv) . "')&env=store://datatables.org/alltableswithkeys";

	$response_data = Http::get($query);
	if (!empty($response_data)) {
		$response = simplexml_load_string($response_data);
		if (!empty($response->results)) {
			$_conv = array_flip($conv);
			foreach ($response->results->rate as $rate) {
				$key = (string) $rate->attributes()->id;
				if (!empty($_conv[$key])) {
					$rate = (string) $rate->Rate;
					$_data = array(
						'coefficient' => $rate + ($rate * $currencies[str_replace(CART_PRIMARY_CURRENCY, '', $key)]['rate_modifier'] / 100),
						'timestamp' => TIME,
						'yahoo_rate' => $rate 
					);
					db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?i", $_data, $_conv[$key]);
					if (empty($auth['user_id'])) {
						fn_echo(' . ');
					}
				}
			}
		} else {
			if (empty($auth['user_id'])) {
				fn_echo($response->description);
			} else {
				fn_set_notification('E', __('error'), $response->description);
			}
		}
	}
}

function fn_get_webservicex_currency_rates($currencies = array(), $auth = array())
{

	$query = "http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?";
	foreach ($currencies as $code => $cur_data) {
		if ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
			$response_data = Http::get($query . "FromCurrency=" . $code . "&ToCurrency=" . CART_PRIMARY_CURRENCY);
			$rate = preg_replace('/.*>([0-9]\.[^<]*).*/is', '$1', $response_data);
			if(is_numeric($rate)) {
				$_data = array(
					'coefficient' => $rate + ($rate * $cur_data['rate_modifier'] / 100),
					'timestamp' => TIME,
					'yahoo_rate' => $rate 
				);
				db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?s", $_data, $cur_data['currency_id']);
				if (empty($auth['user_id'])) {
					fn_echo(' . ');
				}
			} else {
				if (empty($auth['user_id'])) {
					fn_echo($response_data);
				} else {
					fn_set_notification('E', __('error'), $response_data);
				}
			}
		}
	}
	
	return true;
}

function fn_get_paypal_currency_rates($currencies = array(), $auth = array())
{
    if (Registry::get('addons.ecl_exchange_rates.pp_mode') == 'live') {
        $paypal_url = "https://svcs.paypal.com/AdaptivePayments/ConvertCurrency";
    } else {
    	$paypal_url = "https://svcs.sandbox.paypal.com/AdaptivePayments/ConvertCurrency";
    }

    $send_amount = 1000000;
    $paypal_request = array(
        'baseAmountList' => array(
            'currency' => array()
        )
    );
    $i = 0;
    
    foreach ($currencies as $code => $cur_data) {
        if ($code == CART_PRIMARY_CURRENCY) {
            $paypal_request['requestEnvelope'] = array(
                'errorLanguage' => CART_LANGUAGE
            );
            $paypal_request['convertToCurrencyList'] = array(
                'currencyCode' => CART_PRIMARY_CURRENCY
            );
        } elseif ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
            $paypal_request['baseAmountList']['currency'][$i] = array(
                'code' => $code,
                'amount' => $send_amount
            );
            $i++;
        }
    }

    if (!empty($paypal_request)) {
        $response_data = Http::post($paypal_url, json_encode($paypal_request), array(
            'headers' => array(
                "X-PAYPAL-SECURITY-USERID: " . Registry::get('addons.ecl_exchange_rates.pp_user_id'),
                "X-PAYPAL-SECURITY-PASSWORD: " . Registry::get('addons.ecl_exchange_rates.pp_password'),
                "X-PAYPAL-SECURITY-SIGNATURE: " . Registry::get('addons.ecl_exchange_rates.pp_signature'),
                "X-PAYPAL-APPLICATION-ID: " . Registry::get('addons.ecl_exchange_rates.pp_application_id'),
                "X-PAYPAL-REQUEST-DATA-FORMAT: JSON",
                "X-PAYPAL-RESPONSE-DATA-FORMAT: XML"
            )
        ));
		
		if (!empty($response_data)) {
			$response_data = simplexml_load_string($response_data);

			if (in_array($response_data->responseEnvelope->ack, array('Error', 'Failure'))) {
				if (empty($auth['user_id'])) {
					fn_echo((string) $response_data->error->message);
				} else {
					fn_set_notification('E', __('error'), (string) $response_data->error->message);
				}
			} elseif ($response_data->responseEnvelope->ack == 'Success') {
				foreach ($response_data->estimatedAmountTable->currencyConversionList as $c_k => $c_v) {
					$tmp_base = get_object_vars($c_v->baseAmount);
					$tmp_cur = get_object_vars($c_v->currencyList->currency);
					$cur_data = array(
						'code' => $tmp_base['code'],
						'amount' => $tmp_cur['amount'],
					);

					if (!empty($cur_data['code']) && !empty($cur_data['amount'])) {
						$rate = intval($cur_data['amount']) / $send_amount;
						$_data = array(
							'coefficient' => $rate + ($rate * $currencies[$cur_data['code']]['rate_modifier'] / 100),
							'timestamp' => TIME,
							'yahoo_rate' => $rate 
						);
						db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?i", $_data, $currencies[$cur_data['code']]['currency_id']);
					}
				}
			}
		}
	}
	
	return true;
}

function fn_get_oanda_currency_rates($currencies = array(), $auth = array())
{
	$conv = array();
	foreach ($currencies as $code => $cur_data) {
		if ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
			$conv[$cur_data['currency_id']] = $code;
		}
	}

	$query = 'http://www.oanda.com/currency/table?redirected=1&date=%date%&exch=%base%&format=HTML&sel_list=%currs%&value=1';

	$rep_from = array(
		'%base%',
		'%date%',
		'%currs%',
	);
	$rep_to = array(
		CART_PRIMARY_CURRENCY,
		date('m/d/y'),
		implode('_', $conv),
	);
	$query = str_replace($rep_from, $rep_to, $query);
	
	$response_data = Http::get($query);

	preg_match('|<BR><BR><TABLE(.*)</TABLE><BR><BR>|ms', $response_data, $table);
	$table = @$table[1];
	if (!$table) {
		if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
	}
	
	preg_match_all('|<TR.*>(.*)</TR>|msU', $table, $rows);
	$rows = @$rows[1];
	unset($rows[0]);
	if (!$rows) {
		if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
	}
			
	foreach ($rows as &$row) {
		$row = strip_tags($row);
		$row = explode("\n", $row);
		$code = trim($row[2]);
		$rate = doubleval(html_entity_decode(trim($row[3])));

		if (!empty($currencies[$code]) && $rate) {
			$_data = array(
				'coefficient' => $rate + ($rate * $currencies[$code]['rate_modifier'] / 100),
				'timestamp' => TIME,
				'yahoo_rate' => $rate 
			);
			db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?i", $_data, $currencies[$code]['currency_id']);
		}
	}
	
	return true;
}

function fn_get_sberbank_currency_rates($currencies = array(), $auth = array())
{
	$currency_rub = 'RUB';
	$currencies = Registry::get('currencies');

    $query = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y');
    $response_data = Http::get($query);
    $xml = @simplexml_load_string($response_data);

	if (!is_object($xml) && !isset($xml->Valute)) {
       	if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
    }

    $_currencies = array();
    foreach ($xml->Valute as $value) {
        $_currencies[(string) $value->CharCode]['value'] = floatval(str_replace(',', '.', (string) $value->Value));
        $_currencies[(string) $value->CharCode]['nominal'] = floatval(str_replace(',', '.', (string) $value->Nominal));
    }

    if (empty($_currencies) || ($currency_rub != CART_PRIMARY_CURRENCY && !isset($_currencies[CART_PRIMARY_CURRENCY]))) {
        if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
    }

    if ($currency_rub == CART_PRIMARY_CURRENCY) {
    	foreach ($currencies as $_code => $_value) {
            if (isset($_currencies[$_code])) {
            	$rate = $_currencies[$_code]['value'] / $_currencies[$_code]['nominal'];
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                	'timestamp' => TIME,
					'yahoo_rate' => $rate
                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
            }
        }
    } else {
    	if (isset($_currencies[CART_PRIMARY_CURRENCY]) && isset($currencies[$currency_rub])) {
            $_coefficient = $rate = $_currencies[CART_PRIMARY_CURRENCY]['nominal'] / $_currencies[CART_PRIMARY_CURRENCY]['value'];
            $_data = array(
                'coefficient' => $rate + ($rate * $currencies[$currency_rub]['rate_modifier'] / 100),
                'timestamp' => TIME,
				'yahoo_rate' => $rate
            );
            db_query("UPDATE ?:currencies SET ?u WHERE  currency_code = ?s", $_data, $currency_rub);
        }
        foreach ($currencies as $_code => $_value) {
            if (isset($_currencies[$_code]) && $_code != CART_PRIMARY_CURRENCY) {
                $_rub_coefficient = $_currencies[$_code]['nominal'] / $_currencies[$_code]['value'];
                $rate = $_coefficient / $_rub_coefficient;
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                    'timestamp' => TIME,
					'yahoo_rate' => $rate 

                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
            }
        }
    }

    return true;
}

function fn_get_privatbank_currency_rates($currencies = array(), $auth = array())
{
	$currency_uah = 'UAH';
	$currencies = Registry::get('currencies');

	if (Registry::get('addons.ecl_exchange_rates.privat_rate') == 'cashless') {
		$query = 'https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11';
	} else {
		$query = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';
	}
	$type = Registry::get('addons.ecl_exchange_rates.privat_type');

	$response_data = Http::get($query);
	$reseponse = json_decode($response_data, true);

	if (empty($response_data) || empty($reseponse)) {
		if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
	}

	$_currencies = array();
	foreach ($reseponse as $r) {
		$_currencies[$r['ccy']] = $r;
	}

	if (empty($_currencies) || ($currency_uah != CART_PRIMARY_CURRENCY && !isset($_currencies[CART_PRIMARY_CURRENCY]))) {
        if (empty($auth['user_id'])) {
			fn_echo(__('error'));
		} else {
			fn_set_notification('E', __('error'), __('error'));
		}
		return false;
    }

    if ($currency_uah == CART_PRIMARY_CURRENCY) {
    	foreach ($currencies as $_code => $_value) {
    		if (isset($_currencies[$_code])) {
    			$rate = ($type == 'selling') ? $_currencies[$_code]['sale'] : $_currencies[$_code]['buy'];
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                    'timestamp' => TIME,
					'yahoo_rate' => $rate,
                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
	        }
        }
    } else {
    	if (isset($_currencies[CART_PRIMARY_CURRENCY]) && isset($currencies[$currency_uah])) {
            $_coefficient = $rate = ($type == 'selling') ? $_currencies[CART_PRIMARY_CURRENCY]['sale'] : $_currencies[CART_PRIMARY_CURRENCY]['buy'];
            $_data = array(
                'coefficient' => $rate + ($rate * $currencies[$currency_uah]['rate_modifier'] / 100),
                'timestamp' => TIME,
				'yahoo_rate' => $rate
            );
            db_query("UPDATE ?:currencies SET ?u WHERE  currency_code = ?s", $_data, $currency_uah);
        }
        foreach ($currencies as $_code => $_value) {
            if (isset($_currencies[$_code]) && $_code != CART_PRIMARY_CURRENCY) {
                $_uah_coefficient = ($type == 'selling') ? $_currencies[$_code]['sale'] : $_currencies[$_code]['buy'];
                $rate = $_coefficient / $_uah_coefficient;
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                    'timestamp' => TIME,
					'yahoo_rate' => $rate 
                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
            }
        }
    }

    return true;
}

function fn_get_google_currency_rates($currencies = array(), $auth = array())
{
    $query = "https://finance.google.com/finance/converter?a=1&";
    foreach ($currencies as $code => $cur_data) {
        if ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
            $response_data = Http::get($query . "from=" . $code . "&to=" . CART_PRIMARY_CURRENCY);

            preg_match("/<span class=bld>(.*)<\/span>/",$response_data, $converted);
            if (!empty($converted)) {
                $rate = preg_replace("/[^0-9.]/", "", $converted[1]);

                if(is_numeric($rate)) {
                    $_data = array(
                        'coefficient' => $rate + ($rate * $cur_data['rate_modifier'] / 100),
                        'timestamp' => TIME,
                        'yahoo_rate' => $rate 
                    );
                    db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?s", $_data, $cur_data['currency_id']);
                    if (empty($auth['user_id'])) {
                        fn_echo(' . ');
                    }
                } else {
                    fn_set_notification('E', __('error'), $code);
                }
            }
        }
    }
    
    return true;
}

function fn_get_ecb_currency_rates($currencies = array(), $auth = array())
{
    $currency_eur = 'EUR';

    $query = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
    $response_data = simplexml_load_file($query);

    $_currencies = array();
    foreach($response_data->Cube->Cube->Cube as $rate){ 
        $_currencies[(string) $rate["currency"]] = (string) $rate["rate"];      
    } 

    if ($currency_eur == CART_PRIMARY_CURRENCY) {
        foreach ($currencies as $_code => $_value) {
            if (isset($_currencies[$_code])) {
                $_eur_coefficient = $_currencies[$_code];
                $rate = 1 / $_eur_coefficient;
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                    'timestamp' => TIME,
                    'yahoo_rate' => $rate,
                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
            }
        }
    } else {
        if (isset($_currencies[CART_PRIMARY_CURRENCY]) && isset($currencies[$currency_eur])) {
            $_coefficient = $rate = $_currencies[CART_PRIMARY_CURRENCY];
            $_data = array(
                'coefficient' => $rate + ($rate * $currencies[$currency_eur]['rate_modifier'] / 100),
                'timestamp' => TIME,
                'yahoo_rate' => $rate
            );
            db_query("UPDATE ?:currencies SET ?u WHERE  currency_code = ?s", $_data, $currency_eur);
        }
        foreach ($currencies as $_code => $_value) {
            if (isset($_currencies[$_code]) && $_code != CART_PRIMARY_CURRENCY) {
                $_eur_coefficient = $_currencies[$_code];
                $rate = $_coefficient / $_eur_coefficient;
                $_data = array(
                    'coefficient' => $rate + ($rate * $_value['rate_modifier'] / 100),
                    'timestamp' => TIME,
                    'yahoo_rate' => $rate 
                );

                db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s ", $_data, $_code);
            }
        }
    }

    return true;
}

function fn_get_alphavantage_currency_rates($currencies = array(), $auth = array())
{
    $api_key = 'X24PW1QRZI0I3UAO';

    $query = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&apikey={$api_key}&ts=" . TIME;
 
    foreach ($currencies as $code => $cur_data) {
        if ($code != CART_PRIMARY_CURRENCY && (!isset($_REQUEST['currency_id']) || (isset($_REQUEST['currency_id']) && $cur_data['currency_id'] == $_REQUEST['currency_id']) || (empty($auth['user_id']) && $cur_data['auto_update'] == 'Y'))) {
            $response_data = Http::get($query . "&from_currency=" . $code . "&to_currency=" . CART_PRIMARY_CURRENCY);

            if (!empty($response_data)) {
                $response_data = json_decode($response_data, true);

                if (!empty($response_data['Realtime Currency Exchange Rate'])) {
                    $rate = $response_data['Realtime Currency Exchange Rate']['5. Exchange Rate'];
                    $_data = array(
                        'coefficient' => $rate + ($rate * $cur_data['rate_modifier'] / 100),
                        'timestamp' => TIME,
                        'yahoo_rate' => $rate 
                    );
                    db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?s", $_data, $cur_data['currency_id']);
                    if (empty($auth['user_id'])) {
                        fn_echo(' . ');
                    }
                } else {
                    fn_set_notification('E', __('error'), $code);
                }
            }
        }
    }
    
    return true;
}