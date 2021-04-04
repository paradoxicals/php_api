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
						$returnArray['clientToken'] = $token;
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

			$clientToken = mHelper::postCharVariableControl("client_token");
			$receipt = mHelper::postCharVariableControl("receipt");
			

			if ($clientToken != "" and $receipt != ""){

				$query = $this->db->prepare("select client_token,uid,appid from mobile_users where client_token = '$clientToken'");
				$query->execute();
				$count = $query->rowCount();

				if ($count != 0){

					$result = $query->fetch(PDO::FETCH_ASSOC);

					// Mock Api Control
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://127.0.0.1/mockApi/control",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "receipt=$receipt",
					  CURLOPT_HTTPHEADER => array(
					  	"Authorization: Basic c3JrbmRuc246YlNhZEZkN2Mq",
					    "Content-Type: application/x-www-form-urlencoded",
					    "Postman-Token: 864e29d3-6bc8-43fd-944b-a314c1c84d18",
					    "cache-control: no-cache"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
						$returnArray['status'] = true;
						$returnArray['message'] = "Can not reach Mock Api - cURL Error #:" . $err;					  
					} 
					else {
						$purchaseResponse= json_decode($response);

					   if ($purchaseResponse->status == true) {
					   		$purchaseUid = $result['uid'];
					   		$purchaseAppId = $result['appid'];
					   		$purchaseExpireDate = $purchaseResponse->expireDate;

					   		$insertQuery = $this->db->prepare("insert into purchases(uid,appid,receipt,expire_date) 
					   			values('$purchaseUid','$purchaseAppId', '$receipt', '$purchaseExpireDate') ");
							$insertResult = $insertQuery->execute();
							
							if ($insertResult){
								$returnArray['status'] = true;
								$returnArray['message'] = "The purchase completed successfully";
							}
							else{
								$returnArray['status'] = false;
								$returnArray['message'] = "The purchase can not be completed";
							}
					   }
					   else{
					   		$returnArray['status'] = false;
							$returnArray['message'] = "The purchase can not be completed";
					   }
					}
					
				}
				else{
					$returnArray['status'] = false;
					$returnArray['message'] = "The invalid/wrong token";
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


	public function checkSubscription (){
		if ($_POST) {

			$clientToken = mHelper::postCharVariableControl("client_token");

			if ($clientToken != ""){

				$query = $this->db->prepare("select status from mobile_users where client_token = '$clientToken' and status = true");
				$query->execute();
				$count = $query->rowCount();

				if ($count != 0){
					$returnArray['status'] = true;
					$returnArray['message'] = "The mobile user have subscription record.";
				}
				else{
					$returnArray['status'] = false;
					$returnArray['message'] = "The mobile user has not any subscription record.";				
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
}