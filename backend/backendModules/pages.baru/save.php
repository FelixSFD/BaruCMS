<?php
include "../../../adminAPI.php";

$q1 = new baruSQL("UPDATE `".$db_prefix."Pages` SET `Titel` = '".strip_tags($_POST["title"])."' WHERE ID = ".$_POST["id"]));
if($q1->execute()){
	$success = true;
} else {
	echo $q1->sqlError();
	$success = false;
}

$q2 = new baruSQL("UPDATE `".$db_prefix."Pages` SET `Inhalt` = '".htmlentities($_POST["inhalt"])."' WHERE ID = ".$_POST["id"]));
if($q2->execute()){
	$success = true;
} else {
	echo $q2->sqlError();
	$success = false;
}

$q3 = new baruSQL("UPDATE `".$db_prefix."Pages` SET `Datum` = '".time()."' WHERE ID = ".$_POST["id"]));
if($q3->execute()){
	$success = true;
} else {
	echo $q3->sqlError();
	$success = false;
}

$q4 = new baruSQL("UPDATE `".$db_prefix."Pages` SET `im_Blog` = '".$_POST["type"]."' WHERE ID = ".$_POST["id"]));
if($q4->execute()){
	$success = true;
} else {
	echo $q4->sqlError();
	$success = false;
}

$q5 = new baruSQL("UPDATE `".$db_prefix."Pages` SET `Category` = '".$_POST["category"]."' WHERE ID = ".$_POST["id"]));
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