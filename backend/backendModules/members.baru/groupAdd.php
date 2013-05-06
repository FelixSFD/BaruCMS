<?php
include "../../../adminAPI.php";

$groupAdd = new baruSQL("INSERT INTO `".$db_prefix."Groups` VALUES ('', '".$_POST["name"]."')");
if($groupAdd->execute()){
	echo "success";
} else {
	echo $groupAdd->sqlError();
}
?>