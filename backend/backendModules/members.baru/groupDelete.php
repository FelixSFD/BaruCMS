<?php
include "../../../adminAPI.php";

$groupDelete = new baruSQL("DELETE FROM `".$db_prefix."Groups` WHERE ID = ".$_POST["id"]);
if($groupDelete->execute()){
	echo "success";
} else {
	echo $groupDelete->sqlError();
}
?>