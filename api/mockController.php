<?php

class mockController extends Controller {

	protected $returnArray = [];

	public function verify (){
		if ($_POST) {

			$receipt = mHelper::postCharVariableControl("receipt");

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
		else{
			$returnArray['status'] = false;
			$returnArray['message'] = "The method should be POST";
		}

		echo json_encode($returnArray);
	}
}