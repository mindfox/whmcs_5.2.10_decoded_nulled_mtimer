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

$notes = array();
$result = select_query("tblticketnotes", "id,admin,date,message", array("ticketid" => $ticketid), "date", "ASC");

while ($data = mysql_fetch_assoc($result)) {
	$notes[] = $data;
}

$apiresults = array("result" => "success", "totalresults" => count($notes), "notes" => array("note" => $notes));
$responsetype = "xml";
?>