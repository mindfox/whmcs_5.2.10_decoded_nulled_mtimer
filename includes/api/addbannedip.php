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


if (!$days) {
	$days = 0;
}


if (!$expires) {
	$expires = date("YmdHis", mktime(date("H"), date("i"), date("s"), date("m"), date("d") + $days, date("Y")));
}

$banid = insert_query("tblbannedips", array("ip" => $ip, "reason" => $reason, "expires" => $expires));
$apiresults = array("result" => "success", "banid" => $banid);
?>