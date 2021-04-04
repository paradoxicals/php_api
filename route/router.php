<?php

class Router{
	static function currentUrl(){

		return $_SERVER['REQUEST_URI'];
	}

	static function start($url, $callback){
		//$url = preg_replace('/\{(.*?)\}/', '(.*)', $url);
		if(preg_match('@^'.$url.'$@', self::currentUrl())){

			if (is_callable($callback)){
				call_user_func_array($callback, array());
			}

			$currentController = explode('@',$callback);

			if(file_exists('api/'.$currentController[0].'.php')){
				require_once 'api/'.$currentController[0].'.php';
				call_user_func_array([new $currentController[0], $currentController[1]],array());
			}
			else{
				die("404 not found");
			}
		}

		
	}
}