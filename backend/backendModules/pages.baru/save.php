<?php
include "../../../adminAPI.php";

//MySQLi
if(!$db->query("UPDATE `".$db_prefix."Pages` SET `Titel` = '".$_POST["title"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Pages` SET `Inhalt` = '".$_POST["inhalt"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Pages` SET `Datum` = '".time()."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Pages` SET `im_Blog` = '".$_POST["type"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Pages` SET `Category` = '".$_POST["category"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$error){
	echo "success";
} else {
	echo mysqli_error($db);
}
?>