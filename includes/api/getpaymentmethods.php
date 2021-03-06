<?php
/**
 *
 * @ WHMCS FULL DECODED & NULLED
 *
 * @ Version  : 5.2.10
 * @ Author   : MTIMER
 * @ Release on : 2013-10-20
 * @ Website  : http://www.mtimer.net
 *
 **/

if (!defined("WHMCS")) {
	exit("This file cannot be accessed directly");
}


if (!function_exists("getGatewaysArray")) {
	require ROOTDIR . "/includes/gatewayfunctions.php";
}

$paymentmethods = getGatewaysArray();
$apiresults = array("result" => "success", "totalresults" => count($paymentmethods));
foreach ($paymentmethods as $module => $name) {
	$apiresults['paymentmethods']['paymentmethod'][] = array("module" => $module, "displayname" => $name);
}

$responsetype = "xml";
?>