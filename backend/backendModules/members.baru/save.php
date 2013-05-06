<?php
include "../../../adminAPI.php";

$q1 = new baruSQL("UPDATE `".$db_prefix."User` SET `Vorname` = '".$_POST["vorname"]."' WHERE ID = ".$_POST["user"]);
if($q1->execute()){
	$success = true;
} else {
	echo $q1->sqlError();
	$success = false;
}

$q2 = new baruSQL("UPDATE `".$db_prefix."User` SET `Nachname` = '".$_POST["nachname"]."' WHERE ID = ".$_POST["user"]);
if($q2->execute()){
	$success = true;
} else {
	echo $q2->sqlError();
	$success = false;
}

$q3 = new baruSQL("UPDATE `".$db_prefix."User` SET `Email` = '".$_POST["email"]."' WHERE ID = ".$_POST["user"]);
if($q3->execute()){
	$success = true;
} else {
	echo $q3->sqlError();
	$success = false;
}

if($_POST["pw"]){
	include $rootPath."/system/classes/baruPassword.class.php";
	$pw = new baruPassword;
	$hashedPassword = $pw->hashPassword($_POST["email"], $_POST["pw"]);

	$q4 = new baruSQL("UPDATE `".$db_prefix."User` SET `Passwort` = '".$hashedPassword."' WHERE ID = ".$_POST["user"]);
	if($q4->execute()){
		$success = true;
	} else {
		echo $q4->sqlError();
		$success = false;
	}
}

$q5 = new baruSQL("UPDATE `".$db_prefix."User` SET `Group` = '".$_POST["group"]."' WHERE ID = ".$_POST["user"]);
if($q5->execute()){
	$success = true;
} else {
	echo $q5->sqlError();
	$success = false;
}

if($success){
	echo "success";
}
?>