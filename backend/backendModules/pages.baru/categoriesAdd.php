<?php
include "../../../adminAPI.php";

$categoryAdd = new baruSQL("INSERT INTO `".$db_prefix."Categories` VALUES ('', '".$_POST["name"]."', '".strtoURL($_POST["name"])."', 'hidden')");
if($categoryAdd->execute()){
	echo "success";
} else {
	echo $categoryAdd->sqlError();
}
?>