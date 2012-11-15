<?php

require 'bp_lib.php';
require 'config.php';
require 'functions.php';

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
	'notificationURL' => $bitpayURL.'callback.php',
	'transactionSpeed' => $speed,
	'fullNotifications' => true,
	'itemDesc' => $_POST['x_description'],
	'currency' => $_POST['x_currency_code'],
	'redirectURL' => $bitpayURL.'redirect2ecwid.php?ecwidInvoiceId='.$_POST['x_invoice_num'],
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
	debuglog($options);
	debuglog($invoice);
	print 'Error creating invoice';
	die;
}

// save bitpay invoice id in a file named after the ecwid invoice id
file_put_contents($_POST['x_invoice_num'].'.inv', $invoice['id']);

// redirect to bitpay
header('Location: '.$invoice['url']);

?>