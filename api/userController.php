<?php

class userController extends Controller {

	protected $returnArray = [];
	public function register (){
		if ($_POST) {

			$uid = mHelper::postCharVariableControl("uid");
			$appid = mHelper::postCharVariableControl("appid");
			$language = mHelper::postNumericVariableControl("language");
			$os = mHelper::postCharVariableControl("os");

			if ($uid != "" and $appid != "" and $language != 0 and $os != ""){

				$query = $this->db->prepare("select client_token from mobile_users where uid = '$uid'");
				$query->execute();
				$count = $query->rowCount();

				if ($count != 0){

					$result = $query->fetch(PDO::FETCH_ASSOC);

					$returnArray['status'] = true;
					$returnArray['message'] = "Register OK";
					$returnArray['clientToken'] = $result['client_token'];
				}
				else{

					$token = openssl_random_pseudo_bytes(16);
					$token = bin2hex($token);
					

					$insertQuery = $this->db->prepare("insert into mobile_users(uid,appid,language,os,status,client_token) values('$uid',
						'$appid',$language,'$os',true,'$token') ");
					$insertResult = $insertQuery->execute();

					if ($insertResult){
						$returnArray['status'] = true;
						$returnArray['message'] = "The mobile user has been registered";
						$returnArray['clientToken'] = "qwopeksldk";	//***
					}
					else{
						$returnArray['status'] = false;
						$returnArray['message'] = "The mobile user can not be registered.";
					}
				}

			}
			else{
				$returnArray['status'] = false;
				$returnArray['message'] = "The variable/variables are invalid or empty";
			}
		}
		else{
			$returnArray['status'] = false;
			$returnArray['message'] = "The method should be POST";
		}

		echo json_encode($returnArray);
		$returnArray = [];	
	}

	public function purchase (){
		if ($_POST) {
			$returnArray['status'] = true;
			$returnArray['message'] = "Successfull";
		}
		else{
			$returnArray['status'] = false;
			$returnArray['message'] = "The method should be POST";
		}

		echo json_encode($returnArray);
		$returnArray = [];
	}
}