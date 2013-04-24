<?php
include "../../../adminAPI.php";
include $rootPath."/system/classes/baruPassword.class.php";
$pw = new baruPassword;
$hashedPassword = $pw->hashPassword($_POST["email"], $_POST["pw"]);

mysql_query("INSERT INTO `".$db_prefix."User` VALUES ('', '".$_POST["vorname"]."', '".$_POST["nachname"]."', '".$_POST["email"]."', '".$hashedPassword."', '1', '".time()."', '1')", $mysql);

if(!mysql_error()){
	echo "success";
}
?>