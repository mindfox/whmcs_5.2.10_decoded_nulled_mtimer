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
$GATEWAY = getGatewayVariables( "paymateau" );

if (!$GATEWAY["type"]) {
	$GATEWAY = getGatewayVariables( "paymatenz" );
}


if (!$GATEWAY["type"]) {
	exit( "Module Not Activated" );
}

$invoiceid = checkCbInvoiceID( $_POST["ref"], "Paymate" );

if (( $_POST["responseCode"] == "PA" && $invoiceid )) {
	addInvoicePayment( $invoiceid, $_POST["transactionID"], "", "", "paymate" );
	logTransaction( "Paymate", $_REQUEST, "Successful" );
	header( "Location: " . $CONFIG["SystemURL"] . "/viewinvoice.php?id=" . $invoiceid );
	exit();
	return 1;
}

logTransaction( "Paymate", $_REQUEST, "Error" );
header( "Location: " . $CONFIG["SystemURL"] . "/viewinvoice.php?id=" . $invoiceid );
exit();
?>