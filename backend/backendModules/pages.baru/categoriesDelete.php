<?php
include "../../../adminAPI.php";

$categoryDelete = new baruSQL("DELETE FROM `".$db_prefix."Categories` WHERE ID = ".$_POST["id"]);
if($categoryDelete->execute()){
	echo "success";
} else {
	echo $categoryDelete->sqlError();
}
?>