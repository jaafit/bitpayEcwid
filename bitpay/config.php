<?php

$storeURL = '';
$storeId = '';
$apiKey = '';
$speed = 'high'; // can be 'high', 'medium' or 'low'
$login = '';
$hashValue = '';

// add trailing slash to storeURL
$storeURL = preg_replace('#([^\/])$#', '\1/', $storeURL);

function debuglog($contents)
{
	$file = 'log.txt';
	file_put_contents($file, date('m-d H:i:s').": \n", FILE_APPEND);
	if (is_array($contents))
		file_put_contents($file, var_export($contents, true)."\n", FILE_APPEND);		
	else if (is_object($contents))
		file_put_contents($file, json_encode($contents)."\n", FILE_APPEND);
	else
		file_put_contents($file, $contents."\n", FILE_APPEND);
}

?>