<?php

// ecwid settings
$storeURL = '';  // example: 'http://www.example.com/ecwid/index.html'
$storeId = ''; // found in your ecwid control panel, bottom-right

// bitpay settings
// url of callback.php on your server.  example: 'http://www.example.com/ecwid/bitpay/callback.php
$callbackURL = ''; 
// create this at bitpay.com in your account settings and paste it here
$apiKey = '';  // ex 'DNboT9fVNpW7usAuDNboT9fVNpW7usAu'
$speed = 'high'; // can be 'high', 'medium' or 'low'.  See bitpay API doc for more details.

//payment method settings
$login = ''; // see README
$hashValue = ''; // see README


function debuglog($contents)
{
	$file = 'log.txt';
	file_put_contents($file, date('m-d H:i:s').": ", FILE_APPEND);
	if (is_array($contents))
		file_put_contents($file, var_export($contents, true)."\n", FILE_APPEND);		
	else if (is_object($contents))
		file_put_contents($file, json_encode($contents)."\n", FILE_APPEND);
	else
		file_put_contents($file, $contents."\n", FILE_APPEND);
}

?>