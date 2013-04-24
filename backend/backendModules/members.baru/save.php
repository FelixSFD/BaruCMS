<?php
include "../../../adminAPI.php";

mysql_query("UPDATE `".$db_prefix."User` SET `Vorname` = '".$_POST["vorname"]."' WHERE ID = ".$_POST["user"], $mysql);
mysql_query("UPDATE `".$db_prefix."User` SET `Nachname` = '".$_POST["nachname"]."' WHERE ID = ".$_POST["user"], $mysql);
mysql_query("UPDATE `".$db_prefix."User` SET `Email` = '".$_POST["email"]."' WHERE ID = ".$_POST["user"], $mysql);
if($_POST["pw"]){
	include $rootPath."/system/classes/baruPassword.class.php";
	$pw = new baruPassword;
	$hashedPassword = $pw->hashPassword($_POST["email"], $_POST["pw"]);
	mysql_query("UPDATE `".$db_prefix."User` SET `Passwort` = '".$hashedPassword."' WHERE ID = ".$_POST["user"], $mysql);
}
mysql_query("UPDATE `".$db_prefix."User` SET `Group` = '".$_POST["group"]."' WHERE ID = ".$_POST["user"], $mysql);
if(!mysql_error()){
	echo "success";
}
?>