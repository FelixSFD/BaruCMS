<?php
include "../../../adminAPI.php";

//MySQLi
if(!$db->query("UPDATE `".$db_prefix."Categories` SET `Name` = '".$_POST["name"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Categories` SET `url` = '".$_POST["url"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$db->query("UPDATE `".$db_prefix."Categories` SET `visibility` = '".$_POST["visibility"]."' WHERE ID = ".$_POST["id"])) {
	$error = true;
}

if(!$error){
	echo "success";
} else {
	echo mysqli_error($db);
}
?>