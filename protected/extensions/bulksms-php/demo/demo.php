<?php

include_once('../BulkSMS.php');

$args = array(
    "api_key"  => "some_api_key",
    "senderId" => "TEST"
);
$sms = new BulkSMS( $args );

echo $sms->balance();


?>
