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

$result = select_query("tblannouncements", "id", array("id" => $announcementid));
$data = mysql_fetch_array($result);

if (!$data['id']) {
	$apiresults = array("result" => "error", "message" => "Announcement ID Not Found");
	return false;
}

$title = html_entity_decode($title);
$announcement = html_entity_decode($announcement);
insert_query("tblannouncements", array("date" => $date, "title" => $title, "announcement" => $announcement, "published" => $published), array("id" => $announcementid));
run_hook("AnnouncementEdit", array("announcementid" => $announcementid, "date" => $date, "title" => $title, "announcement" => $announcement, "published" => $published));
$apiresults = array("result" => "success", "announcementid" => $announcementid);
?>