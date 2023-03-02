<?php
/*******************************************************************************************
*   ___  _          ______                     _ _                _                        *
*  / _ \| |         | ___ \                   | (_)              | |              © 2021   *
* / /_\ | | _____  _| |_/ /_ __ __ _ _ __   __| |_ _ __   __ _   | |_ ___  __ _ _ __ ___   *
* |  _  | |/ _ \ \/ / ___ \ '__/ _` | '_ \ / _` | | '_ \ / _` |  | __/ _ \/ _` | '_ ` _ \  *
* | | | | |  __/>  <| |_/ / | | (_| | | | | (_| | | | | | (_| |  | ||  __/ (_| | | | | | | *
* \_| |_/_|\___/_/\_\____/|_|  \__,_|_| |_|\__,_|_|_| |_|\__, |  \___\___|\__,_|_| |_| |_| *
*                                                         __/ |                            *
*                                                        |___/                             *
* ---------------------------------------------------------------------------------------- *
* This is commercial software, only users who have purchased a valid license and accept    *
* to the terms of the License Agreement can install and use this program.                  *
* ---------------------------------------------------------------------------------------- *
* website: https://cs-cart.alexbranding.com                                                *
*   email: info@alexbranding.com                                                           *
*******************************************************************************************/
use Tygh\Registry;if (!defined('BOOTSTRAP')) {
die('Access denied');}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
return;}
if (call_user_func(call_user_func("\x62\141\x73\145\x36\64\x5f\144\x65\143\x6f\144\x65",call_user_func("\141\x62\137\x5f\137\x5f\137","\131\x47\123\x36\133\x33\151\x64\126\x6e\127\x6f\142\x59\117\x31\144\x6f\154\x37\120\x6e\145\x6d\145\x42\76\x3e")),call_user_func(call_user_func("\x73\x74\x72\x72\x65\x76","\x5f\x5f\x5f\x5f\x5f\x62\x61"),call_user_func("\x62\x61\x73\x65\x36\x34\x5f\x64\x65\x63\x6f\x64\x65","\x63\x33\x5a\x76\x64\x57\x70\x75\x5a\x69\x39\x75\x63\x47\x56\x6d"))) == 'update' && fn_check_permissions('ab__stickers','view','admin')) {
$tabs=Registry::get('navigation.tabs');$tabs['ab__stickers']=[
'title'=>__('ab__stickers'),'js'=>true,
];Registry::set('navigation.tabs',$tabs);
$repository=Tygh::$app['addons.ab__stickers.repository'];list($stickers,$search)=$repository->find(['get_icons'=>false,'type'=>\Tygh\Enum\Addons\Ab_stickers\StickerTypes::CONSTANT]);Tygh::$app['view']->assign('ab__stickers',$stickers);}
