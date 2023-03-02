<?php
/*****************************************************************************
*                                                                            *
*          All rights reserved! CS-Commerce Software Solutions               *
* 			https://www.cs-commerce.com/license-agreement.html 				 *
*                                                                            *
*****************************************************************************/

$schema['top']['addons']['items']['csc_addons']['type']='title';
$schema['top']['addons']['items']['csc_addons']['href']='csc_sync_rates.settings';
$schema['top']['addons']['items']['csc_addons']['position']='1200';
$schema['top']['addons']['items']['csc_addons']['title']=__("csrc.csc_addons");

$schema['top']['addons']['items']['csc_addons']['subitems']['csc_sync_rates'] = array(
    'attrs' => array(
        'class'=>'is-addon'
    ),
    'href' => 'csc_sync_rates.settings',	
    'position' => 300
);

return $schema;

