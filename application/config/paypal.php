<?php
/** Setting Paypal Creds **/

$config['client_id'] = PAYPAL_CLIENT_ID;
$config['secret'] = PAYPAL_SECRET_ID;

$config['settings'] = array(
	'mode' => 'sandbox', //live
	'http.ConnectionTimeOut' => 1000,
	'log.LogEnabled' => true,
	'log.FileName' => 'application/logs/paypal.log',
	'log.LogLevel' => 'FINE'
);

?>
