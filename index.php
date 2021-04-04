<?php
header("Content-Type:application/json;charset=utf-8");

require_once 'config/database.php';
require_once 'system/controller.php';
require_once 'route/router.php';
require_once 'helper/mhelper.php';

try {
	Router::start('/user/register', 'userController@register');
	Router::start('/user/purchase', 'userController@purchase');
	Router::start('/mockApi/control', 'mockController@verify');
	Router::start('/user/check', 'userController@checkSubscription');

} catch (Exception $e) {
	echo $e->getMessage();
}

