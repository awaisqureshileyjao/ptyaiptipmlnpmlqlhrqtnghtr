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
$schema['central']['ab__addons']['items']['ab__product_feed_export']['attrs'] = array('class' => 'is-addon');
$schema['central']['ab__addons']['items']['ab__product_feed_export']['href'] = 'ab__pfe.help';
$schema['central']['ab__addons']['items']['ab__product_feed_export']['position'] = 3;
$schema['central']['ab__addons']['items']['ab__product_feed_export']['subitems']['ab__pfe.settings'] = array(
'href' => 'addons.update&addon=ab__product_feed_export',
'position' => 0,
);
$schema['central']['ab__addons']['items']['ab__product_feed_export']['subitems']['ab__pfe.datafeeds'] = array(
'href' => 'ab__pfe_datafeeds.manage',
'position' => 10,
);
$schema['central']['ab__addons']['items']['ab__product_feed_export']['subitems']['ab__pfe.templates'] = array(
'href' => 'ab__pfe_templates.manage',
'position' => 20,
);
$schema['central']['ab__addons']['items']['ab__product_feed_export']['subitems']['ab__pfe.demodata'] = array(
'href' => 'ab__pfe.demodata',
'position' => 30,
);
$schema['central']['ab__addons']['items']['ab__product_feed_export']['subitems']['ab__pfe.help'] = array(
'href' => 'ab__pfe.help',
'position' => 100,
);
return $schema;
