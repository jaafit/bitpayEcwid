<?php

require 'config.php';
require 'bp_lib.php';
require 'functions.php';

$notice = bpVerifyNotification($apiKey);

if (isset($notice['error'])) {
	debuglog($notice);
	die;
}

postToEcwid($notice);

?>