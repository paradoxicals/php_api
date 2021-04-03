<?php
header("Content-Type:application/json;charset=utf-8");

require_once 'config/database.php';
require_once 'system/controller.php';
require_once 'route/router.php';
require_once 'helper/mhelper.php';

$returnArray = [];

//Router::start('/','user@index');
Router::start('/user/register', 'userController@register');
Router::start('/user/purchase', 'userController@purchase');
/*

$database = new Database();

$returnArray = [];

$mode = $_GET['mode'];
$process = $_GET['process'];

require_once 'api/'.$mode.'/'.$process.'.php';
*/
//echo json_encode($returnArray);