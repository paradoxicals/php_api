<?php

class mHelper {

	static function postCharVariableControl($value){
		if(isset($_POST[$value])){
			return strip_tags($_POST[$value]);
		}
		else {
			return "";
		}
	}

	static function postNumericVariableControl($value){
		if(isset($_POST[$value])){
			return intval($_POST[$value]);
		}
		else{
			return 0;
		}
	}
}