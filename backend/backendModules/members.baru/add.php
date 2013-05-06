<?php
include "../../../adminAPI.php";
include $rootPath."/system/classes/baruPassword.class.php";

$userAdd = new baruSQL("INSERT INTO `".$db_prefix."User` VALUES ('', '".$_POST["vorname"]."', '".$_POST["nachname"]."', '".$_POST["email"]."', '0', '1', '".time()."', '1')");
if($userAdd->execute()){
	$success = true;
} else {
	echo $userAdd->sqlError();
	$success = false;
}
/*
$pw = new baruPassword;
$hashedPassword = $pw->hashPassword($_POST["email"], $_POST["pw"]);

$userEditPW = new baruSQL("UPDATE `".$db_prefix."User` SET `Passwort` = '".$hashedPassword."' WHERE Email = '".$_POST["email"]."'");
if($userEditPW->execute()){
	$success = true;
} else {
	echo $userEditPW->sqlError();
	$success = false;
}*/

if($success){
	echo "success";
}
?>