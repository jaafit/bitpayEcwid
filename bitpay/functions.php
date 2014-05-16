<?php

function debuglog($contents)
{
	error_log($contents);
}

function postToEcwid($notice)
{
	require 'config.php';
	
	$x_response_code = '1'; // 1=approved, 2=declined
	$x_response_reason_code = '1'; // 1=approved, 2= declined
	$x_trans_id = $notice['id'];
	$x_invoice_num = $notice['posData'][1]; 
	$x_amount = $notice['posData'][0];

	$string = $hashValue.$login.$x_trans_id.$x_amount;
	$x_MD5_Hash = md5($string);
	$datatopost = array (
		"x_response_code" => $x_response_code,
		"x_response_reason_code" => $x_response_reason_code,
		"x_trans_id" => $x_trans_id,
		"x_invoice_num" => $x_invoice_num,
		"x_amount" => $x_amount,
		"x_MD5_Hash" => $x_MD5_Hash,
		);

	switch($notice['status']){
		case 'completed':
		case 'confirmed':
			$url = 'http://app.ecwid.com/authorizenet/'.$storeId;
			$ch = curl_init($url);
	 
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $datatopost);
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$response = curl_exec($ch);
			if ($response === false){
				debuglog('request to ecwid.com failed');
				debuglog(curl_error($ch));
			}
					
			curl_close($ch);
			return $response;
		default:
			return false;
		}
}

// delete .inv files that are older than 24 hrs
function deleteOldInvs() {
	if ($handle = opendir('./')) {
		while (false !== ($file = readdir($handle))) { 
			$ext = substr($file, -3);
			if ($ext != 'inv')
				continue;
			if((time() - filemtime($file)) > 86400)
				unlink($file);

		}
		closedir($handle); 
	}
}
?>
