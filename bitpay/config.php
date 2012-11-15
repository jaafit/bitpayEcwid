<?php

// ecwid settings
$storeURL = '';  // example: 'http://www.example.com/ecwid/index.html'
$storeId = ''; // found in your ecwid control panel, bottom-right

// bitpay settings
// url of bitpay folder on your server.  example: 'http://www.example.com/ecwid/bitpay/
$bitpayURL = ''; 
// apiKey: create this at bitpay.com in your account settings and paste it here
$apiKey = '';  // ex 'DNboT9fVNpW7usAuDNboT9fVNpW7usAu'
// speed: Warning: on medium/low, customers will not see an order confirmation page.  
$speed = 'high'; // can be 'high', 'medium' or 'low'.  See bitpay API doc for more details.

//payment method settings
$login = ''; // see README
$hashValue = ''; // see README

// add trailing slash to url
$bitpayURL = preg_replace('#([^\/])$#', '\1/', $bitpayURL);

?>