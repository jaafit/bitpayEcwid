<?php

/* example POST
array (
  'x_test_request' => 'TRUE',
  'x_description' => 'Order #8',
  'x_login' => 'somethingrandom123123123123', 	// validate this
  'x_amount' => '3.45',							// send to bitpay
  'x_currency_code' => 'USD',					// send to bitpay
  'x_version' => '3.1',
  'x_line_item' => 'Pea<|>00006<|><|>1<|>3.45<|>N',
  'x_email' => 'japhet_s@hotmail.com',
  'x_fp_hash' => 'e1a607ee95b0bf2cce0f98d473c7a93b',
  'x_fp_sequence' => '266678650',
  'x_fp_timestamp' => '1352441204',
  'x_invoice_num' => '6022515',					// posData
  'x_first_name' => 'Japhet',
  'x_last_name' => 'Stevens',
  'x_address' => '333 Hampshire Dr',
  'x_city' => 'Nashua',
  'x_state' => 'NH',
  'x_zip' => '03060',
  'x_country' => 'United States',
  'x_phone' => '',
  'x_fax' => '',
  'x_cust_id' => '6022515',
  'x_relay_response' => 'TRUE',
  'x_relay_url' => 'http://app.ecwid.com/authorizenet/1671204',
  'x_show_form' => 'PAYMENT_FORM',
  'x_method' => 'CC',
)
// test post from bitpay
{"id":"XJPj-_Ywt-hHv8eE9lfitgubtPlMk_36EDJzuZL4vnk=","url":"https://bitpay.com/invoice/XJPj-_Ywt-hHv8eE9lfitgubtPlMk_36EDJzuZL4vnk=","posData":"{\"posData\":[\"3.45\",\"6022515\"],\"hash\":\"AUYF0KaYTuVLw\"}","status":"confirmed","btcPrice":"0.3165","price":3.45,"currency":"USD","invoiceTime":1352504790016,"expirationTime":1352505690016,"currentTime":1352504868515}

// test post from ecwid
Content-Type: application/x-www-form-urlencoded
x_test_request=TRUE&x_description=Order#8&x_login=somethingrandom123123123123&x_amount=3.45&x_currency_code=USD&x_version=3.1&x_line_item=Pea<|>00006<|><|>1<|>3.45<|>N&x_email=japhet_s@hotmail.com&x_fp_sequence=266678650&x_fp_timestamp=1352441204&x_fp_hash=e1a607ee95b0bf2cce0f98d473c7a93b&x_invoice_num=6022515&x_first_name=Japhet&x_last_name=Stevens&x_address=333HampshireDr&x_city=Nashua&x_state=NH&x_zip=03060&x_country=UnitedStates&x_phone=&x_fax=&x_cust_id=6022515&x_relay_response=TRUE&x_relay_url=http://app.ecwid.com/authorizenet/1671204&x_show_form=PAYMENT_FORM&x_method=CC&

// test post to ecwid
Content-Type: application/x-www-form-urlencoded
x_response_code=1&x_response_reason_code=1&x_trans_id=1&x_invoice_num=6022515&x_amount=3.45&x_MD5_Hash=0ba6427a7172b7da5e892bc03128c107&
*/

require 'bp_lib.php';
require 'config.php';

if ($_POST['x_login'] != $login) {
	debuglog('ecwid login does not match that found in config.php');
	print 'invalid ecwid login';
	die;
}

// create invoice
$posData = array($_POST['x_amount'], // put here to preserve exact digits
		$_POST['x_invoice_num']);
$options = array(
	'apiKey' => $apiKey,
	'notificationURL' => $storeURL.'bitpay/callback.php',
	'transactionSpeed' => $speed,
	'fullNotifications' => true,
	'itemDesc' => $_POST['x_description'],
	'currency' => $_POST['x_currency_code'],
	'redirectURL' => $storeURL,
	'buyerEmail' => $_POST['x_email'],
	'buyerName' => $_POST['x_first_name'].' '.$_POST['x_last_name'],
	'buyerAddress1' => $_POST['x_address'],
	'buyerCity' => $_POST['x_city'],
	'buyerState' => $_POST['x_state'],
	'buyerZip' => $_POST['x_zip'],
	'buyerCountry' => $_POST['x_country'],
	);		
$invoice = bpCreateInvoice(NULL, $_POST['x_amount'], $posData, $options);
if (isset($invoice['error'])) {
	debuglog($invoice['error']);
	print 'Error creating invoice';
	die;
}

debuglog($options);
debuglog($invoice);

// redirect to bitpay
header('Location: '.$invoice['url']);

?>