<?php
include "../../../adminAPI.php";
$groupAdd = new baruSQL("DELETE FROM `".$db_prefix."User` WHERE ID = ".$_POST["id"]);
if($groupAdd->execute()){
	echo "success";
} else {
	echo $groupAdd->sqlError();
}
?>