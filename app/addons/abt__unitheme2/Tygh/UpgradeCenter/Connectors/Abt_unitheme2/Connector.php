<?php
/*******************************************************************************************
*   ___  _          ______                     _ _                _                        *
*  / _ \| |         | ___ \                   | (_)              | |              © 2020   *
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
namespace Tygh\UpgradeCenter\Connectors\Abt_unitheme2;use Tygh\Addons\SchemesManager;use Tygh\Http;use Tygh\Registry;use Tygh\Settings;use Tygh\Tools\Url;use Tygh\UpgradeCenter\Connectors\BaseAddonConnector;use Tygh\UpgradeCenter\Connectors\IConnector;use Tygh\ABAManager;class Connector extends BaseAddonConnector implements IConnector{
protected $addon_id;protected $addon;protected $manager;protected $s;protected $m;protected $url;public function __construct(){
parent::__construct();$this->addon_id=call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmN1YGB2b2p1aWZuZjM='));$this->s=call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dGZ1dWpvaHQ='));$this->m=call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmNgYGJlZXBvdGBuYm9iaGZz'));$this->u=call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'aXV1cXQ7MDBkdC5kYnN1L2JtZnljc2JvZWpvaC9kcG4wYnFqMzA='));$this->manager=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldQkNCTmJvYmhmczs7aGBi')),$this->m);$this->addon=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldQkNCTmJvYmhmczs7aGBi')),$this->addon_id);if (call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->m.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2N2am1l'))) == 26){
$this->addon[$this->addon_id][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dw=='))]=$this->addon[$this->addon_id][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'d2ZzdGpwbw=='))];$this->addon[$this->addon_id][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZA=='))]=(call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dHVzbWZv')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->addon_id.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2RwZWY=')))))?call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->addon_id.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2RwZWY='))):call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Li4='));$this->addon[$this->addon_id][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Yw=='))]=(call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dHVzbWZv')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->addon_id.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2N2am1l')))))?call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->addon_id.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2N2am1l'))):call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Li4='));$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dw=='))]=$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'d2ZzdGpwbw=='))];$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZA=='))]=(call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dHVzbWZv')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->m.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2RwZWY=')))))?call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->m.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2RwZWY='))):call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Li4='));$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Yw=='))]=(call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dHVzbWZv')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->m.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2N2am1l')))))?call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'YmVlcG90Lw==')).$this->m.call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'L2N2am1l'))):call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Li4='));}}
public function getConnectionData(){
Http::$logging=false;return array(
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bmZ1aXBl'))=>call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cXB0dQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dnNt'))=>$this->u,
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWJ1Yg=='))=>array(
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cw=='))=>call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dmQvZHQ=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bA=='))=>$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZA=='))],
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Yw=='))=>$this->manager[$this->m][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Yw=='))],
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'aQ=='))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gYm1tcHhmZWBncHM=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'TlZNVUpXRk9FUFM=')))?call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvZ2poL2l1dXFgaXB0dQ=='))):call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWNgaGZ1YGdqZm1ldA==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VEZNRkRVIXR1cHNmZ3Nwb3UhR1NQTiFAO2RwbnFib2pmdCFYSUZTRiF0dWJ1dnQhPiEoQighQk9FIXR1cHNmZ3Nwb3UhIj4hKCg='))),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bQ=='))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvdHVib3U=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'REJTVWBNQk9IVkJIRg=='))),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cXc='))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvdHVib3U=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'UVNQRVZEVWBXRlNUSlBP'))),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cWY='))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvdHVib3U=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'UVNQRVZEVWBGRUpVSlBP'))),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cWM='))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvdHVib3U=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'UVNQRVZEVWBDVkpNRQ=='))),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Yg=='))=>$this->addon,
),);}
public function processServerResponse($response,$show_upgrade_notice){
$pd=array();$rd=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'a3Rwb2BlZmRwZWY=')),$response,true);if (!empty($rd) and !empty($rd[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z2ptZg=='))])){
$pd=$rd;$pd[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'b2JuZg=='))]=$this->addon[$this->addon_id][call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'b2JuZg=='))].$pd[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'b2JuZg=='))];if ($show_upgrade_notice) {
call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gdGZ1YG9wdWpnamRidWpwbw==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'WA==')),__(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'b3B1amRm'))),__(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dWZ5dWB2cWhzYmVmYGJ3YmptYmNtZg==')),array(
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XHFzcGV2ZHVe'))=>'<b>'.$pd[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'b2JuZg=='))].'</b>',
call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XG1qb2xe'))=>call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gdnNt')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dnFoc2JlZmBkZm91ZnMvbmJvYmhm')))
)),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VA==')));}}
return $pd;}
public function downloadPackage($schema,$package_path){
$r=array(false,__(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dWZ5dWB2ZGBkYm91YGVweG9tcGJlYHFiZGxiaGY='))));$schema['type']=$schema['id'];if (!empty($schema[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bGZ6'))])){
Http::$logging=false;$res=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gcXZ1YGRwb3Vmb3V0')),$package_path,call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldSXV1cTs7cXB0dQ==')),$this->u,array(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cw=='))=>call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dmQvaGI=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bA=='))=>$schema[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'bGZ6'))],),array(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dWpuZnB2dQ=='))=>15,)));if (!$res || call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'dHVzbWZv')),$error=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldSXV1cTs7aGZ1RnNzcHM='))))){ call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gc24=')),$package_path);}else{call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Z29gcXZ1YGRwb3Vmb3V0')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'XVV6aGldU2ZoanR1c3o7O2hmdQ==')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZHBvZ2poL2Vqcy92cWhzYmVm'))).call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'cWJkbGJoZnQw')).$schema[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'amU='))].call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'MHRkaWZuYi9rdHBv')),call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'a3Rwb2Bmb2RwZWY=')),$schema)); $r=array(true,''); }}
return $r;}
public function onSuccessPackageInstall($content_schema,$information_schema){
parent::onSuccessPackageInstall($content_schema,$information_schema);$s_id=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWNgaGZ1YGdqZm1l')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VEZNRkRVIXRmZHVqcG9gamUhR1NQTiFAO3RmdXVqb2h0YHRmZHVqcG90IVhJRlNGIW9ibmYhPiFAdCFCT0UhdXpxZiE+IShCRUVQTyg=')),$this->addon_id);if ($s_id){
$st_id=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWNgaGZ1YGdqZm1l')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VEZNRkRVIXRmZHVqcG9gamUhR1NQTiFAO3RmdXVqb2h0YHRmZHVqcG90IVhJRlNGIXFic2ZvdWBqZSE+IUBqIUJPRSFvYm5mIT4hQHQ=')),$s_id,$this->s);if ($st_id){
$b=call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWNgaGZ1YGdqZm1l')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VEZNRkRVIXdibXZmIUdTUE4hQDt0ZnV1am9odGBwY2tmZHV0IVhJRlNGIXRmZHVqcG9gamUhPiFAaiFCT0UhdGZkdWpwb2B1YmNgamUhPiFAaiFCT0Uhb2JuZiE+IUB0')),$s_id,$st_id,call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Y3ZqbWU=')));$b and call_user_func(call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'ZWNgcnZmc3o=')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'VlFFQlVGIUA7dGZ1dWpvaHRgcGNrZmR1dCFURlUhd2JtdmYhPiFAdCFYSUZTRiF0ZmR1anBvYGplIT4hQGohQk9FIXRmZHVqcG9gdWJjYGplIT4hQGohQk9FIW9ibmYhPiFAdA==')),$information_schema[call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Y3ZqbWU='))],$s_id,$st_id,call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73bc`4b::73````')),call_user_func(call_user_func(ab_____('tus`sfqmbdf'),'3a9962','',ab_____('4b::73cbtf754b::73`efdpef')),'Y3ZqbWU=')));}}}}