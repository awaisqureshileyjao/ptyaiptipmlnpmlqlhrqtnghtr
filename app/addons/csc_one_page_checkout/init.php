<?php

if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_register_hooks(
	'shippings_get_shippings_list_post',
	'calculate_cart_items',
	'shippings_get_shippings_list_conditions'
);

