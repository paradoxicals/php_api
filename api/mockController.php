<?php

class mockController extends Controller {

	protected $returnArray = [];

	public function verify (){
		if ($_POST) {
			$AUTH_USER = 'srkndnsn';
			$AUTH_PASS = 'bSadFd7c*';

			$hasSuppliedCredentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
			$receipt = mHelper::postCharVariableControl("receipt");

			$isNotAuthenticated = (!$hasSuppliedCredentials || $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
				$_SERVER['PHP_AUTH_PW']   != $AUTH_PASS);

			if ($isNotAuthenticated) {
				
				$returnArray['status'] = false;
				$returnArray['message'] = "Authorization Required";
			}
			else{
				if ($receipt != ""){

					$receiptControlChar = substr($receipt, -1);
					if (intval($receiptControlChar)%2 == 0){
						$returnArray['status'] = true;
						$returnArray['message'] = "Successful";

						date_default_timezone_set('America/Denver');
						$returnArray['expireDate'] =  date('Y-m-d H:i:s');
					}
					else{
						$returnArray['status'] = false;
						$returnArray['message'] = "The receipt is invalid ";
					}

				}
				else{
					$returnArray['status'] = false;
					$returnArray['message'] = "The variable/variables are invalid or empty";
				}
			}	
			
		}
		else{
			$returnArray['status'] = false;
			$returnArray['message'] = "The method should be POST";
		}

		echo json_encode($returnArray);
	}
}