<?php
include "../../../adminAPI.php";

$q1 = new baruSQL("UPDATE `".$db_prefix."Categories` SET `Name` = '".$_POST["name"]."' WHERE ID = ".$_POST["id"]);
if($q1->execute()){
	$success = true;
} else {
	echo $q1->sqlError();
	$success = false;
}

$q2 = new baruSQL("UPDATE `".$db_prefix."Categories` SET `url` = '".$_POST["url"]."' WHERE ID = ".$_POST["id"]);
if($q2->execute()){
	$success = true;
} else {
	echo $q2->sqlError();
	$success = false;
}

$q3 = new baruSQL("UPDATE `".$db_prefix."Categories` SET `visibility` = '".$_POST["visibility"]."' WHERE ID = ".$_POST["id"]);
if($q3->execute()){
	$success = true;
} else {
	echo $q3->sqlError();
	$success = false;
}

if($success){
	echo "success";
}
?>