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

function getValidLanguages($admin = "") {
	global $whmcs;

	$langs = $whmcs->getValidLanguages($admin);
	return $langs;
}

function htmlspecialchars_array($arr) {
	global $whmcs;

	return $whmcs->sanitize_input_vars($arr);
}

error_reporting(0);
include dirname(__FILE__) . "/includes/classes/class.init.php";

if (!class_exists("WHMCS_Init")) {
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Down for Maintenance (Err 1)</strong><br>An upgrade is currently in progress... Please come back soon...</div>";
	exit();
}

$whmcs = new WHMCS_Init();
$whmcs = $whmcs->init();

if ($CONFIG['Version'] == "5.2.1") {
	update_query("tblconfiguration", array("value" => "5.2.2"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.2";
}


if ($CONFIG['Version'] == "5.2.2") {
	update_query("tblconfiguration", array("value" => "5.2.3"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.3";
}


if ($CONFIG['Version'] == "5.2.3") {
	update_query("tblconfiguration", array("value" => "5.2.4"), array("setting" => "Version"));
	full_query("UPDATE `tblemailtemplates` SET  `message` = '<p>A new support ticket has been flagged to you.</p><p>Ticket #: " . $ticket_tid . "<br>Client Name: " . $client_name . " (ID " . $client_id . ")<br>Department: " . $ticket_department . "<br>Subject: " . $ticket_subject . "<br>Priority: " . $ticket_priority . "</p><p>----------------------<br />" . $ticket_message . "<br />----------------------</p><p><a href=\"" . $whmcs_admin_url . "supporttickets.php?action=viewticket&id=" . $ticket_id . "\">" . $whmcs_admin_url . "supporttickets.php?action=viewticket&id=" . $ticket_id . "</a></p>' WHERE  name='Support Ticket Flagged'");
	$CONFIG['Version'] = "5.2.4";
}


if ($CONFIG['Version'] == "5.2.4") {
	update_query("tblconfiguration", array("value" => "5.2.5"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.5";
}


if ($CONFIG['Version'] == "5.2.7") {
	update_query("tblconfiguration", array("value" => "5.2.8"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.8";
}


if ($CONFIG['Version'] == "5.2.8") {
	update_query("tblconfiguration", array("value" => "5.2.9"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.9";
}


if ($CONFIG['Version'] == "5.2.9") {
	update_query("tblconfiguration", array("value" => "5.2.10"), array("setting" => "Version"));
	$CONFIG['Version'] = "5.2.10";
}


if ($CONFIG['Version'] != "5.2.10") {
	if (file_exists("../install/install.php")) {
		header("Location: ../install/install.php");
		exit();
	}

	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Down for Maintenance (Err 2)</strong><br>An upgrade is currently in progress... Please come back soon...</div>";
	exit();
}


if (file_exists(ROOTDIR . "/install/install.php")) {
	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Security Warning</strong><br>The install folder needs to be deleted for security reasons before using WHMCS</div>";
	exit();
}


if (!$whmcs->check_template_cache_writeable()) {
	exit("<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Permissions Error</strong><br>The templates compiling directory '" . $whmcs->get_template_compiledir_name() . "' must be writeable (CHMOD 777) before you can continue.<br>If the path shown is incorrect, you can update it in the configuration.php file.</div>");
}


if ((defined("CLIENTAREA") && $CONFIG['MaintenanceMode']) && !$_SESSION['adminid']) {
	if ($CONFIG['MaintenanceModeURL']) {
		header("Location: " . $CONFIG['MaintenanceModeURL']);
		exit();
	}

	echo "<div style=\"border: 1px dashed #cc0000;font-family:Tahoma;background-color:#FBEEEB;width:100%;padding:10px;color:#cc0000;\"><strong>Down for Maintenance (Err 3)</strong><br>" . $CONFIG['MaintenanceModeMessage'] . "</div>";
	exit();
}

$licensing = WHMCS_License::init();

if ($licensing->getVersionHash() != "9eb7da5f081b3fc7ae1e460afdcb89ea8239eca1") {
	exit("License Checking Error");
}


if ((defined("CLIENTAREA") && isset($_SESSION['uid'])) && !isset($_SESSION['adminid'])) {
	$twofa = new WHMCS_2FA();
	$twofa->setClientID($_SESSION['uid']);

	if (($twofa->isForced() && !$twofa->isEnabled()) && $twofa->isActiveClients()) {
		if ($whmcs->get_filename() == "clientarea" && ($whmcs->get_req_var("action") == "security" || $whmcs->get_req_var("2fasetup"))) {
		}
		else {
			redir("action=security&2fasetup=1&enforce=1", "clientarea.php");
		}
	}
}


if (isset($_SESSION['currency']) && is_array($_SESSION['currency'])) {
	$_SESSION['currency'] = $_SESSION['currency']['id'];
}


if (!isset($_SESSION['uid']) && isset($_REQUEST['currency'])) {
	$result = select_query("tblcurrencies", "id", array("id" => (int)$_REQUEST['currency']));
	$data = mysql_fetch_array($result);

	if ($data['id']) {
		$_SESSION['currency'] = $data['id'];
	}
}


if (defined("CLIENTAREA") && isset($_REQUEST['language'])) {
	$whmcs->set_client_language($_REQUEST['language']);
}

$whmcs->loadLanguage();

if (defined("CLIENTAREA") && $CONFIG['SystemSSLURL']) {
	$files = array("aff.php", "clientarea.php", "supporttickets.php", "contact.php", "passwordreminder.php", "login.php", "logout.php", "affiliates.php", "submitticket.php", "viewemail.php", "viewinvoice.php", "viewticket.php", "creditcard.php", "register.php", "upgrade.php", "cart.php", "configuressl.php", "domainchecker.php", "networkissues.php", "serverstatus.php", "pwreset.php");
	$nonsslfiles = array("announcements.php", "banned.php", "contact.php", "downloads.php", "index.php", "tutorials.php", "whois.php", "knowledgebase.php");

	if (!defined("WHMCSWWW1")) {
		$nonsslfiles[] = "dl.php";
	}

	$filename = $_SERVER['PHP_SELF'];
	$filename = substr($filename, strrpos($filename, "/"));
	$filename = str_replace("/", "", $filename);
	$requesturl = $_SERVER['PHP_SELF'] . "?";
	foreach ($_REQUEST as $key => $value) {

		if (!is_array($value)) {
			$requesturl .= "" . $key . "=" . urlencode($value) . "&";
			continue;
		}
	}

	$requesturl = substr($requesturl, 0, 0 - 1);
	$requesturl = substr($requesturl, strrpos($requesturl, "/"));
	$ssldomain = $CONFIG['SystemSSLURL'];
	$nonssldomain = $CONFIG['SystemURL'];

	if ($_SESSION['FORCESSL'] && $filename == "index.php") {
		define("FORCESSL", true);
	}


	if (in_array($filename, $files) || defined("FORCESSL")) {
		if (!$_SERVER['HTTPS'] || $_SERVER['HTTPS'] == "off") {
			header("Location: " . $ssldomain . $requesturl);
			exit();
		}

		$in_ssl = true;
	}
	else {
		if (in_array($filename, $nonsslfiles)) {
			if ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") {
				header("Location: " . $nonssldomain . $requesturl);
				exit();
			}
		}
	}
}

ob_start();
require ROOTDIR . "/includes/hookfunctions.php";
ob_end_clean();
?>