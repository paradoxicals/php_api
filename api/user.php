<?php

if ($_POST) {
	$uid = mHelper::postCharVariableControl("uid");
	$appid = mHelper::postCharVariableControl("appid");
	$language = mHelper::postNumericVariableControl("language");
	$os = mHelper::postCharVariableControl("os");

	if ($uid != "" and $appid != "" and $language != 0 and $os != ""){

		$query = $database->db->prepare("select * from mobile_users where uid = '$uid'");
		$query->execute();
		$count = $query->rowCount();

		if ($count != 0){
			$returnArray['status'] = true;
			$returnArray['message'] = "Register OK";
			$returnArray['clientToken'] = "qwopeksldk";//***
		}
		else{
			$insertQuery = $database->db->prepare("insert into mobile_users(uid,appid,language,os,status) values('$uid','$appid',
				$language,'$os',true) ");
			$insertResult = $insertQuery->execute();
			echo var_dump($insertQuery);
			if ($insertResult){
				$returnArray['status'] = true;
				$returnArray['message'] = "The mobile user has been registered";
				$returnArray['clientToken'] = "qwopeksldk";	//***
			}
			else{
				$returnArray['status'] = false;
				$returnArray['message'] = "The mobile user can not be registered.";
				return;
			}
		}

	}
	else{
		$returnArray['status'] = false;
		$returnArray['message'] = "The variable/variables are invalid or empty";
		return;	
	}
}
else{
	$returnArray['status'] = false;
	$returnArray['message'] = "The method should be POST";
	return;
}