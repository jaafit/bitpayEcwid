<?php

require 'config.php';
require 'bp_lib.php';

$notice = bpVerifyNotification($apiKey);

if (isset($notice['error'])) {
	debuglog($notice['error']);
	die;
}

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
debuglog($datatopost);

switch($notice['status']){
	case 'completed':
	case 'confirmed':
		$url = 'http://app.ecwid.com/authorizenet/'.$storeId.'/';
		debuglog($url);
		$ch = curl_init($url);
 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $datatopost);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 
		$response = curl_exec($ch);
		debuglog($response);
				
		curl_close($ch);
		break;
	}

?>