<?php
require 'config.php';
require 'bp_lib.php';
require 'functions.php';

// get invoice number from file
$file = $_GET['ecwidInvoiceId'].'.inv';

if (file_exists($file))
{
	$invoiceId = file_get_contents($file);	
	deleteOldInvs();
	
	$invoice = bpGetInvoice($invoiceId, $apiKey);
	if ($invoice['status'] == 'confirmed' or $invoice['status'] == 'completed')
	{
		postToEcwid($invoice); // this will redirect to a confirmation page
		die;
	}
}
else
	debuglog('no file found for invoice '.$_GET['ecwidInvoiceId']);
	
header('Location: '.$storeURL); // if the transaction speed is medium/low, they'll be redirected w/o confirmation

?>