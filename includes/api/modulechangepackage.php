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


if (!function_exists("ServerChangePackage")) {
	require ROOTDIR . "/includes/modulefunctions.php";
}

$serviceid = (isset($_POST['serviceid']) ? $_POST['serviceid'] : $_POST['accountid']);
$result = select_query("tblhosting", "packageid", array("id" => $serviceid));
$data = mysql_fetch_array($result);
$packageid = $data['packageid'];

if (!$packageid) {
	$apiresults = array("result" => "error", "message" => "Service ID Not Found");
	return false;
}

$result = ServerChangePackage($serviceid);

if ($result == "success") {
	$apiresults = array("result" => "success");
	return 1;
}

$apiresults = array("result" => "error", "message" => $result);
?>