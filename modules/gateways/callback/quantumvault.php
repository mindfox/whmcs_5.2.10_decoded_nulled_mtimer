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
 * */

require "../../../init.php";
$whmcs->load_function( "gateway" );
$whmcs->load_function( "invoice" );
$GATEWAY = getGatewayVariables( "quantumvault" );

if (!$GATEWAY["type"]) {
	exit( "Module Not Activated" );
}

$invoiceid = checkCbInvoiceID( $_REQUEST["ID"], "Quantum Vault" );
$transid = $_REQUEST["transID"];
$transresult = $_REQUEST["trans_result"];
$amount = $_REQUEST["amount"];
$md5_hash = $_REQUEST["md5_hash"];
$vaultid = $_REQUEST["cust_id"];
checkCbTransID( $transid );

$ourhash = md5( $GATEWAY["md5hash"] . $GATEWAY["loginid"] . $transid . $amount );

if ($ourhash != $md5_hash) {
	logTransaction( "Quantum Vault", $_REQUEST, "MD5 Hash Failure" );
	echo "Hash Failure. Please Contact Support.";
	exit();
}


if ($GATEWAY["convertto"]) {
	$result = select_query( "tblinvoices", "userid,total", array( "id" => $invoiceid ) );
	$data = mysql_fetch_array( $result );
	$userid = $data["userid"];
	$total = $data["total"];
	$currency = getCurrency( $userid );
	$amount = convertCurrency( $amount, $GATEWAY["convertto"], $currency["id"] );

	if (( $total < $amount + 1 && $amount - 1 < $total )) {
		$amount = $total;
	}
}


if ($transresult == "APPROVED") {
	update_query( "tblclients", array( "gatewayid" => $vaultid ), array( "id" => $vaultid ) );
	addInvoicePayment( $invoiceid, $transid, $amount, "", "quantumvault", "on" );
	logTransaction( "Quantum Vault", $_REQUEST, "Approved" );
	sendMessage( "Credit Card Payment Confirmation", $invoiceid );
	callback3DSecureRedirect( $invoiceid, true );
}

logTransaction( "Quantum Vault", $_REQUEST, "Declined" );
sendMessage( "Credit Card Payment Failed", $invoiceid );
callback3DSecureRedirect( $invoiceid, false );
?>