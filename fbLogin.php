<?php
include "db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);
session_start();
include_once "system/api.php";
include_once "system/fb-auth.php";

$fb_id = $fb_user->id;
if($fb_id && $_GET["state"]){
	$login_abfrage = mysql_query("SELECT * FROM ".$db_prefix."User WHERE FacebookID = '".$fb_id."'", $mysql);
	echo mysql_error();
	$usrs = mysql_fetch_array($login_abfrage);
	if($usrs["Status"] == "1"){
		$session_length = 60*60*24*7;
		$session_expires = time()+$session_length;
		$session_id = zufallsstring(32);
		mysql_query("INSERT INTO `".$db_prefix."Session` VALUES ('".$usrs["ID"]."', '".$session_id."', '".$_SERVER["REMOTE_ADDR"]."','".$session_expires."')", $mysql);
		echo mysql_error();
		setcookie("ECM_id", $session_id, time()+$session_length, "/");
		echo "Du hast dich erfolgreich eingeloggt, ".$usrs["Vorname"];
	} else if($usrs["Status"] != "1"){
		echo "Nicht aktiviert!";
	} else {
		echo "Login fehlgeschlagen!"; 
	}
} else {
	echo "Login wird überprüft...";
}
?>
<a href="javascript:window.close()">close</a>