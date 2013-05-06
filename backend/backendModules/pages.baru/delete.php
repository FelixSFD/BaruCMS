<?php
include "../../../adminAPI.php";

$pageDelete = new baruSQL("DELETE FROM `".$db_prefix."Pages` WHERE ID = ".$_POST["id"]);
if($pageDelete->execute()){
	echo "success";
} else {
	echo $pageDelete->sqlError();
}
?>