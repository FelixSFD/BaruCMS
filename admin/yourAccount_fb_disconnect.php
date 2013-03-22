<?php
/*
$app_id = "225463167580375";
$app_secret = "e710fa0e301c00d159b4230df7a0d878";
$my_url = "http://".$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];

session_start();
$token = $_SESSION["access_token"];

if($token) {
 $graph_url = "https://graph.facebook.com/me/permissions?method=delete&access_token=" 
   . $token;

 $result = json_decode(file_get_contents($graph_url));
 if($result) {
	session_destroy();
	echo("User is now logged out.");
 }
} else {
 echo("User already logged out.");
}*/

include "../db_config.php";
$mysql = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $mysql);
mysql_query("UPDATE `".$db_prefix."User` SET `FacebookID` = '0' WHERE FacebookID = ".$_POST["id"], $mysql);
if(!mysql_error()){
	echo "success";
} else {
	echo mysql_error();
}
?>