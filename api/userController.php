<?php

class userController extends Controller {


	public function register (){
		if ($_POST) {

			$returnArray = [];
			$uid = mHelper::postCharVariableControl("uid");
			$appid = mHelper::postCharVariableControl("appid");
			$language = mHelper::postNumericVariableControl("language");
			$os = mHelper::postCharVariableControl("os");

			if ($uid != "" and $appid != "" and $language != 0 and $os != ""){

				$query = $this->db->prepare("select * from mobile_users where uid = '$uid'");
				$query->execute();
				$count = $query->rowCount();

				if ($count != 0){
					$returnArray['status'] = true;
					$returnArray['message'] = "Register OK";
					$returnArray['clientToken'] = "qwopeksldk";//***
				}
				else{
					$insertQuery = $this->db->prepare("insert into mobile_users(uid,appid,language,os,status) values('$uid','$appid',
						$language,'$os',true) ");
					$insertResult = $insertQuery->execute();

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
			echo json_encode($returnArray);
		}
		else{
			$returnArray['status'] = false;
			$returnArray['message'] = "The method should be POST";
			return;
		}


	}

	public function purchase (){
		if ($_POST) {
			echo "purchase";
		}
	}
}