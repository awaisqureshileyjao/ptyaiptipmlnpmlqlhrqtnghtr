<?php
/*****************************************************************************
*                                                                            *
*          All rights reserved! CS-Commerce Software Solutions               *
* 			https://www.cs-commerce.com/license-agreement.html 				 *
*                                                                            *
*****************************************************************************/
if (!defined('BOOTSTRAP')) { die('Access denied'); }
$schema = array(   
	'general' => array(		
		'sync_period'=>array(
			'type' => 'selectbox',
			'default'=>'D',
			'tooltip'=>true,
			'variants'=>[				
				'3H'=>__('csrc.3h'),
				'6H'=>__('csrc.6h'),
				'12H'=>__('csrc.12h'),
				'D'=>__('daily'),
				'W'=>__('weekly'),
				'M'=>__('monthly'),				
			]			
		)		
	),	 	 	 	 	
);

return $schema;